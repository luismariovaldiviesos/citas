<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TratamientosController;
use App\Http\Livewire\PagosController;
use App\Http\Livewire\EstadosController;
use App\Http\Livewire\MedicosController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\ClinicaController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tratamientos', TratamientosController::class);
Route::get('/pagos', PagosController::class);
Route::get('/estados', EstadosController::class);
Route::get('/medicos', MedicosController::class);
Route::get('/usuarios', UsersController::class);

Route::get('roles', RolesController::class);
Route::get('permisos', PermisosController::class);

Route::get('asignar', AsignarController::class);

Route::get('clinica', ClinicaController::class);


