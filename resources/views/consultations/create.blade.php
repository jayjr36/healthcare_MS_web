@extends('layout')

@section('content')
<div class="container">
    <h4 class="text-center">Consultation Form</h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('consultation.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="patient_name" class="form-label">Patient Name</label>
            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
        </div>
        <div class="mb-3">
            <label for="symptoms" class="form-label">Symptoms</label>
            <textarea class="form-control" id="symptoms" name="symptoms" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="diagnosis" class="form-label">Diagnosis</label>
            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="prescription" class="form-label">Prescription</label>
            <textarea class="form-control" id="prescription" name="prescription" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Extra Details</label>
            <textarea class="form-control" id="details" name="details" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Consultation</button>
    </form>
</div>
@endsection
