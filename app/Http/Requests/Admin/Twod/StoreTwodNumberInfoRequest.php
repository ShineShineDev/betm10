<?php

namespace App\Http\Requests\Admin\Twod;

use Illuminate\Foundation\Http\FormRequest;

class StoreTwodNumberInfoRequest extends FormRequest
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
            'section_id' => 'required',
            'number' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required'
        ];
    }
}
