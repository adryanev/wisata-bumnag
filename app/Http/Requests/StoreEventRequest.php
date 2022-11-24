<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
        return [
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'numeric|required',
            'email' => 'email|required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'term_and_condition' => 'required',
            'instagram' => 'nullable',
            'website' => 'url|nullable',
            'capacity' => 'numeric|min:1|nullable',
            'event_photo' => 'nullable',
            'event_photo.*' => 'mimes:png,jpg',
        ];
    }
}
