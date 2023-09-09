<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});

Route::get('/kelas', [PostController::class,'dataKelas']);





// Route::get('/about', function () {
//     return view('about',[
//         "materi" => "Routing, View dan Blade Laravel",
//         "tanggal" => "31 Agustus 2023"
//     ]);
// });

Route::get('/tes', function () {
    return view('tes',[
        "materi" => "Routing, View dan Blade Laravel",
        "tanggal" => "31 Agustus 2023"
    ]);
});
