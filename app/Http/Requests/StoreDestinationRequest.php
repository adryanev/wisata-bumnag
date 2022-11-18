<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'numeric|required',
            'email' => 'email|required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'date_format:H:i:s|nullable',
            'closing_hours' => 'date_format:H:i:s|nullable',
            'instagram' => 'nullable',
            'website' => 'url|nullable',
            'capacity' => 'numeric|min:1|nullable',
            'destination_photo' => 'image',
            'destination_category' => 'required|numeric',
        ];
    }
}
