<?php

use App\Models\Materiel;
use Illuminate\Support\Facades\Route;


include __DIR__ . '/modules/auth.php';

Route::group(['middleware' => ['auth', 'locale']], function () {
    Route::get('/', [\App\Http\Controllers\TableauBordController::class,'liste'])->name('tableau_bord');
    Route::get('/cat',[\App\Http\Controllers\TableauBordController::class,'category_materiel'])->name('tableau_bord.category');


    Route::group(['prefix' => 'departement', 'controller' => \App\Http\Controllers\DepartementController::class], function () {
        Route::get('/', 'liste')->name('departements.liste');
        Route::post('/', 'sauvegarder')->name('departements.sauvegarder');
        Route::put('/{id}', 'mettre_a_jour')->name('departements.mettre_a_jour');
        Route::get('/modifier/{id}', 'modifier')->name('departements.modifier');
        Route::delete('/{id}', 'supprimer')->name('departements.supprimer');
        Route::get('/select','select')->name('departements.select');
    });
    Route::group(['prefix' => 'categorie', 'controller' => \App\Http\Controllers\CategoryController::class], function () {
        Route::get('/liste/{type}', 'liste')->name('category.liste');
        Route::post('/', 'sauvegarder')->name('category.sauvegarder');
        Route::put('/{id}', 'mettre_a_jour')->name('category.mettre_a_jour');
        Route::get('/modifier/{id}', 'modifier')->name('category.modifier');
        Route::delete('/{id}', 'supprimer')->name('category.supprimer');
        Route::get('select/{type}', 'select')->name('category.select');

    });
    Route::group(['prefix' => 'materiels', 'controller' => \App\Http\Controllers\MaterielController::class], function () {
        Route::get('/', 'liste')->name('materiels.liste');
        Route::post('/', 'sauvegarder')->name('materiels.sauvegarder');
        Route::get('/ajouter', 'ajouter')->name('materiels.ajouter');
        Route::put('/{id}', 'mettre_a_jour')->name('materiels.mettre_a_jour');
        Route::get('/modifier/{id}', 'modifier')->name('materiels.modifier');
        Route::get('/afficher/{id}', 'afficher')->name('materiels.afficher');
        Route::post('/attacher', 'attacher')->name('materiels.attacher');
        Route::post('/dettacher/{id}', 'dettacher')->name('materiels.dettacher');
        Route::delete('/{id}', 'supprimer')->name('materiels.supprimer');
        Route::get('historique/{id}', 'historique')->name('materiels.historique');
    });

    Route::group(['prefix' => 'employes', 'controller' => \App\Http\Controllers\UserController::class], function () {
        Route::get('/', 'liste')->name('users.liste');
        Route::post('/', 'sauvegarder')->name('users.sauvegarder');
        Route::get('/ajouter', 'ajouter')->name('users.ajouter');
        Route::put('/{id}', 'mettre_a_jour')->name('users.mettre_a_jour');
        Route::get('/modifier/{id}', 'modifier')->name('users.modifier');
        Route::get('/afficher/{id}', 'afficher')->name('users.afficher');
        Route::delete('/{id}', 'supprimer')->name('users.supprimer');
        Route::get('select', 'select')->name('users.select');
    });

    Route::group(['prefix' => 'locale', 'controller' => \App\Http\Controllers\LocaleController::class], function () {
        Route::get('/', 'liste')->name('locales.liste');
        Route::post('/', 'sauvegarder')->name('locales.sauvegarder');
        Route::put('/{id}', 'mettre_a_jour')->name('locales.mettre_a_jour');
        Route::get('/modifier/{id}', 'modifier')->name('locales.modifier');
        Route::delete('/{id}', 'supprimer')->name('locales.supprimer');
        Route::post('change-locale', 'change')->name('locales.change');
    });

    Route::group(['prefix' => 'licences','controller' => \App\Http\Controllers\LicenceController::class],function (){
        Route::get('/','liste')->name('licences.liste');
        Route::get('/ajouter','ajouter')->name('licences.ajouter');
        Route::get('/afficher/{id}','afficher')->name('licences.afficher');
        Route::post('/','sauvegarder')->name('licences.sauvegarder');
        Route::get('/modifier/{id}','modifier')->name('licences.modifier');
        Route::put('/mettre_a_jour/{id}','mettre_a_jour')->name('licences.mettre_a_jour');
        Route::delete('/supprimer/{id}','supprimer')->name('licences.supprimer');
        Route::post('/attacher', 'attacher')->name('licences.attacher');
        Route::post('/dettacher/{id}', 'dettacher')->name('licences.dettacher');
    });
});


