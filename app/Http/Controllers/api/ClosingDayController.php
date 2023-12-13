<?php

namespace App\Http\Controllers\api;

use App\Models\Slide;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClosingDayResource;
use App\Http\Resources\SlideResource;
use App\Models\ClosingDay;

class ClosingDayController extends Controller
{
    use ApiResponser;

    public function list(){
        
        $data = ClosingDay::orderBy('id','desc')->get();

        if(!count($data)) return $this->errorResponse('No Data Found',204);

        return $this->successResponse(ClosingDayResource::collection($data),200);
    }
}
