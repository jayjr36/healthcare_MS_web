<!-- resources/views/admin/dashboard.blade.php -->

@extends('layout')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row">
        {{-- <div class="col">
            <a href="{{ route('admin.doctors') }}" class="btn btn-outline-danger btn-block mb-3">Manage Doctors</a>
        </div> --}}
        <div class="col">
            <a href="{{ route('admin.appointments') }}" class="btn btn-outline-danger btn-block mb-3">Manage Appointments</a>
        </div>
        <div class="col">
            <a href="{{ route('admin.users') }}" class="btn btn-outline-danger btn-block mb-3">Manage Users</a>
        </div>
    </div>
</div>
@endsection
