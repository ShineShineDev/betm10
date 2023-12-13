<?php

namespace App\Http\Requests\Admin\Threed;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThreedDefaultSettingRequest extends FormRequest
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
            'odd' => 'required',
            'r_odd' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
            'user_commission' => 'required',
            'agent_commission' => 'required',
            'closing_time' => 'required',
            'is_maintenace' => 'required',
            'status' => 'required',
        ];
    }
}