<?php
namespace App\Http\Controllers\Auth;

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ScheduleController;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VideoCallController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ConsultationController;


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


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboardview', [DocsController::class, 'index'])->name('dashboardview');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/doctor/appointments', [AppointmentsController::class, 'viewAppointments'])->name('doctor.appointments')->middleware('auth');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/get-users', [UsersController::class, 'getUsers']);

    Route::get('/users', [UsersController::class, 'indexChat'])->name('users.index');
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/chats/{user}', [ChatController::class, 'show'])->name('chats.show');
    Route::post('/chats/send', [ChatController::class, 'send'])->name('chats.send');
    Route::get('chats/{userId}', [ChatController::class, 'fetchMessages'])->name('chats.messages');


    Route::get('/profile', [DocsController::class, 'showProfile'])->name('doctor.profile');
    Route::get('/profile/create', [DocsController::class, 'createProfile'])->name('doctor.profile.create');
    Route::post('/profile', [DocsController::class, 'storeProfile'])->name('doctor.profile.store');
    Route::get('/profile/edit', [DocsController::class, 'editProfile'])->name('doctor.profile.edit');
    Route::put('/profile', [DocsController::class, 'updateProfile'])->name('doctor.profile.update');

    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::patch('/appointments/{appointment}/cancel', [AppointmentsController::class, 'cancel'])->name('appointments.cancel');
    Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

    Route::get('/appointments/create', [AppointmentsController::class, 'createAppointmentByAdmin'])->name('appointments.create');
    Route::post('/appointments', [AppointmentsController::class, 'storeAppointmentByAdmin'])->name('appointments.store');
    Route::get('/appointments', [AppointmentsController::class, 'indexAppointmentByAdmin'])->name('appointments.index');

    Route::get('/doctors', [DocsController::class, 'showDoctors'])->name('doctors.index');
    Route::post('/doctors/{id}/toggle-verification', [DocsController::class, 'toggleVerification'])->name('doctors.toggle-verification');
    Route::post('/doctors/{id}/update-status', [DocsController::class, 'updateStatus'])->name('doctors.update-status');

    Route::get('/video-call', function () {
    return view('videocall');
    })->name('videocall');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/doctors', [AdminController::class, 'doctors'])->name('admin.doctors');
Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');



Route::get('/consultation/create', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultation.index');
Route::get('/consultation/{id}', [ConsultationController::class, 'show'])->name('consultation.show');

Route::delete('/doctors/{id}', [DocsController::class, 'destroy'])->name('doctors.destroy');

Route::get('/admin/appointments/download', [AdminController::class, 'downloadAppointments'])->name('admin.appointments.download');

});

