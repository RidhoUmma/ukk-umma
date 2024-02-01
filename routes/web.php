<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Models\Barang;
use App\Models\Transaksi;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::group(['middleware' => ['auth', 'CheckRole:admin,kasir']], function() {
//  Route::middleware('auth')->group(function () {
//     // Route yang memerlukan autentikasi di sini
//     // Route::get("/index", [HomeController::class, 'index']);
//     Route::resource("/redirect", HomeController::class);
// });

// Route::group(['middleware' => ['auth', 'CheckRole:admin']], function(){
//      Route::get("/home", [HomeController::class, 'index']);
// });
// // Route untuk proses login dan logout
Route::group(['middleware' => ['guest']], function () {

    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
});
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Role admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.admin');
    // crud user
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);
    // crud jenis barang
    Route::get('/jenisbarang', [JenisBarangController::class, 'index']);
    Route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
    Route::post('/jenisbarang/update/{id}', [JenisBarangController::class, 'update']);
    Route::get('/jenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);
    Route::get('/jenisbarang/checkReference/{id}', [JenisBarangController::class, 'checkReference']);
    // crud  barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/update/{id}', [BarangController::class, 'update']);
    Route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);
    //   laporan
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
    // setting diskon
    Route::get('/setdiskon', [DiskonController::class, 'index']);
    Route::post('/setdiskon/update/{id}', [DiskonController::class, 'update']);
    // profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile/updateprofile/{id}', [UserController::class, 'updateprofile']);
    // ... tambahkan rute lain yang ingin Anda tentukan untuk peran admin di sini
});

// Role kasir
Route::group(['middleware' => ['auth', 'role:kasir,admin']], function () {

    Route::get('/kasir', [HomeController::class, 'index'])->name('kasir.kasir');
    // profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile/updateprofile/{id}', [UserController::class, 'updateprofile']);
    // transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/transaksi/tambahBarang', [TransaksiController::class, 'tambahBarang'])->name('transaksi.tambahBarang');
    Route::post('/transaksi/store', [TransaksiController::class, 'store']);

    // ... tambahkan rute lain yang ingin Anda tentukan untuk peran admin di sini
});

// Route::group(['middleware' => ['auth', 'CheckRole:admin,kasir']], function(){
//     Route::get('/user',[UserController::class,'index']);
//     Route::post('/user/store',[UserController::class,'store']);
//     Route::post('/user/update/{id}',[UserController::class,'update']);
//     Route::get('/user/destroy/{id}',[UserController::class,'destroy']);
// });
