<?php

namespace App\Http\Requests\Admin\Twod;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTwodSectionRequest extends FormRequest
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
            'opening_datetime' => 'required',
            'closing_datetime' => 'required',
            'odd'              => 'required',
            'min_amount'       => 'required',
            'max_amount'       => 'required',
            'user_commission'  => 'required',
            'agent_commission' => 'required'
        ];
    }
}
