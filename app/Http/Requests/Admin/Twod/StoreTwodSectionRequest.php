<?php

namespace App\Http\Requests\Admin\Twod;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTwodSectionRequest extends FormRequest
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
        $date = Carbon::parse(request()->opening_date);
        $time = Carbon::parse(request()->opening_time);
        $datetime = $date->setTime($time->hour, $time->minute, $time->second);
        return [
            'opening_date' => 'required',
            'opening_time' => [
                'required'
               
            ],
        ];
        // Rule::unique('twod_sections')->where(function ($query) use ($datetime) {
        //     $query->where('opening_datetime', $datetime);
        // }),
    }
}
