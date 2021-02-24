<?php

Route::group(['prefix' => 'painel'], function(){
    //  PostController
    Route::get('posts', 'Painel\PostController@index');
    
    //  PermissionController
    Route::get('permissions', 'Painel\PermissionController@index');
    Route::get('permission/{id}/roles', 'Painel\PermissionController@roles');
    
    //  RoleController
    Route::get('roles', 'Painel\RoleController@index');
    Route::get('role/{id}/permissions', 'Painel\RoleController@permissions');

    //  UserController
    Route::get('users', 'Painel\UserController@index');
    Route::get('user/{id}/roles', 'Painel\UserController@roles');

    //  PainelController
    Route::get('/', 'Painel\PainelController@index');
});

Route::get('logout', 'Auth\LoginController@logout'); // Adicionado pois por algum motivo, o /logout não estava funcionando sozinho, como de costume

Auth::routes();

Route::get('/', 'Portal\SiteController@index');
