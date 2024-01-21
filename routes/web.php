<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Model Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'landing.home')->name('home');

Route::view('/test', 'table.table');

Route::get('/lang/{locale}', function($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

Route::controller(UserController::class)->prefix('user')->group(function() {
    //Basic Actions
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth');
    Route::post('/create', 'create');

    //Views
    Route::view('/signup', 'user.signup');
    Route::view('/', 'user.login')->name('user.login');
    Route::get('/administration/guests', 'guestsView')->middleware('auth');
    Route::view('/administration/tables', 'tablesView')->middleware('auth');
});

Route::controller(GuestController::class)->prefix('guest')->group(function() {
    //Basic Actions
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::any('/filter', 'filter');
    Route::get('/delete/{guest_id}', 'delete');
    Route::post('/search', 'search');

    //Views
    Route::get('/', 'landing')->name('guest.landing');
    Route::get('/edit', 'edit');
    Route::view('/thanks', 'guest.thanks');
    
    //API
    Route::get('/data', 'data');
    Route::post('/validate', 'validationToJson');
    Route::post('/multivalidate', 'multiGuestValidation');
});

Route::controller(TableController::class)->prefix('table')->group(function() {
    //Basic Actions
    Route::post('/create', 'create');
    Route::get('/delete/{table_id}', 'delete');

    //API
    Route::get('/data', 'data');
});