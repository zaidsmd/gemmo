<?php

use Illuminate\Support\Facades\Route;


include __DIR__.'/modules/auth.php';

Route::group(['middleware' => ['auth']],function(){
    Route::get('/', function () {
        return view('tableau_bord');
    });


    Route::group(['prefix' => 'departement','controller' => \App\Http\Controllers\DepartementController::class],function(){
       Route::get('/','liste')->name('departements.liste');
       Route::post('/','sauvegarder')->name('departements.sauvegarder');
       Route::put('/{id}','mettre_a_jour')->name('departements.mettre_a_jour');
       Route::get('/modifier/{id}','modifier')->name('departements.modifier');
       Route::delete('/{id}','supprimer')->name('departements.supprimer');
    });
    Route::group(['prefix' => 'categorie','controller' => \App\Http\Controllers\CategoryController::class],function(){
        Route::get('/','liste')->name('category.liste');
        Route::post('/','sauvegarder')->name('category.sauvegarder');
        Route::put('/{id}','mettre_a_jour')->name('category.mettre_a_jour');
        Route::get('/modifier/{id}','modifier')->name('category.modifier');
        Route::delete('/{id}','supprimer')->name('category.supprimer');
              Route::get('select','select')->name('category.select');

    });
    Route::group(['prefix' => 'materiels','controller' => \App\Http\Controllers\MaterielController::class],function(){
        Route::get('/','liste')->name('materiels.liste');
        Route::post('/','sauvegarder')->name('materiels.sauvegarder');
        Route::get('/ajouter','ajouter')->name('materiels.ajouter');
        Route::put('/{id}','mettre_a_jour')->name('materiels.mettre_a_jour');
        Route::get('/modifier/{id}','modifier')->name('materiels.modifier');
        Route::get('/afficher/{id}','afficher')->name('materiels.afficher');
        Route::post('/attacher','attacher')->name('materiels.attacher');
        Route::post('/dettacher/{id}','dettacher')->name('materiels.dettacher');
        Route::delete('/{id}','supprimer')->name('materiels.supprimer');
        Route::get('historique/{id}','historique')->name('materiels.historique');
    });

    Route::group(['prefix' => 'employes','controller' => \App\Http\Controllers\UserController::class],function(){
        Route::get('/','liste')->name('users.liste');
        Route::post('/','sauvegarder')->name('users.sauvegarder');
        Route::get('/ajouter','ajouter')->name('users.ajouter');
        Route::put('/{id}','mettre_a_jour')->name('users.mettre_a_jour');
        Route::get('/modifier/{id}','modifier')->name('users.modifier');
        Route::get('/afficher/{id}','afficher')->name('users.afficher');
        Route::delete('/{id}','supprimer')->name('users.supprimer');
        Route::get('select','select')->name('users.select');
    });
});
