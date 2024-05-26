@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header text-white text-center" style="background-color: rgb(165, 8, 8);">
                    <h5 class="mb-0">{{ __('Profile') }}</h5>
                </div>
            
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Category: </strong> {{ $doctor->category }}
                    </div>
                    <div class="mb-3">
                        <strong>Experience: </strong> {{ $doctor->experience }}
                    </div>
                    <div class="mb-3">
                        <strong>Bio: </strong> {{ $doctor->bio_data }}
                    </div>
                    <div>
                        <strong>Status: </strong> {{ $doctor->status }}
                    </div>
                </div>
            </div>
            <div class="row px-5 py-3">
                <a class="btn btn-outline-danger px-3" href="{{route('doctor.profile.create')}}">CREATE PROFILE</a>
                <a class="btn btn-outline-danger px-3" href="{{route('doctor.profile.edit')}}">EDIT PROFILE</a>
            </div>
            
        </div>
    </div>
</div>
@endsection
