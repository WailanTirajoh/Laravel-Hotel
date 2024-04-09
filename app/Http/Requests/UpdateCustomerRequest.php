<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->user->role == 'Customer') {
            return [
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$this->user->id,
                'role' => 'required|in:Customer',
            ];
        }

        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->user->id,
            'role' => 'required|in:Super,Admin',
        ];
    }
}
