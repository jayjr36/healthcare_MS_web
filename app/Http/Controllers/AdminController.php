<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorDetails;
use App\Models\Appointment;
use App\Models\Appointments;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function doctors()
    {
        $doctors = DoctorDetails::with('user')->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function appointments()
    {
        $appointments = Appointments::with(['patient', 'doctor'])->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function users()
    {
        $users = User::where('type', '!=', 'admin')->get();
        return view('admin.users', compact('users'));
    }
}

