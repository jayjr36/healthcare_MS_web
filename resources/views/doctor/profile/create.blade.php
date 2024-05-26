@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header text-white text-center" style="background-color: rgb(165, 8, 8);">
                    <h5 class="mb-0">{{ __('Create Profile') }}</h5>
                </div>
            
                <div class="card-body">
                    <form method="POST" action="{{ route('doctor.profile.store') }}">
                        @csrf
            
                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('Category') }}</label>
                            <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autofocus>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="experience" class="form-label">{{ __('Experience') }}</label>
                            <input id="experience" type="text" class="form-control @error('experience') is-invalid @enderror" name="experience" value="{{ old('experience') }}" required>
                            @error('experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="bio_data" class="form-label">{{ __('Bio Data') }}</label>
                            <textarea id="bio_data" class="form-control @error('bio_data') is-invalid @enderror" name="bio_data" required>{{ old('bio_data') }}</textarea>
                            @error('bio_data')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-outline-danger">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
