<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

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


Route::get('/', [SuratController::class, 'list']);

Route::get('/tambah-surat', function () {
    return view('tambah');
});
Route::post('/simpan-surat', [SuratController::class, 'simpan']);
Route::get('/hapus-surat/{id}', [SuratController::class, 'hapus']);
Route::get('/ubah-surat/{id}', [SuratController::class, 'ubah']);
Route::post('/ubah-surat', [SuratController::class, 'rubah']);
Route::get('/tambah', [SuratController::class, 'tambah']);
Route::get('/surat',  [SuratController::class, 'surat']);
Route::post('/simpan', [SuratController::class, 'simpan']);
Route::get('/cetak', [SuratController::class, 'cetak']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
