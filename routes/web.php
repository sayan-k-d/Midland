<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Frontend\FormController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/frontend/about', [PageController::class, 'about'])->name('about');
Route::get('/frontend/departments', [PageController::class, 'departments'])->name('departments');
Route::get('/frontend/departmentDetails/{id}', [PageController::class, 'departmentDetails'])->name('department.details');
Route::get('/frontend/services', [PageController::class, 'services'])->name('services');
Route::get('/frontend/serviceDetails/{id}', [PageController::class, 'serviceDetails'])->name('service.details');
Route::get('/frontend/doctors', [PageController::class, 'doctors'])->name('doctors');
Route::get("/frontend/doctorProfile/{id}", [PageController::class, "doctorProfile"])->name("doctor-profile");
Route::get("/doctorProfilet2", [PageController::class, "doctorProfilet2"])->name("doctor-profile-t2");
Route::get('/frontend/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/frontend/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/frontend/contact-form', [FormController::class, 'storeContactDetail'])->name('contact.store');
Route::post('/frontend/appointment-form', [FormController::class, 'storeAppointmentDetail'])->name('appointment.store');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('admin-auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get("/dashboard", [AdminController::class, "dashboard"])->name("dashboard");
    Route::post("/setEmail", [AdminController::class, "setEmail"])->name("setemail");

    Route::get("/departmentDetails", [DepartmentController::class, "index"])->name("departmentDetails");
    Route::get('/addDepartment', [DepartmentController::class, 'create'])->name('addDepartment');
    Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('editDepartment');
    Route::put('department/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    Route::get("/serviceDetails", [ServicesController::class, "index"])->name("serviceDetails");
    Route::get('/addService', [ServicesController::class, 'create'])->name('addservice');
    Route::post('/service', [ServicesController::class, 'store'])->name('service.store');
    Route::get('/services/edit/{id}', [ServicesController::class, 'edit'])->name('editServices');
    Route::put('/service/{id}', [ServicesController::class, 'update'])->name('service.update');
    Route::delete('/services/delete/{id}', [ServicesController::class, 'destroy'])->name('service.destroy');

    Route::get("/doctorDetails", [DoctorController::class, "index"])->name("doctorDetails");
    Route::get('/addDoctor', [DoctorController::class, 'create'])->name('addDoctor');
    Route::post('/doctor', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/doctors/edit/{id}', [DoctorController::class, 'edit'])->name('editDoctors');
    Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('/doctors/delete/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
});
