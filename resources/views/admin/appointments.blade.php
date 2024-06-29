<!-- resources/views/admin/appointments.blade.php -->

@extends('layout')

@section('content')
<div class="container">
    <h1>All Appointments</h1>
    <ul>
        @foreach($appointments as $appointment)
            <li>{{ $appointment->date }} - {{ $appointment->patient->name }}- {{ $appointment->doctor->name }}</li>
        @endforeach
    </ul>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-block mb-3">Back to Dashboard</a>
</div>
@endsection