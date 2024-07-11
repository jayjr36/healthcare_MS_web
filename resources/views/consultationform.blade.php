@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Consultation Form</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('consultation.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient ID</label>
            <input type="number" class="form-control" id="patient_id" name="patient_id" required>
        </div>
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Doctor ID</label>
            <input type="number" class="form-control" id="doctor_id" name="doctor_id" required>
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
            <label for="follow_up_date" class="form-label">Follow Up Date</label>
            <input type="date" class="form-control" id="follow_up_date" name="follow_up_date">
        </div>
        <div class="mb-3">
            <label for="results" class="form-label">Results</label>
            <textarea class="form-control" id="results" name="results" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Consultation</button>
    </form>
</div>
@endsection
