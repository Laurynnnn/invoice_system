<?php

namespace Modules\Invoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorization logic, adjust if needed
    }

    public function rules()
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'billing_cycle_years' => 'required|integer|min:1|max:10', // Example range
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:paid,unpaid',
            'start_date' => 'required|date', // Validation for start_date only
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Client ID is required.',
            'client_id.exists' => 'The selected client does not exist.',
            'billing_cycle_years.required' => 'Billing cycle years are required.',
            'billing_cycle_years.integer' => 'Billing cycle years must be an integer.',
            'billing_cycle_years.min' => 'Billing cycle years must be at least 1 year.',
            'billing_cycle_years.max' => 'Billing cycle years cannot exceed 10 years.',
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Amount must be a positive number.',
            'payment_status.required' => 'Payment status is required.',
            'payment_status.in' => 'Payment status must be either paid or unpaid.',
            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Start date must be a valid date.',
        ];
    }
}
