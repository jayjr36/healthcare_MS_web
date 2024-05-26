<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Appointments;
use Illuminate\Http\Request;
use App\Models\DoctorDetails;
use Illuminate\Support\Facades\Auth;

class DocsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = Auth::user();
        $appointments = Appointments::where('doctor_id', $doctor->id)->where('status', 'upcoming')->get();
        $reviews = Reviews::Where('doctor_id', $doctor->id)->where('status', 'active')->get();

        return view('board')->with(['doctor'=>$doctor, 'appointments'=>$appointments, 'reviews'=>$reviews]);
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
        $reviews = new Reviews();
        $appointment = Appointments::where('id', $request->get('appointment_id'))->first();

        $reviews->user_id = Auth::user()->id;
        $reviews->doctor_id = $request->get('doctor_id');
        $reviews->ratings = $request->get('ratings');
        $reviews->reviews = $request->get('reviews');
        $reviews->reviewed_by = Auth::user()->name;
        $reviews->status = 'active';
        $reviews->save();

        $appointment->status = "complete";
        $appointment->save();

        return response()->json([
            'success'=>'The appointment has been completed and reviewed successfully!',
        ], 200);
    }

    public function showProfile()
    {
        $doctor = auth()->user()->doctor;
        return view('doctor.profile.show', compact('doctor'));
    }

    public function createProfile()
    {
        return view('doctor.profile.create');
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'experience' => 'required',
            'bio_data' => 'required',
            'status' => 'required',
        ]);

        $doctor = new DoctorDetails([
            'doctor_id' => auth()->id(),
            'category' => $request->category,
            'experience' => $request->experience,
            'bio_data' => $request->bio_data,
            'status' => $request->status,
        ]);

        $doctor->save();

        return redirect()->route('doctor.profile')->with('success', 'Profile created successfully!');
    }

    public function editProfile()
    {
        $doctor = auth()->user()->doctor;
        return view('doctor.profile.edit', compact('doctor'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'experience' => 'required',
            'bio_data' => 'required',
            'status' => 'required',
        ]);

        $doctor = auth()->user()->doctor;
        $doctor->update([
            'category' => $request->category,
            'experience' => $request->experience,
            'bio_data' => $request->bio_data,
            'status' => $request->status,
        ]);

        return redirect()->route('doctor.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
