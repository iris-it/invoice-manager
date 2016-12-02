<?php

namespace App\Http\Controllers;

use App\Document;
use App\Jobs\SendStatusByEmail;
use App\Services\ProcessValidationFile;
use App\Vault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class VaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:permission::access_user_section');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $vaults = $user->public_vaults()->paginate(10);

        return view('pages.user.vault.index')->with(compact('vaults'));
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

        $user = auth()->user();

        $exist = $vault->users->contains($user->id);

        if (!$exist) {
            return abort(404);
        }

        return view('pages.user.vault.show')->with(compact('vault', 'status'));
    }

    /**
     * validate Toggle the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @param $document
     * @param ProcessValidationFile $processValidationFile
     * @return \Illuminate\Http\Response
     */
    public function validateDocument(Request $request, $id, $document, ProcessValidationFile $processValidationFile)
    {
        $vault = Vault::findOrFail($id);

        $document = Document::findOrFail($document);

        $user = auth()->user();

        $file = $processValidationFile->initialize($request->file('file'), $vault)->processValidationFile();

        $document->validation_document()->save($file);

        $this->dispatch(new SendStatusByEmail($user, $vault, $document, true));

        Flash::success(Lang::get('vault.validate-success'));

        return redirect(action('VaultController@show', $id));
    }

    /**
     * validate Toggle the specified resource.
     *
     * @param  int $id
     * @param $document
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function unvalidateDocument($id, $document)
    {
        $vault = Vault::findOrFail($id);

        $document = Document::findOrFail($document);

        $user = auth()->user();

        $this->dispatch(new SendStatusByEmail($user, $vault, $document, false));

        Flash::success(Lang::get('vault.unvalidate-success'));

        return redirect(action('VaultController@show', $id));
    }

}
