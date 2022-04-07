<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\masterController;

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

Route::get('/live', function () {
    return view('livewire.index');
});



Route::get('/dashboard', [masterController::class, 'fetchEmployee'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('add-new-master-employee', [masterController::class, 'addMasterEmployee'])->name('add-new-master-employee');
Route::post('delete-employee', [masterController::class, 'deleteEmployee'])->name('delete-employee');
Route::get('fetch-employee-table', [masterController::class, 'fetchEmployeeTable'])->name('fetch-employee-table');
Route::post('get-employee', [masterController::class, 'getEmployee'])->name('get-employee');
Route::post('add-edit-employee', [masterController::class, 'editEmployee'])->name('add-edit-employee');
Route::get('wire', [masterController::class, 'crudWire'])->name('wire');

