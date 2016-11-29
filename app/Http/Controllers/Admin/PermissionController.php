<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use App\Http\Requests\Admin\PermissionRoleRequest;
use App\Permission;
use App\Role;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Lang;
use Laracasts\Flash\Flash;

class PermissionController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('pages.admin.permission.index')->with(compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->all();

        if ($permission = Permission::create($data)) {
            Flash::success(Lang::get('permission.create-success'));
            return redirect(action('Admin\PermissionController@show', $permission->id));
        } else {
            Flash::error(Lang::get('permission.create-failed'));
            return redirect(action('Admin\PermissionController@create'));
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::orderBy('name')->pluck('name', 'id');

        return view('pages.admin.permission.show')->with(compact('permission', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::orderBy('name')->pluck('name', 'id');

        return view('pages.admin.permission.edit')->with(compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param PermissionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->update($request->all()) && $permission->save()) {
            Flash::success(Lang::get('permission.update-success'));
        } else {
            Flash::error(Lang::get('permission.update-failed'));
        }

        return redirect(action('Admin\PermissionController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->delete()) {
            Flash::success(Lang::get('permission.destroy-success'));
        } else {
            Flash::error(Lang::get('permission.destroy-failed'));
        }

        return redirect(action('Admin\PermissionController@index'));

    }

    /**
     * Trigger the scan of the permissions and set them in database
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function triggerScanPermission()
    {
        try {
            define('STDOUT', fopen('php://stdout', 'w'));
            $out = Artisan::call('parse:permissions');
        } catch (Exception $e) {
            Flash::error(Lang::get('permission.scan-failed'));
        }
        Flash::success(Lang::get('permission.scan-success'));

        return redirect(action('Admin\PermissionController@index'));
    }

    /**
     * @param PermissionRoleRequest|syncRoles $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function syncRoles(PermissionRoleRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        
        $data = $request->all();

        if(!$request->has("roles")) {
            $data["roles"] = [];
        }

        if ($permission->roles()->sync($data["roles"])) {
            Flash::success(Lang::get('permission.update-success'));
        } else {
            Flash::error(Lang::get('permission.update-failed'));
        }

        return redirect(action('Admin\PermissionController@index'));

    }
}
