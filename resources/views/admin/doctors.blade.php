<!-- resources/views/admin/doctors.blade.php -->

@extends('layout')

@section('content')
<div class="container">
    <h1>All Doctors</h1>
    <ul>
        @foreach($doctors as $doctor)
            <li>{{ $doctor->user->name }} -{{ $doctor->user->email }} - {{ $doctor->category }}</li>
        @endforeach
    </ul>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-block mb-3">Back to Dashboard</a>
</div>
@endsection
