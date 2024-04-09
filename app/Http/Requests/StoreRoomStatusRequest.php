<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomStatusRequest extends FormRequest
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
        if (! empty($this->roomstatus->id)) {
            return [
                'name' => 'required|max:255',
                'information' => 'required|max:1000',
                'code' => 'required|unique:room_statuses,code,'.$this->roomstatus->id,
            ];
        }

        return [
            'name' => 'required|max:255',
            'information' => 'required|max:1000',
            'code' => 'required|unique:room_statuses,code',
        ];
    }
}
