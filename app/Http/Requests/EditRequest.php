<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Cars'=> 'required|min:3',
            'Brand'=> 'required|max:15',
            'Car_Type'=> 'required|min:3',
            'Fuel_Type'=> 'required|min:5',
            'image'=> 'required|mimes:png,jpg',
        ];
    }
}
