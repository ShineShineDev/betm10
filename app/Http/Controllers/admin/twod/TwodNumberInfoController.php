<?php

namespace App\Http\Controllers\admin\twod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Twod\StoreTwodNumberInfoRequest;
use App\Models\TwodNumberInfo;
use Illuminate\Http\Request;

class TwodNumberInfoController extends Controller
{
    public function store($section_id,StoreTwodNumberInfoRequest $request){
        TwodNumberInfo::create($this->getRequestData($request,$section_id));
        return redirect()->route('admin.twod_sections.edit',$section_id)->with(['success'=>'Created Successfully!']);
    }

    private function getRequestData($request,$section_id){
        return [
            'twod_section_id' => $section_id,
            'number'     => $request->number,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount
        ];
    }
}
