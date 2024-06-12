<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UsersController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboardview', [DocsController::class,'index'])->name('dashboardview');
   
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');
    Route::get('/doctor/appointments', [AppointmentsController::class, 'viewAppointments'])->name('doctor.appointments')->middleware('auth');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    // Route::post('/create-chat', [ChatController::class, 'createChat'])->name('start-chat');
    // Route::post('/send-message/{chatId}', [ChatController::class, 'sendMessage'])->name('send-message');
    // Route::get('/get-messages/{chatId}', [ChatController::class, 'getMessages']);
    // Route::get('/doctor/chat', [ChatController::class, 'showChat'])->name('show-chat');
    // Route::get('/', function () {
    //     return view('chatpage');
    // })->name('get-chat');

    Route::get('/get-users', [UsersController::class, 'getUsers']); 

Route::get('/users', [UsersController::class, 'indexChat'])->name('users.index');
Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
//Route::get('/chats/{user}', [ChatController::class, 'show'])->name('chats.show');
Route::post('/chats/send', [ChatController::class, 'send'])->name('chats.send');
Route::get('chats/{userId}', [ChatController::class, 'fetchMessages'])->name('chats.show');


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

});
