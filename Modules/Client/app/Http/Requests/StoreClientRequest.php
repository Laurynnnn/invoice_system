<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Adjust as needed for authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_name' => 'required|string|max:255',
            'facility_level' => 'required|in:HCI,HCII,HCIII,HCIV,Referral Hospital,Clinic,Hospital',
            'location' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'support_engineer_name' => 'required|string|max:255',
            'support_engineer_phone' => 'required|string|max:20',
            'support_engineer_email' => 'required|email|max:255',
            'billing_cycle_years' => 'required|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'client_name.required' => 'The client name is required.',
            'facility_level.required' => 'The facility level is required.',
            'facility_level.in' => 'The selected facility level is invalid.',
            'location.required' => 'The location is required.',
            'contact_person_name.required' => 'The contact person name is required.',
            'contact_person_phone.required' => 'The contact person phone is required.',
            'email.required' => 'The client email is required.',
            'email.email' => 'The client email must be a valid email address.',
            'support_engineer_name.required' => 'The support engineer name is required.',
            'support_engineer_phone.required' => 'The support engineer phone is required.',
            'support_engineer_email.required' => 'The support engineer email is required.',
            'support_engineer_email.email' => 'The support engineer email must be a valid email address.',
            'billing_cycle_years.required' => 'The billing cycle is required.',
            'billing_cycle_years.integer' => 'The billing cycle must be an integer.',
            'billing_cycle_years.min' => 'The billing cycle must be at least 1 year.',
        ];
    }
}
