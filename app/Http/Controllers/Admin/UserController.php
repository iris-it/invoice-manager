<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Jobs\SendPasswordByEmail;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:permission::access_admin_section');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('pages.admin.user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('pages.admin.user.create')->with(compact('roles', 'organizations'));
    }

    public function store(UserRequest $request)
    {

        if ($user = User::create($request->all())) {

            dispatch(new SendPasswordByEmail($user));

            Flash::success(Lang::get('users.create-success'));
            return redirect(action('Admin\UserController@index'));
        } else {
            Flash::error(Lang::get('users.create-failed'));
            return redirect(action('Admin\UserController@create'));
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
        $user = User::findOrFail($id);

        return view('pages.admin.user.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id');

        return view('pages.admin.user.edit')->with(compact('user', 'roles', 'organizations'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->update($request->all())) {
            Flash::success(Lang::get('users.update-success'));
            return redirect(action('Admin\UserController@index'));
        } else {
            Flash::error(Lang::get('users.update-failed'));
            return redirect(action('Admin\UserController@edit', $id));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($user->id == $request->user()->id) {
            Flash::error(Lang::get('users.destroy-failed'));
            return redirect(action('Admin\UserController@index'));
        }

        if ($user->delete()) {
            Flash::success(Lang::get('users.destroy-success'));
        } else {
            Flash::error(Lang::get('users.destroy-failed'));
        }

        return redirect(action('Admin\UserController@index'));

    }

    public function resendPasswordEmail($id)
    {
        $user = User::findOrFail($id);

        dispatch(new SendPasswordByEmail($user));

        Flash::success(Lang::get('users.reset-success'));

        return redirect(action('Admin\UserController@index'));
    }

}
