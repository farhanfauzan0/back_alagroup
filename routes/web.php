<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\VisimisiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
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



Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login/p', [AuthController::class, 'login_post'])->name('login.post');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('index');
    Route::get('profil/{type?}', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('profil/update/foto', [ProfilController::class, 'update_foto'])->name('profil.update.foto');

    Route::get('produk/{type?}', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('produk/insert', [ProdukController::class, 'insert'])->name('produk.insert');
    Route::post('produk/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('produk/update', [ProdukController::class, 'update'])->name('produk.update');
    Route::post('produk/delete', [ProdukController::class, 'delete'])->name('produk.delete');

    Route::get('visi_misi/{type?}', [VisimisiController::class, 'index'])->name('visimisi.index');
    Route::post('visi_misi/post', [VisimisiController::class, 'post'])->name('visimisi.post');

    Route::get('/logout', function () {
        Auth::guard('web')->logout();
        return redirect()->route('index');
    })->name('logout');
});


Route::get('/test', function () {
    DB::table('users')->insert([
        'name' => 'admin',
        'password' => Hash::make('P@ssw0rd'),
        'username' => 'admin'
    ]);
});
