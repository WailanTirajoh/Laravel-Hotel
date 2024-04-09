<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
        if (! empty($this->room->id)) {
            return [
                'type_id' => 'required',
                'room_status_id' => 'required',
                'number' => 'required|unique:rooms,number,'.$this->room->id,
                'capacity' => 'required|numeric',
                'price' => 'required|numeric',
                'view' => 'required|max:255',
            ];
        }

        return [
            'type_id' => 'required',
            'room_status_id' => 'required',
            'number' => 'required|unique:rooms,number',
            'capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'view' => 'required|max:255',
        ];
    }
}
