<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDetailsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // No authentication required
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required_if:is_new,true|string|max:255',
            'gender' => 'sometimes|string|max:50',
            'age' => 'sometimes|integer|min:0|max:120',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:255',
            'height' => 'sometimes|string|max:20',
            'weight' => 'sometimes|string|max:20',
            'medical_history' => 'sometimes|string|nullable',
            'current_medications' => 'sometimes|string|nullable',
            'allergies' => 'sometimes|string|nullable',
        ];
    }
}