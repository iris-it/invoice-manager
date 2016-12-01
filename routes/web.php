<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return redirect(action('HomeController@index'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


    Route::get('/home', 'HomeController@index');

    Route::get('/serve/{uuid}', function ($uuid) {
        $document = App\Document::where('uuid', $uuid)->get()->first();
        return response()->download(storage_path(
            'app' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $document->path
        ));
    });

    /*
    * User Group
    */
    Route::group(['prefix' => 'user'], function () {
        Route::get('vaults', 'VaultController@index');
        Route::get('vaults/{id}', 'VaultController@show');
        Route::post('vaults/{id}/validate/{document}', 'VaultController@validateDocument');
        Route::post('vaults/{id}/unvalidate/{document}', 'VaultController@unvalidateDocument');
    });

    /*
    * Manager Group
    */
    Route::group(['namespace' => 'Manager', 'prefix' => 'manager'], function () {

        /*
         * Vault resources
         */
        Route::get('vaults', 'VaultController@index');
        Route::get('vaults/create', 'VaultController@create');
        Route::post('vaults', 'VaultController@store');
        Route::get('vaults/{id}', 'VaultController@show');
        Route::get('vaults/{id}/edit', 'VaultController@edit');
        Route::put('vaults/{id}', 'VaultController@update');
        Route::delete('vaults/{id}', 'VaultController@destroy');

        Route::get('vaults/{vault_id}/abort/document/{document_id}/user/{user_id}', 'VaultController@abortUserValidation');
        Route::post('vaults/{vault_id}/abort/document/{document_id}/user/{user_id}/{status}', 'VaultController@processAbortUserValidation');

        /*
         * Documents resources
         */
        Route::get('documents', 'DocumentController@index');
        Route::delete('documents/{id}', 'DocumentController@destroy');

    });

    /*
    * Admin Group
    */
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

        /*
         * User resources
         */
        Route::get('users', 'UserController@index');
        Route::get('users/create', 'UserController@create');
        Route::post('users', 'UserController@store');
        Route::get('users/{id}', 'UserController@show');
        Route::get('users/{id}/edit', 'UserController@edit');
        Route::put('users/{id}', 'UserController@update');
        Route::delete('users/{id}', 'UserController@destroy');
        Route::post('users/send/reset/{id}', 'UserController@resendPasswordEmail');

        /*
         * Role resources
         */
        Route::get('roles', 'RoleController@index');
        Route::post('roles', 'RoleController@store');
        Route::get('roles/create', 'RoleController@create');
        Route::get('roles/{id}', 'RoleController@show');
        Route::get('roles/{id}/edit', 'RoleController@edit');
        Route::put('roles/{id}', 'RoleController@update');
        Route::delete('roles/{id}', 'RoleController@destroy');

        Route::put('roles/{id}/sync/permissions', 'RoleController@syncPermissions');

        /*
        * Permission resources
        */
        Route::post('permissions/trigger/scan', 'PermissionController@triggerScanPermission');

        Route::get('permissions', 'PermissionController@index');
        Route::post('permissions', 'PermissionController@store');
        Route::get('permissions/create', 'PermissionController@create');
        Route::get('permissions/{id}', 'PermissionController@show');
        Route::get('permissions/{id}/edit', 'PermissionController@edit');
        Route::put('permissions/{id}', 'PermissionController@update');
        Route::delete('permissions/{id}', 'PermissionController@destroy');

        Route::put('permissions/{id}/sync/roles', 'PermissionController@syncRoles');

    });

});
