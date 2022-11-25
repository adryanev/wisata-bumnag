<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'price_include' => 'required',
            'price_exclude' => 'required',
            'activities' => 'required',
            'destination' => 'required',
            'package_category' => 'required',
            'package_photo' => 'nullable',
            'package_photo.*' => 'mimes:png,jpg'
        ];
    }
}
