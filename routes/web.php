<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteOrderController;
use App\Http\Controllers\NoteSearchController;
use App\Http\Controllers\NoteTagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/vk', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('auth/vk/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);


Route::middleware('auth')->group(function () {
    Route::resource('notes', NoteController::class);
    Route::get('/tags/{tag}/notes', [NoteTagController::class, 'index'])->name('notes.byTag');
    Route::get('search', [NoteSearchController::class, 'search'])->name('notes.search');


});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
