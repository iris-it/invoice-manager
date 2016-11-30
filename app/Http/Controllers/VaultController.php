<?php

namespace App\Http\Controllers;

use App\Jobs\SendStatusByEmail;
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

        $status = $vault->users()->where('user_id', $user->id)->first()->pivot->is_valid;

        return view('pages.user.vault.show')->with(compact('vault', 'status'));
    }

    /**
     * validate Toggle the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function validateToggle(Request $request, $id)
    {
        $vault = Vault::findOrFail($id);

        $user = auth()->user();

        $vault->users()->updateExistingPivot($user->id, ['is_valid' => boolval($request->has('status'))]);

        $this->dispatch(new SendStatusByEmail($user, $vault, boolval($request->has('status'))));

        Flash::success(Lang::get('vault.validate-success'));

        return redirect(action('VaultController@show', $id));
    }

}
