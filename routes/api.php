<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoCallController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PatientDetailsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);

Route::get('/doctors/{doctorId}/review-count', [DocsController::class, 'getDoctorReviewCount']);
Route::patch('/appointments/{appointment}/cancel', [AppointmentsController::class, 'cancelApi']);
Route::get('/all/reviews', [DocsController::class, 'getAllReviews']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UsersController::class, 'index']);
    Route::post('/book', [AppointmentsController::class, 'store']);
    Route::post('/reviews', [DocsController::class, 'store']);
    Route::get('/appointments', [AppointmentsController::class, 'index']);
    Route::get('/appointments/canceled', [AppointmentsController::class, 'canceledAppointments']);
    Route::get('/appointments/completed', [AppointmentsController::class, 'completedAppointments']);


    Route::get('/doctor/schedules', [ScheduleController::class, 'getDoctorSchedules']);
    Route::get('/schedules', [ScheduleController::class, 'getAllDoctorSchedules']);

    Route::post('/create-chat', [ChatController::class, 'createChat']);
    Route::post('/send-message/{chatId}', [ChatController::class, 'sendMessage']);
    Route::get('/get-messages/{chatId}', [ChatController::class, 'getMessages']);
    Route::get('/get-users', [UsersController::class, 'getUsers']);

    Route::get('/users', [UsersController::class, 'apiIndex']);
    Route::get('/chats', [ChatController::class, 'apiIndex']);
    Route::get('/chats/{user}', [ChatController::class, 'apiShow']);
    Route::post('/chats/send', [ChatController::class, 'apiSend']);

    Route::get('/show/patient-details', [PatientDetailsController::class, 'show']);
    Route::post('/store/patient-details', [PatientDetailsController::class, 'store']);
    Route::put('/update/patient-details', [PatientDetailsController::class, 'update']);

    Route::post('/start-call', [VideoCallController::class, 'startCall']);
    Route::post('/end-call', [VideoCallController::class, 'endCall']);
});