<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // user
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/profile/new-profile', [\App\Http\Controllers\UserController::class, 'create'])->name('createProfile');
    Route::post('/profile/new-profile', [\App\Http\Controllers\UserController::class, 'store'])->name('addNewUser');
    Route::get('/profile/user/{id}', [\App\Http\Controllers\UserController::class, 'show']);
    Route::get('/profile/edit-profile/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('editProfile');
    Route::put('/profile/edit-profile/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('updateProfile');
    Route::delete('/profile/delete/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);

  // doctor

    Route::put('/profile/doctor/bio/{id}', [\App\Http\Controllers\DoctorController::class, 'update'])->name('editBio');
    Route::get('/appointments/choose-patients', [\App\Http\Controllers\DoctorController::class, 'choosePatient'])->name('choosePatient');
    Route::post('/appointments/choose-patients/{id}', [\App\Http\Controllers\DoctorController::class, 'selectPatient'])->name('selectPatient');



    // patients

    Route::put('/profile/patient/healthId/{id}', [\App\Http\Controllers\PatientController::class, 'update'] )->name('healthIdEdit');

    //prices
    Route::get('/prices', [\App\Http\Controllers\PriceController::class, 'index'])->name('priceList');
    Route::get('prices/create', [\App\Http\Controllers\PriceController::class, 'create'])->name('addPrice');
    Route::post('/prices', [\App\Http\Controllers\PriceController::class, 'store'])->name('createPrice');
    Route::get('/prices/{id}/edit', [\App\Http\Controllers\PriceController::class, 'edit'])->name('editPrice');
    Route::put('/prices/{id}', [\App\Http\Controllers\PriceController::class, 'update'])->name('updatePrice');
    Route::get('/prices/{id}', [\App\Http\Controllers\PriceController::class, 'destroy'])->name('deletePrice');

    // appointments
    Route::get('/appointments/my-appointments', [\App\Http\Controllers\AppointmentController::class, 'index'])->name('myAppointments');
    Route::get('/appointments', [\App\Http\Controllers\AppointmentController::class, 'create'])->name('makeAppointment');
    Route::post('/appointments', [\App\Http\Controllers\AppointmentController::class, 'store'])->name('createAppointment');
    Route::get('/appointments/{id}/edit', [\App\Http\Controllers\AppointmentController::class, 'edit'])->name('editAppointment');
   // Route::put('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class, 'update'])->name
    //('updateAppointment');
    Route::get('/appointments/{id}', [\App\Http\Controllers\AppointmentController::class, 'show'])->name('showAppointment');

    Route::resource('/payments', \App\Http\Controllers\PaymentController::class);

    Route::get('/reports/myPayments', \App\Http\Controllers\MyPayments::class)->name('myPayments');

    //examinations

    Route::resource('/examinations', \App\Http\Controllers\ExaminationController::class);


    Route::get('/downloadCsv', [\App\Http\Controllers\PaymentController::class, 'getReport'])->name('csv');


});

require __DIR__.'/auth.php';
