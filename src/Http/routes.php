<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'welcome',
    'namespace' => 'DRG\Welcome\Http\Controller',
    'middleware' => ['web', 'auth', 'locale'],
], function () {
    Route::get('/', 'WelcomeController@showMainPage')->name('welcome.main');
    Route::post('/bind-tel', 'WelcomeController@bindTel')->name('welcome.bindtel');
    Route::post('/switch-lang', 'WelcomeController@switchLang')->name('welcome.switch-lang');
});
