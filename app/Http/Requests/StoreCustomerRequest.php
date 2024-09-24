<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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

        if ($this->isMethod('put')) {
            return [
                'name' => 'required',
                'address' => 'required|max:255',
                'job' => 'required',
                'birthdate' => 'required|date',
                'gender' => 'required|in:Male,Female',
                'avatar' => 'mimes:png,jpg',
            ];
        }

        return [
            'name' => 'required',
            'address' => 'required|max:255',
            'job' => 'required',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|unique:users,email',
            'avatar' => 'mimes:png,jpg',
        ];
    }
}
