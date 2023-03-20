<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('main');
})->name('main');

// <--- autos --->

Route::get('autos', [App\Http\Controllers\AutoController::class, 'index'])
->name('auto.index');

Route::get('autos/{merk}', [App\Http\Controllers\AutoController::class, 'indexMerk'])
->name('auto.indexMerk');

Route::get('autos/{merk}/{model}', [App\Http\Controllers\AutoController::class, 'indexMerkModel'])
->name('auto.indexMerkModel');

Route::get('/autos/{merk}/{model}/{auto}', [App\Http\Controllers\AutoController::class, 'show'])
->name('auto.show');

Route::get('/auto/create', [App\Http\Controllers\AutoController::class, 'create'])
->middleware(['auth'])
->name('auto.create');

Route::post('/auto/store', [App\Http\Controllers\AutoController::class, 'store'])
->middleware(['auth'])
->name('auto.store'); 


Route::put('/autos/{merk}/{model}/{auto}/change', [App\Http\Controllers\AutoController::class, 'update'])
->middleware(['auth'])
->name('auto.change');

Route::put('/autos/{merk}/{model}/{auto}/update', [App\Http\Controllers\AutoController::class, 'update'])
->middleware(['auth'])
->name('auto.update');

Route::delete('/autos/{merk}/{model}/{auto}/delete', [App\Http\Controllers\AutoController::class, 'delete'])
->middleware(['auth'])
->name('auto.delete');

// <--------->
// <--- main pagina tekst --->

Route::get('/tekst/update', [App\Http\Controllers\TekstController::class, 'update'])
->middleware(['auth'])
->name('tekst.update'); 

Route::put('/tekst/{tekst}/store', [App\Http\Controllers\TekstController::class, 'store'])
->middleware(['auth'])
->name('tekst.store'); 

// <--------->
// <--- ContactGegevens --->

Route::get('/contactGegevens/update', [App\Http\Controllers\ContactGegevensController::class, 'update'])
->middleware(['auth'])
->name('contactGegevens.update'); 

Route::put('/contactGegevens/{contactGegevens}/store', [App\Http\Controllers\ContactGegevensController::class, 'store'])
->middleware(['auth'])
->name('contactGegevens.store'); 

// <--------->
require __DIR__.'/auth.php';
