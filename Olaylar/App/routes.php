<?php

Route::group(array('module' => 'Olaylar', 'middleware' =>  ['web', 'auth'], 'namespace' => 'App\Modules\Olaylar\App\Http\Controllers'), function() {

    // Olaylar - Settings
    Route::put('/admin/modules/Olaylar/settings/', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminSettingsController@update', 'as' => 'admin.Olaylar.settings.update'));
    Route::post('/admin/modules/Olaylar/settings/', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminSettingsController@store', 'as' => 'admin.Olaylar.settings.store'));
    Route::get('/admin/modules/Olaylar/settings/{id}/delete', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminSettingsController@destroy', 'as' => 'admin.Olaylar.settings.destroy'));
    Route::get('/admin/modules/Olaylar/settings/create', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminSettingsController@create', 'as' => 'admin.Olaylar.settings.create'));
    Route::get('/admin/modules/Olaylar/settings/', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminSettingsController@index', 'as' => 'admin.Olaylar.settings.index'));

    // Olaylar - Admin
    Route::post('/admin/modules/Olaylar/', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@store', 'as' => 'admin.Olaylar.store'));
    Route::put('/admin/modules/Olaylar/{id}', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@update', 'as' => 'admin.Olaylar.update'));


    Route::get('/admin/modules/Olaylar/raporlar', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\RaporlarAdminController@index', 'as' => 'admin.raporlar.index'));
    Route::get('/admin/modules/Olaylar/raporlar/{id}/delete', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\RaporlarAdminController@destroy', 'as' => 'admin.raporlar.destroy'));
    Route::get('/admin/modules/Olaylar/raporlar/{id}/edit', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\RaporlarAdminController@edit', 'as' => 'admin.raporlar.edit'));
    Route::put('/admin/modules/Olaylar/raporlar/{id}', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\RaporlarAdminController@update', 'as' => 'admin.raporlar.update'));

    // Olaylar - CORS
    Route::get('/admin/modules/Olaylar', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@index', 'as' => 'admin.Olaylar.index'));
    Route::get('/admin/modules/Olaylar/{id}/delete', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@destroy', 'as' => 'admin.Olaylar.destroy'));
    Route::get('/admin/modules/Olaylar/{id}/{objeId}/delete', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@objectDestroy', 'as' => 'admin.Objeler.objectDestroy'));
    Route::get('/admin/modules/Olaylar/{id}/edit', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@edit', 'as' => 'admin.Olaylar.edit'));
    Route::get('/admin/modules/Olaylar/create', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@create', 'as' => 'admin.Olaylar.create'));
    Route::get('/admin/modules/Olaylar/{id}', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarAdminController@show', 'as' => 'admin.Olaylar.show'));



});	

Route::group(array('module' => 'Olaylar', 'middleware' =>  ['web', 'api'], 'namespace' => 'App\Modules\Olaylar\App\Http\Controllers'), function() {
    Route::resource('OlaylarAPI', 'OlaylarApiController');
});

Route::group(array('module' => 'Olaylar', 'middleware' =>  ['web'], 'namespace' => 'App\Modules\Olaylar\App\Http\Controllers'), function() {

	// Olaylar - Visitor
    Route::get('/login', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarController@login', 'as' => 'olaylar.login'));

    Route::get('/Olaylar/Objeler/create/{olayId}', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarController@objectCreate', 'as' => 'olaylar.objectCreate'));
    Route::get('/Olaylar/Objeler/rapor/{objeId}', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarController@objectReport', 'as' => 'olaylar.objectReport'));
    Route::get('/Olaylar/redirect/{slug}', array('uses' => '\App\Modules\Olaylar\App\Http\Controllers\OlaylarController@redirect', 'as' => 'olaylar.objectReport'));

    Route::resource('Olaylar', '\App\Modules\Olaylar\App\Http\Controllers\OlaylarController');
});	