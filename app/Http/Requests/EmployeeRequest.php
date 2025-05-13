<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($employeeId = null): array
    {   
             
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ],
            'address_id' => 'nullable|exists:addresses,id',
            'area_or_department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'branch_id' => 'nullable|exists:branches,id',
            'date_entry' => 'required|date',
            'status' => 'required|in:active,inactive',
        ];
    }
}
