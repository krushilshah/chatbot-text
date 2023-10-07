<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\translateController;
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
    return view('auth.login');
});
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [translateController::class, 'dashboard'])->name('dashboard');

});



Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

// Route::get('/auth/{provider}/callback', [GoogleController::class , 'getImages']); 
Route::get('/google', [GoogleController::class, 'getImages'])->name('google.photos');
Route::get('/google/callback', 'GoogleController@authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Translate Api 
    Route::get('/language', [translateController::class, 'selectLanguage'])->name('selectLanguage');
    Route::post('/store/language', [translateController::class, 'storeLanguage'])->name('storeLanguage');
    Route::post('/get/userData', [translateController::class, 'getUserData'])->name('getUserData');
    Route::get('/translate', [translateController::class, 'translate'])->name('translate');
});

require __DIR__ . '/auth.php';
