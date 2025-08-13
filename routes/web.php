<?php
use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\UtilisateurController;
use App\Controllers\AuthController;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/home/index', 'HomeController@index');

Route::get('/utilisateur', 'UtilisateurController@index');
Route::get('/utilisateur/create', 'UtilisateurController@create');
Route::get('/utilisateur/view', 'UtilisateurController@view');
Route::post('/utilisateur/store', 'UtilisateurController@store');
Route::get('/utilisateur/edit', 'UtilisateurController@edit');
Route::post('/utilisateur/edit', 'UtilisateurController@update');
Route::post('/utilisateur/delete', 'UtilisateurController@delete');


Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');


Route::dispatch();

?>