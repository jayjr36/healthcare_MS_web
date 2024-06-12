<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointments::where('patient_id', Auth::user()->id)
                                    // ->where('status', 'upcoming')
                                    ->get();

        foreach ($appointments as $appointment) {
            $doctor = User::find($appointment->doctor_id);
            if ($doctor) {
                $doctorDetail = $doctor->doctorDetail;
                $appointment->doctor_name = $doctor->name;
                $appointment->doctor_profile = $doctor->profile_photo_url;
                $appointment->category = $doctorDetail->category ?? 'N/A';
            }
        }

        return $appointments;
    }

    public function canceledAppointments()
    {
        $appointments = Appointments::where('patient_id', Auth::user()->id)
                                    ->where('status', 'cancelled')
                                    ->get();

        foreach ($appointments as $appointment) {
            $doctor = User::find($appointment->doctor_id);
            if ($doctor) {
                $doctorDetail = $doctor->doctorDetail;
                $appointment->doctor_name = $doctor->name;
                $appointment->doctor_profile = $doctor->profile_photo_url;
                $appointment->category = $doctorDetail->category ?? 'N/A';
            }
        }

        return $appointments;
    }

    public function completedAppointments()
    {
        $appointments = Appointments::where('patient_id', Auth::user()->id)
                                    ->where('status', 'completed')
                                    ->get();

        foreach ($appointments as $appointment) {
            $doctor = User::find($appointment->doctor_id);
            if ($doctor) {
                $doctorDetail = $doctor->doctorDetail;
                $appointment->doctor_name = $doctor->name;
                $appointment->doctor_profile = $doctor->profile_photo_url;
                $appointment->category = $doctorDetail->category ?? 'N/A';
            }
        }

        return $appointments;
    }

    public function viewAppointments()
    {
        $doctor_id = Auth::user()->id;
        $appointments = Appointments::where('doctor_id', $doctor_id)->get();

        foreach ($appointments as $appointment) {
            $patient = User::find($appointment->patient_id);
            $appointment->patient_name = $patient->name;
            $appointment->patient_profile = $patient->profile_photo_url;
        }

        return view('appointments', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $appointment = new Appointments();
        $appointment->patient_id = Auth::user()->id;
        $appointment->doctor_id = $request->get('doctor_id');
        $appointment->date = $request->get('date');
        $appointment->day = $request->get('day');
        $appointment->time = $request->get('time');
        $appointment->status = 'upcoming';
        $appointment->save();

        return response()->json([
            'success'=>"New Appointment has been made successfully",
        ], 200);
    }

    public function cancel($id)
{
    $appointment = Appointments::find($id);
    if ($appointment) {
        $appointment->status = 'Cancelled';
        $appointment->save();
        return redirect()->route('appointments')->with('success', 'Appointment cancelled successfully.');
    }
    return redirect()->route('appointments')->with('error', 'Appointment not found.');
}

public function createAppointmentByAdmin()
{
    $doctors = User::where('type', 'doctor')->get();
    $patients = User::where('type', 'user')->get();
    return view('appointments.create', compact('doctors', 'patients'));
}

public function storeAppointmentByAdmin(Request $request)
{
    $request->validate([
        'patient_id' => 'required|exists:users,id',
        'doctor_id' => 'required|exists:users,id',
        'date' => 'required|date',
        'day' => 'required|string',
        'status'=>'required|in:upcoming',
        'time' => 'required',
    ]);

    Appointments::create($request->all());

    return redirect()->route('appointments.create')->with('success', 'Appointment created successfully.');
}

public function indexAppointmentByadmin()
{
    $appointments = Appointments::with(['patient', 'doctor'])->get();
    return view('appointments.index', compact('appointments'));
}
}
