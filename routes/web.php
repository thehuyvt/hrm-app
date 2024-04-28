<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('countries/create', [CountryController::class, 'create'])->name('countries.create');
Route::post('countries/store', [CountryController::class, 'store'])->name('countries.store');
Route::get('countries/edit/{countryId}', [CountryController::class, 'edit'])->name('countries.edit');
Route::put('countries/update/{countryId}', [CountryController::class, 'update'])->name('countries.update');
Route::delete('countries/destroy/{countryId}', [CountryController::class, 'destroy'])->name('countries.destroy');


Route::resource('users', UserController::class);

Route::resource('companies', CompanyController::class);

//Route::resource('roles', RoleController::class);

Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/edit/{roleId}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('roles/update/{roleId}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('roles/destroy/{roleId}', [RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('departments/create/{companyId}', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('departments/edit/{departmentId}', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('departments/update/{departmentId}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('departments/destroy/{departmentId}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

Route::resource('projects', ProjectController::class);
Route::get('tasks/printPdf', [TaskController::class, 'printPdf'])->name('tasks.printPdf');

Route::resource('tasks', TaskController::class);
