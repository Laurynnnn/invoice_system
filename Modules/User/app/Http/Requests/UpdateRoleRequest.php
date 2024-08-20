<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Assuming the role ID is passed as a route parameter
        $roleId = $this->route('role');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure the role name is unique, excluding the current role being updated
                'unique:roles,name,' . $roleId,
            ],
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }

    /**
     * Get the custom validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The role name is required.',
            'name.string' => 'The role name must be a string.',
            'name.max' => 'The role name cannot exceed 255 characters.',
            'name.unique' => 'The role name has already been taken.',
            'permissions.array' => 'Permissions must be an array.',
            'permissions.*.exists' => 'One or more selected permissions do not exist.',
        ];
    }
}
