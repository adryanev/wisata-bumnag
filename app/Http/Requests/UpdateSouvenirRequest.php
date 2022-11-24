<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSouvenirRequest extends FormRequest
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
            'price' => 'numeric|min:0',
            'is_free' => 'required',
            'term_and_conditions' => 'nullable',
            'quantity' => 'required|numeric',
            'description' => 'nullable',
            'souvenir_category' => 'required|numeric',
            'destination_id' => 'required|numeric',
            'souvenir_photo' => 'nullable',
            'souvenir_photo.*' => 'mimes:png,jpg'
        ];
    }
}
