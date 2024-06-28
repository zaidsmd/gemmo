<?php

use Illuminate\Support\Facades\Route;


include __DIR__.'/modules/auth.php';

Route::group(['middleware' => ['auth']],function(){
    Route::get('/', function () {
        return view('tableau_bord');
    });
});
