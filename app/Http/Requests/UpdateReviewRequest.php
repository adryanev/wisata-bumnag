<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'reviewable_type' => 'required',
            'reviewable_id' => 'required',
            'rating' => 'required|max:5|min:1',
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'review_photo' => 'image'
        ];
    }
}
