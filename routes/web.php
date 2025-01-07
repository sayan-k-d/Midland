<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Frontend\FormController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ServicesController;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('index');

// Route::prefix('frontend')->group(function () {
Route::controller(PageController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/departments', 'departments')->name('departments');
    Route::get('/departmentDetails/{id}', 'departmentDetails')->name('department.details');
    Route::get('/services', 'services')->name('services');
    Route::get('/serviceDetails/{id}', 'serviceDetails')->name('service.details');
    Route::get('/doctors', 'doctors')->name('doctors');
    Route::get("/doctorProfile/{id}", "doctorProfile")->name("doctor-profile");
    // Route::get("/doctorProfilet2", "doctorProfilet2")->name("doctor-profile-t2");
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blogDetails/{id}', 'blogDetails')->name('blog.details');
    Route::get('/recentBlogDetails/{id}', 'recentBlogDetails')->name('blog-details-right');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/appointment', 'appointment')->name('appointment');
});

Route::controller(FormController::class)->group(function () {
    Route::post('/contact-form', 'storeContactDetail')->name('contact.store');
    Route::post('/appointment-form', 'storeAppointmentDetail')->name('appointment.store');
});
// });

Route::get('/get-doctors/{departmentId}', function ($departmentId) {
    // dd(is_numeric($departmentId));
    $doctors = Doctor::where('is_active', true)->where('is_active_department', true)->where('department', $departmentId)->get();
    $doctors = $doctors->map(function ($doctor) {
        return [
            'id' => $doctor->id,
            'doctor_name' => mb_convert_encoding($doctor->doctor_name, 'UTF-8', 'UTF-8'),
        ];
    });
    return response()->json($doctors, 200, [], JSON_INVALID_UTF8_SUBSTITUTE);
})->name('getDoctorsOfDepartment');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('admin-auth')->group(function () {

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(AdminController::class)->group(function () {
        Route::get("/dashboard", "dashboard")->name("dashboard");
        Route::get("/profile", "profile")->name("profile");
        Route::put('profile/{id}', 'profileUpdate')->name('profile.update');
        Route::get("/changePassword", "changePassword")->name("changePassword");
        Route::post('/password/update', 'updatePassword')->name('password.update');
        Route::get("/setEmail", "showEmailForm")->name("setemail");
        Route::post("/setEmail", "setEmail")->name("setemail");
    });

    Route::controller(AdminFormController::class)->group(function () {
        Route::get("/contactDetails", "getContactData")->name("contactDetails");
        Route::get("/appointmentDetails", "getAppointmentData")->name("appointmentDetails");
        Route::get('/editReschedule/{id}', 'editreschedule')->name('editReschedule');
        Route::put('/appointments/reschedule/{id}', 'reschedule')->name('appointment.reschedule');
        Route::delete('/appointments/delete/{id}', 'destroyAppointment')->name('appointment.destroy');
        Route::delete('/contact/delete/{id}', 'destroyContact')->name('contact.destroy');
    });

    Route::controller(DepartmentController::class)->group(function () {
        Route::get("/departmentDetails", "index")->name("departmentDetails");
        Route::get('/addDepartment', 'create')->name('addDepartment');
        Route::post('/department', 'store')->name('department.store');
        Route::get('/department/edit/{id}', 'edit')->name('editDepartment');
        Route::put('department/{id}', 'update')->name('department.update');
        Route::delete('/department/delete/{id}', 'destroy')->name('department.destroy');
    });

    Route::controller(ServicesController::class)->group(function () {
        Route::get("/serviceDetails", "index")->name("serviceDetails");
        Route::get('/addService', 'create')->name('addservice');
        Route::post('/service', 'store')->name('service.store');
        Route::get('/services/edit/{id}', 'edit')->name('editServices');
        Route::put('/service/{id}', 'update')->name('service.update');
        Route::delete('/services/delete/{id}', 'destroy')->name('service.destroy');
    });

    Route::controller(DoctorController::class)->group(function () {
        Route::get("/doctorDetails", "index")->name("doctorDetails");
        Route::get('/addDoctor', 'create')->name('addDoctor');
        Route::post('/doctor', 'store')->name('doctor.store');
        Route::get('/doctors/edit/{id}', 'edit')->name('editDoctors');
        Route::put('/doctor/{id}', 'update')->name('doctor.update');
        Route::delete('/doctors/delete/{id}', 'destroy')->name('doctor.destroy');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get("/blogDetails", "index")->name("blogDetails");
        Route::get('/addBlog', 'create')->name('addBlog');
        Route::post('/blog', 'store')->name('blog.store');
        Route::get('/blogs/edit/{id}', 'edit')->name('editBlogs');
        Route::put('/blog/{id}', 'update')->name('blog.update');
        Route::delete('/blogs/delete/{id}', 'destroy')->name('blog.destroy');
    });

    Route::controller(BannerController::class)->group(function () {
        Route::get('/addBanners', 'create')->name('addBanners');
        Route::get('/bannerDetails', 'index')->name('bannerDetails');
        Route::get('/banners/edit/{id}', 'edit')->name('editBanner');
        Route::post('/banners', 'store')->name('banners.store');
        Route::put('/banners/{id}', 'update')->name('banners.update');
        Route::delete('/banners/delete/{id}', 'destroy')->name('banners.destroy');
    });

    Route::post('/ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');
});
