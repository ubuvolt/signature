<?php

/**
 * Main
 */
Route::get('/', 'AuthController@index');

/**
 * Login & Registration
 */
Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin');
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('dashboard', 'AuthController@dashboard');
Route::get('logout', 'AuthController@logout');

/**
 * Form
 */
Route::get('home', 'PersonsController@home');
Route::post('home', 'PersonsController@home');
Route::post('persons', 'PersonsController@persons')->name('persons');
Route::get('persons', 'PersonsController@persons');


/**
 * Comments
 */
Route::post('create', 'PersonsController@store');

Route::get('ajaxRequest', 'PersonsController@ajaxRequest');
Route::put('ajaxRequest', 'PersonsController@ajaxRequest');

Route::put('destroy', 'PersonsController@destroy');

/**
 * e-signature
 */

Route::put('saveSignature', 'ReportController@saveSignature');

/**
 * To Pdf
 */
Route::post('toPdf', 'PdfController@toPdf')->name('toPdf');
Route::get('toPdf', 'PdfController@toPdf');

