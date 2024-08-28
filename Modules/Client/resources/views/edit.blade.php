@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Client</h1>

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Client Name</label>
            <input type="text" name="client_name" id="name" class="form-control" value="{{ old('name', $client->client_name) }}" required>
        </div>

        <div class="form-group">
            <label for="facility_level">Facility Level</label>
            <select name="facility_level" id="facility_level" class="form-control" required>
                <option value="">Select Facility Level</option>
                <option value="HCI" {{ $client->facility_level == 'HCI' ? 'selected' : '' }}>HCI</option>
                <option value="HCII" {{ $client->facility_level == 'HCII' ? 'selected' : '' }}>HCII</option>
                <option value="HCIII" {{ $client->facility_level == 'HCIII' ? 'selected' : '' }}>HCIII</option>
                <option value="HCIV" {{ $client->facility_level == 'HCIV' ? 'selected' : '' }}>HCIV</option>
                <option value="Referral Hospital" {{ $client->facility_level == 'Referral Hospital' ? 'selected' : '' }}>Referral Hospital</option>
                <option value="Clinic" {{ $client->facility_level == 'Clinic' ? 'selected' : '' }}>Clinic</option>
                <option value="Hospital" {{ $client->facility_level == 'Hospital' ? 'selected' : '' }}>Hospital</option>
            </select>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $client->location) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person_name">Contact Person Name</label>
            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" value="{{ old('contact_person_name', $client->contact_person_name) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person_phone">Contact Person Phone</label>
            <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control" value="{{ old('contact_person_phone', $client->contact_person_phone) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Client Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $client->email) }}" required>
        </div>

        <div class="form-group">
            <label for="support_engineer_name">Support Engineer Name</label>
            <input type="text" name="support_engineer_name" id="support_engineer_name" class="form-control" value="{{ old('support_engineer_name', $client->support_engineer_name) }}" required>
        </div>

        <div class="form-group">
            <label for="support_engineer_phone">Support Engineer Phone</label>
            <input type="text" name="support_engineer_phone" id="support_engineer_phone" class="form-control" value="{{ old('support_engineer_phone', $client->support_engineer_phone) }}" required>
        </div>

        <div class="form-group">
            <label for="support_engineer_email">Support Engineer Email</label>
            <input type="email" name="support_engineer_email" id="support_engineer_email" class="form-control" value="{{ old('support_engineer_email', $client->support_engineer_email) }}" required>
        </div>

         <!-- Updated Billing Cycle Dropdown -->
         <div class="form-group">
            <label for="billing_cycle_years">Billing Cycle (in Years)</label>
            <select name="billing_cycle_years" id="billing_cycle_years" class="form-control" required>
                <option value="">Select Billing Cycle</option>
                <option value="1 year" {{ old('billing_cycle_years', $client->billing_cycle_years) == '1 year' ? 'selected' : '' }}>1 Year</option>
                <option value="2 years" {{ old('billing_cycle_years', $client->billing_cycle_years) == '2 years' ? 'selected' : '' }}>2 Years</option>
                <option value="5 years" {{ old('billing_cycle_years', $client->billing_cycle_years) == '5 years' ? 'selected' : '' }}>5 Years</option>
            </select>
            @error('billing_cycle_years')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Client</button>
    </form>
</div>
@endsection
