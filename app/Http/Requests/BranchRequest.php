<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
    public function rules($branchId = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => ['required', Rule::in(['branch', 'parent'])],
            'phone' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('branches', 'email')->ignore($branchId),
            ],
            'manager' => 'required|string|max:255',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'address_id' => 'nullable|exists:addresses,id',
        ];
    }
}
