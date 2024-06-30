@extends('layout')

@section('content')
    <div class="container-fluid py-3">
        <div class="row pt-2">
            <div class="col-3 pt-5 d-flex flex-column align-items-center justify-content-center" style="height: 100vh; background-color:rgb(165, 8, 8);">
                <div class="d-flex flex-column align-items-center">
                    <img src="https://th.bing.com/th/id/OIP.1a2ofVr-orNHCw-lCArGOgHaI1?rs=1&pid=ImgDetMain" alt="IMAGE" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="font-semibold text-xl text-white text-center mt-4">MEET YOUR DOCTOR</h5>
                </div>            
                <div class="col ">
                    <div class="col">
                        <a href="{{ route('dashboardview') }}" target="iframe" class="btn btn-outline-light btn-block mb-3">Dashboard</a>
                    </div>
                    @if(auth()->user()->type === 'admin')
                    
                    <div class="col">
                        <a href="{{ route('admin.dashboard') }}" target="iframe"
                            class="btn btn-outline-light btn-block mb-3">Dashboard</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('doctors.index') }}" target="iframe"
                            class="btn btn-outline-light btn-block mb-3">All Doctors</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('appointments.create') }}" target="iframe"
                            class="btn btn-outline-light btn-block mb-3">Create Appointments</a>
                    </div>
                     @endif
                    <div class="col">
                        <a href="{{ route('doctor.appointments') }}" target="iframe"
                            class="btn btn-outline-light btn-block mb-3">Appointments</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('schedules.index') }}" target="iframe" class="btn btn-outline-light btn-block mb-3">Schedule</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('users.index') }}" target="iframe" class="btn btn-outline-light btn-block mb-3">Messages</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('doctor.profile') }}" target="iframe" class="btn btn-outline-light btn-block mb-3">Profile</a>
                    </div>
                    <div class="col">
                        <a href="{{ route('videocall') }}" target="iframe" class="btn btn-outline-light btn-block mb-3">Video Call</a>
                    </div>
                    <div class="col">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="ml-auto">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-block mb-3">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                @if(auth()->user()->type === 'doctor')
             <iframe src="{{route('dashboardview')}}" frameborder="0" name="iframe"  style="height:100vh; width: 100%"></iframe>
            @endif
             @if(auth()->user()->type === 'admin')
             <iframe src="{{route('admin.dashboard')}}" frameborder="0" name="iframe"  style="height:100vh; width: 100%"></iframe>
      
             @endif
            </div>
        </div>
    </div>
@endsection