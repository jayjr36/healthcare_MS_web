<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorDetails;
use App\Models\Appointment;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function downloadAppointments() {
        $appointments = Appointments::with(['patient', 'doctor'])->get();
        $pdf = PDF::loadView('admin.appointments_pdf', compact('appointments'));
        return $pdf->download('appointments.pdf');
    }

// app/Http/Controllers/AdminController.php

public function doctors()
{
    $appointments = Appointments::all();
    return view('admin.doctors', compact('appointments'));
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

