<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Support;

class SupportController extends Controller
{

    public function list()
    {
        $data = Support::all();
        $finalArray = [];
        foreach($data as $d){
            $d->image = 'https://admin.kmlottery.com' . $d->image;
            $finalArray[] = $d;
        }
        return response()->json($finalArray);
    }
}
