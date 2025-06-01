<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
    session(['password_validated' => false]);
    return view('input');
});

Route::get('/daftar', function () {
    $peserta = DB::table('employees')
    ->selectRaw('*')
    ->get();
    return view('daftar', compact('peserta'));
});


Route::get('/get/peserta/{nip}', [\App\Http\Controllers\InputController::class, 'store'])->name('input.store');
Route::post('/tilok/store', [\App\Http\Controllers\InputController::class, 'storeTilok'])->name('tilok.store');
Route::post('/verify-password', [\App\Http\Controllers\InputController::class, 'verifyPassword'])->name('peserta.verify_password');
