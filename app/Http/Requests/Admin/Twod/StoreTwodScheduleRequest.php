<?php

namespace App\Http\Requests\Admin\Twod;

use Illuminate\Foundation\Http\FormRequest;

class StoreTwodScheduleRequest extends FormRequest
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
    
    public function rules()
    {
        return [
            'twod_type_id'          => 'required',
            'opening_time'     => 'required',
            'closing_time'     => 'required',
            'odd'              => 'required',
            'user_commission'  => 'required',
            'agent_commission' => 'required',
            'min_amount'       => 'required',
            'max_amount'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'opening_time.required' => 'opening time is required ... !',
            'closing_time.required' => 'closing time is required ... !'
        ];
    }
}
