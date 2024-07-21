<!-- resources/views/admin/appointments.blade.php -->

@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">All Appointments</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Doctor Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-lg">Back to Dashboard</a>
        <a href="{{ route('admin.appointments.download') }}" class="btn btn-outline-success btn-lg">Download Appointments</a>

    </div>
</div>
@endsection
