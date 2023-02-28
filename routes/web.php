<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RolesMenuController;

use App\Http\Controllers\UsuarioLoginPermisonController;
// use App\Http\Controllers\PruebaController;

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
// Route::get('prueba', UsuarioLoginPermisonController::class);
Route::group(['middleware' => ['auth','access']], function(){
//Route::resource('roles', RolController::class);

Route::resource('roles', RolesController::class);
Route::resource('rolesmenu', RolesMenuController::class);
Route::resource('usuarios', UsuarioController::class);
// Route::resource('prueba', PruebaController::class);

Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios');
Route::resource('menus', MenuController::class);

});


    /*Route::get('/menus', [App\Http\Controllers\HomeController::class, 'menus.index'])->name('index');
    Route::get('/crear', [App\Http\Controllers\HomeController::class, 'crear'])->name('crear');
    Route::get('/eeditar', [App\Http\Controllers\HomeController::class, 'editar'])->name('editar');
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');*/
