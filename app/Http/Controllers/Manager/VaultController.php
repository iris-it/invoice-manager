<?php

namespace App\Http\Controllers\Manager;

use App\Document;
use App\Http\Requests\Manager\VaultRequest;
use App\Jobs\SendAbortStatusByEmail;
use App\Jobs\SendVaultLinkByEmail;
use App\Services\ProcessEmails;
use App\Services\ProcessFiles;
use App\User;
use App\Vault;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class VaultController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:permission::access_manager_section');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        $user = auth()->user();

        $vaults = $user->vaults()->paginate(10);

        return view('pages.manager.vault.index')->with(compact('vaults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('pages.manager.vault.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VaultRequest $request
     * @param ProcessEmails $processEmails
     * @param ProcessFiles $processFiles
     * @return \Illuminate\Http\Response
     */
    public function store(VaultRequest $request, ProcessEmails $processEmails, ProcessFiles $processFiles)
    {
        $data = $request->all();

        /*
         * Create Vault
         */
        $vault = Vault::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_id' => $request->user()->id,
        ]);

        /*
         * Create or get users and attach them to vault
         */
        $users = $processEmails->initialize($data['emails'])->processUsers();

        /*
         * Add all users to the current vault
         */
        $vault->users()->sync($users->pluck('id')->all());

        /*
         * Store files to vault
         */
        $files = $processFiles->initialize($request->file('files'), $vault)->processFiles();

        /*
         * Add all the documents to the vault and the owner
         */
        foreach ($files as $file) {
            $file->vault()->associate($vault);
            $file->owner()->associate($request->user());
            $file->save();
        }

        /*
         * Return Success or not
         */
        if ($vault->save()) {

            /*
             * Dispatch by mail
             */
            foreach ($users as $user) {
                $this->dispatch(new SendVaultLinkByEmail($user, $vault));
            }

            Flash::success(Lang::get('vault.create-success'));
            return redirect(action('Manager\VaultController@index'));
        } else {
            Flash::error(Lang::get('vault.create-failed'));
            return redirect(back());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $vault = Vault::findOrFail($id);

        if (auth()->user()->id !== $vault->owner->id) {
            return abort(404);
        }

        return view('pages.manager.vault.show')->with(compact('vault'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $vault = Vault::findOrFail($id);

        if (auth()->user()->id !== $vault->owner->id) {
            return abort(404);
        }

        /*
         * Rebuild the string for the emails form with comas "user@mail.com,user2@mail.com'
         */
        $emails = $vault->users->reduce(function ($carry, $item) {
            if (!$carry) return $item->email;
            return $carry . ',' . $item->email;
        });

        return view('pages.manager.vault.edit')->with(compact('vault', 'emails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VaultRequest|Request $request
     * @param  int $id
     * @param ProcessEmails $processEmails
     * @param ProcessFiles $processFiles
     * @return \Illuminate\Http\Response
     */
    public function update(VaultRequest $request, $id, ProcessEmails $processEmails, ProcessFiles $processFiles)
    {
        $vault = Vault::findOrFail($id);

        if (auth()->user()->id !== $vault->owner->id) {
            return abort(404);
        }

        $data = $request->all();

        /*
         * update Vault
         */
        $vault->update([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        /*
         * Create or get users and attach them to vault
         */
        $users = $processEmails->initialize($data['emails'])->processUsers();

        /*
        * Add all users to the current vault
        */
        $vault->users()->sync($users->pluck('id')->all());

        /*
         * If we add more files
         */
        if ($request->hasFile('files')) {

            /*
             * Upload all files and return a collection
             */
            $files = $processFiles->initialize($request->file('files'), $vault)->processFiles();

            /*
             * Add all the documents to the vault and the owner
             */
            foreach ($files as $file) {
                $file->vault()->associate($vault);
                $file->owner()->associate($request->user());
                $file->save();
            }
        }

        Flash::success(Lang::get('vault.update-success'));
        return redirect(action('Manager\VaultController@edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vault = Vault::findOrFail($id);

        $disk = Storage::disk('uploads');

        foreach ($vault->documents as $document) {

            if ($document->validation_document) {
                $disk->delete($document->validation_document->path);
                $document->validation_document->delete();
            }

            $disk->delete($document->path);
            $document->delete();
        }

        $disk->deleteDirectory($vault->id . str_slug($vault->name));

        $vault->delete();

        Flash::success(Lang::get('vault.delete-success'));

        return redirect(action('Manager\VaultController@index'));

    }


    public function abortUserValidation($vault_id, $document_id, $user_id)
    {
        $vault = Vault::findOrFail($vault_id);

        $document = Document::findOrFail($document_id);

        $user = User::findOrFail($user_id);

        return view('pages.manager.vault.abort-validation')->with(compact('vault', 'document', 'user'));
    }

    public function processAbortUserValidation($vault_id, $document_id, $user_id, $status)
    {
        $vault = Vault::findOrFail($vault_id);

        $document = Document::findOrFail($document_id);

        $user = User::findOrFail($user_id);

        if (boolval($status)) {

            $disk = Storage::disk('uploads');

            if ($document->validation_document) {
                $disk->delete($document->validation_document->path);
                $document->validation_document->delete();
            }

            $this->dispatch(new SendAbortStatusByEmail($user, $vault, $document, true));
        } else {
            $this->dispatch(new SendAbortStatusByEmail($user, $vault, $document, false));
        }

        return redirect(action('Manager\VaultController@show', $vault_id));
    }
}
