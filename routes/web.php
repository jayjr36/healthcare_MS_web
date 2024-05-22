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
    Route::get('/dashboard', [DocsController::class, 'index'])->name('dashboard');
    Route::get('/doctor/appointments', [AppointmentsController::class, 'viewAppointments'])->name('doctor.appointments')->middleware('auth');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::post('/create-chat', [ChatController::class, 'createChat'])->name('start-chat');
    Route::post('/send-message/{chatId}', [ChatController::class, 'sendMessage'])->name('send-message');
    Route::get('/get-messages/{chatId}', [ChatController::class, 'getMessages']);
    Route::get('/doctor/chat', [ChatController::class, 'showChat'])->name('show-chat');
    Route::get('/', function () {
        return view('chatpage');
    })->name('get-chat');

    Route::get('/get-users', [UsersController::class, 'getUsers']); 

    

});
