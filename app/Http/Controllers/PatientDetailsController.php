<?php
namespace App\Http\Controllers;

use App\Models\PatientDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDetailsController extends Controller
{
    public function show()
    {
        $patientDetails = PatientDetails::where('user_id', Auth::id())->first();
        return response()->json($patientDetails);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'blood_group' => 'required|string|max:3',
            'marital_status' => 'required|string|max:10',
            'height' => 'required|string|max:5',
            'weight' => 'required|string|max:5',
        ]);

        $patientDetails = PatientDetails::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->all()
        );

        return response()->json($patientDetails, 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'blood_group' => 'required|string|max:3',
            'marital_status' => 'required|string|max:10',
            'height' => 'required|string|max:5',
            'weight' => 'required|string|max:5',
        ]);

        $patientDetails = PatientDetails::where('user_id', Auth::id())->first();

        if ($patientDetails) {
            $patientDetails->update($request->all());
            return response()->json($patientDetails, 200);
        }

        return response()->json(['message' => 'Patient details not found'], 404);
    }
}
