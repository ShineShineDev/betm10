<?php

namespace App\Http\Controllers\api;

use App\Models\Slide;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SlideResource;

class SlideController extends Controller
{
    use ApiResponser;

    public function list(){
        
        $data = Slide::orderBy('id','desc')->get();

        if(!count($data)) return $this->errorResponse('No Data Found',204);

        return $this->successResponse(SlideResource::collection($data),200);
    }
}
