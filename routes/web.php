<?php
use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\UtilisateurController;
use App\Controllers\AuthController;
use App\Controllers\TimbreController;
use App\Controllers\ImagesController;
use App\Controllers\EnchereController;
use App\Controllers\MiseController;
use App\Controllers\Favorie_enchereController;

//Routes pour la page accueil
Route::get('', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/home/index', 'HomeController@index');

// Routes pour les utilisateurs
Route::get('/utilisateur', 'UtilisateurController@index');
Route::get('/utilisateur/create', 'UtilisateurController@create');
Route::get('/utilisateur/view', 'UtilisateurController@view');
Route::post('/utilisateur/store', 'UtilisateurController@store');
Route::get('/utilisateur/edit', 'UtilisateurController@edit');
Route::post('/utilisateur/edit', 'UtilisateurController@update');
Route::post('/utilisateur/delete', 'UtilisateurController@delete');

//Routes pour les timbres
Route::get('/timbre', 'TimbreController@index');
Route::get('/timbre/create', 'TimbreController@create');
Route::get('/timbre/view', 'TimbreController@view');
Route::post('/timbre/store', 'TimbreController@store');
Route::get('/timbre/edit', 'TimbreController@edit');
Route::post('/timbre/edit', 'TimbreController@update');
Route::post('/timbre/delete', 'TimbreController@delete');

//Routes pour les images
Route::get('/images', 'ImagesController@index');
Route::get('/images/create', 'ImagesController@create');
Route::get('/images/view', 'ImagesController@view');
Route::post('/images/store', 'ImagesController@store');
Route::get('/images/edit', 'ImagesController@edit');
Route::post('/images/edit', 'ImagesController@update');
Route::post('/images/delete', 'ImagesController@delete');

// Routes pour  les mises
Route::get('/mise', 'MiseController@index');
Route::post('/mise/store', 'MiseController@store');

// Routes pour  les encheres
Route::get('/enchere', 'EnchereController@index');
Route::get('/enchere/view', 'EnchereController@view');

// Routes pour  les encheres favories
Route::get('/favorie', 'FavorieController@index');
Route::post('/favorie/store', 'FavorieController@store');
Route::post('/favorie/delete', 'FavorieController@delete');

//Routes pour l'authentification
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');


Route::dispatch();

?>