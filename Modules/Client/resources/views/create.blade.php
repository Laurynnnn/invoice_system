@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Client</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Client Name</label>
                    <input type="text" name="client_name" id="name" class="form-control" value="{{ old('client_name') }}" required>
                    @error('client_name')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="facility_level">Facility Level</label>
                    <select name="facility_level" id="facility_level" class="form-control" required>
                        <option value="">Select Facility Level</option>
                        <option value="HCI" {{ old('facility_level') == 'HCI' ? 'selected' : '' }}>HCI</option>
                        <option value="HCII" {{ old('facility_level') == 'HCII' ? 'selected' : '' }}>HCII</option>
                        <option value="HCIII" {{ old('facility_level') == 'HCIII' ? 'selected' : '' }}>HCIII</option>
                        <option value="HCIV" {{ old('facility_level') == 'HCIV' ? 'selected' : '' }}>HCIV</option>
                        <option value="Referral Hospital" {{ old('facility_level') == 'Referral Hospital' ? 'selected' : '' }}>Referral Hospital</option>
                        <option value="Clinic" {{ old('facility_level') == 'Clinic' ? 'selected' : '' }}>Clinic</option>
                        <option value="Hospital" {{ old('facility_level') == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                    </select>
                    @error('facility_level')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                    @error('location')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="contact_person_name">Contact Person Name</label>
                    <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" value="{{ old('contact_person_name') }}" required>
                    @error('contact_person_name')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contact_person_phone">Contact Person Phone</label>
                    <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control" value="{{ old('contact_person_phone') }}" required>
                    @error('contact_person_phone')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Client Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="support_engineer_name">Support Engineer Name</label>
                    <input type="text" name="support_engineer_name" id="support_engineer_name" class="form-control" value="{{ old('support_engineer_name') }}" required>
                    @error('support_engineer_name')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="support_engineer_phone">Support Engineer Phone</label>
                    <input type="text" name="support_engineer_phone" id="support_engineer_phone" class="form-control" value="{{ old('support_engineer_phone') }}" required>
                    @error('support_engineer_phone')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="support_engineer_email">Support Engineer Email</label>
                    <input type="email" name="support_engineer_email" id="support_engineer_email" class="form-control" value="{{ old('support_engineer_email') }}" required>
                    @error('support_engineer_email')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>

             <!-- Updated Billing Cycle Amount Dropdown -->
             <div class="col-md-6">
                <div class="form-group">
                    <label for="billing_cycle_amount_id">Billing Cycle Amount</label>
                    <select name="billing_cycle_amount_id" id="billing_cycle_amount_id" class="form-control" required>
                        <option value="">Select Billing Cycle Amount</option>
                        @foreach($billingCycleAmounts as $amount)
                            <option value="{{ $amount->id }}" {{ old('billing_cycle_amount_id') == $amount->id ? 'selected' : '' }}>
                                {{ $amount->billing_cycle_years }} - ${{ $amount->amount }}
                            </option>
                        @endforeach
                    </select>
                    @error('billing_cycle_amount_id')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create Client</button>
    </form>
</div>
@endsection
