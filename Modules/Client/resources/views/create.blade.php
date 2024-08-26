@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Client</h1>

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Client Name</label>
            <input type="text" name="client_name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="facility_level">Facility Level</label>
            <select name="facility_level" id="facility_level" class="form-control" required>
                <option value="">Select Facility Level</option>
                <option value="HCI">HCI</option>
                <option value="HCII">HCII</option>
                <option value="HCIII">HCIII</option>
                <option value="HCIV">HCIV</option>
                <option value="Referral Hospital">Referral Hospital</option>
                <option value="Clinic">Clinic</option>
                <option value="Hospital">Hospital</option>
            </select>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person_name">Contact Person Name</label>
            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" value="{{ old('contact_person_name') }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person_phone">Contact Person Phone</label>
            <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control" value="{{ old('contact_person_phone') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Client Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="support_engineer_name">Support Engineer Name</label>
            <input type="text" name="support_engineer_name" id="support_engineer_name" class="form-control" value="{{ old('support_engineer_name') }}" required>
        </div>

        <div class="form-group">
            <label for="support_engineer_phone">Support Engineer Phone</label>
            <input type="text" name="support_engineer_phone" id="support_engineer_phone" class="form-control" value="{{ old('support_engineer_phone') }}" required>
        </div>

        <div class="form-group">
            <label for="support_engineer_email">Support Engineer Email</label>
            <input type="email" name="support_engineer_email" id="support_engineer_email" class="form-control" value="{{ old('support_engineer_email') }}" required>
        </div>

        <div class="form-group">
            <label for="billing_cycle_years">Billing Cycle (in Years)</label>
            <input type="number" name="billing_cycle_years" id="billing_cycle_years" class="form-control" value="{{ old('billing_cycle_years') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Create Client</button>
    </form>
</div>
@endsection
