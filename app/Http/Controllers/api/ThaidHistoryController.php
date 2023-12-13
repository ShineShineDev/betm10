<?php

namespace App\Http\Controllers\api;

use App\Models\Thaidbetslip;
use App\Models\Thaidcomfirm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThaidHistoryController extends Controller
{

    public function listhistory(Request $request)
    {
        $bet = Thaidbetslip::where('customer_id', $request->user()->id)->get();
        logger($request->user()->id);
        $finalArray = [];
        foreach ($bet as $item) {
            $Data = Thaidcomfirm::where('thaibetslip_id', $item['id'])->orderBy('created_at', 'desc')->get();
            array_push($finalArray, [
                'slip_id' => $item['id'],
                'slip_number' => $item['slip_number'],
                'status' => $item['status'],
                'bet_date' => $item['bet_date'],
                'data' => $Data
            ]);
        }
        return response()->json($finalArray);
    }
}
