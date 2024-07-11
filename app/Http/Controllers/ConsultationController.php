<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function create()
{
    return view('consultations.create');
}

public function store(Request $request)
{
    $request->validate([
        'patient_name' => 'required|string',
        'symptoms' => 'required|string',
        'diagnosis' => 'required|string',
        'prescription' => 'required|string',
        'details' => 'required|string',
    ]);

    $doctor_id = Auth::id();

    Consultation::create([
        'patient_name' => $request->patient_name,
        'doctor_id' => $doctor_id,
        'symptoms' => $request->symptoms,
        'diagnosis' => $request->diagnosis,
        'prescription' => $request->prescription,
        'details' => $request->details,
    ]);

    return redirect()->route('consultation.create')->with('success', 'Consultation saved successfully.');
}

public function show($id)
{
    $consultation = Consultation::with('doctor')->findOrFail($id);
    return view('consultations.show', compact('consultation'));
}


public function index()
{
    $consultations = Consultation::with('doctor')->get();
    return view('consultations.index', compact('consultations'));
}


}
