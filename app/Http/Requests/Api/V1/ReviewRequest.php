<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'rating' => 'required|numeric',
            'user_id' => 'required|numeric',
            'order_detail_id' => 'required|numeric',
            'reviewable_id' => 'required|numeric',
            'reviewable_type' => 'required|string',
            'media' => 'nullable',
            'media.*' => 'mimes:png,jpg,mp4,mov',


        ];
    }
}
