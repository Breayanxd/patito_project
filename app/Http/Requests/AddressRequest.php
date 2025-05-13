<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
    public function rules(): array
    {
        $addressId = $this->route('address')?->id;

        return [
            'street' => 'required|string|max:255', 
            'number' => 'required|string|max:10',  
            'col' => 'required|string|max:255',    
            'cp' => 'required|string|min:5|max:10',     
            'city' => 'required|string|max:255',   
            'state' => 'required|string|max:255',  
            'country' => 'required|string|max:255',
        ];
    }
}
