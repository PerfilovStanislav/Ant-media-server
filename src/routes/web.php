<?php

use Illuminate\Support\Facades\Route as R;
use \Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    HomeController,
    StreamController,
};

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

Auth::routes();
R::get('/home', [HomeController::class, 'index'])->name('home');

R::get('/', [StreamController::class, 'index'])->name('stream_list');

R::group(['prefix' => 'stream', 'as' => 'stream.'], static function () {
    R::get('/index', [StreamController::class, 'index'])->name('index');

    R::get('/view/{stream}', [StreamController::class, 'view'])->name('view');

    R::group(['middleware' => 'auth'], static function () {
        R::get('/add_form', [StreamController::class, 'viewAddPage']);
        R::post('/store', [StreamController::class, 'store'])->name('add.post');
    });
});
