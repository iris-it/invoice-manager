<?php

namespace App\Http\Controllers\Manager;

use App\Http\Requests\Manager\VaultRequest;
use App\Vault;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $vaults = Vault::paginate(10);

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
     * @return \Illuminate\Http\Response
     */
    public function store(VaultRequest $request)
    {
        $data = $request->all();

        $user = User::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
