<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Frontend\FormController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/departments', [PageController::class, 'departments'])->name('departments');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/doctors', [PageController::class, 'doctors'])->name('doctors');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact-form', [FormController::class, 'storeContactDetail'])->name('contact.store');
Route::post('/appointment-form', [FormController::class, 'storeAppointmentDetail'])->name('appointment.store');

Route::get("/dashboard", [AdminController::class, "getData"])->name("dashboard");
Route::post("/setEmail", [AdminController::class, "setEmail"])->name("setemail");
Route::get('/addDepartment', [DepartmentController::class, 'create'])->name('addDepartment');
Route::get("/departmentDetails", [DepartmentController::class, "index"])->name("departmentDetails");
Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('editDepartment');
Route::put('department/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

Route::get('/addService', [ServicesController::class, 'create'])->name('addservice');
Route::get("/serviceDetails", [ServicesController::class, "index"])->name("serviceDetails");
Route::post('/service', [ServicesController::class, 'store'])->name('service.store');
Route::get('/services/edit/{id}', [ServicesController::class, 'edit'])->name('editServices');
Route::put('/service/{id}', [ServicesController::class, 'update'])->name('service.update');
Route::delete('/services/delete/{id}', [ServicesController::class, 'destroy'])->name('service.destroy');
