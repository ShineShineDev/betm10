<?php

namespace App\Http\Controllers;

use App\Models\TwodBetLog;
use App\Models\TwodBetSlip;
use App\Models\TwodSection;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TwodBetSlipController extends Controller
{
    public function index(){
        $data = TwodBetSlip::with('bet_logs','customer','section')->orderBy('id','desc')->paginate(10);
        $sections = TwodSection::whereDate('opening_datetime',now())->orderBy('id','desc')->get();
        return view('admin.twod.bet_slips.index')->with(['data'=>$data,'sections' => $sections]);
    }

    public function show($id){
        $betslip = TwodBetSlip::findOrFail($id);
        $betlogs = TwodBetLog::where('twod_bet_slip_id',$id)->get(); 
        return response()->json([
            'betSlips' => [
                'id' => $betslip->id,
                'slip_number' => $betslip->slip_number,
                'draw_date' => Carbon::parse($betslip->draw_date)->format('d-m-Y')
            ],
            'data' => $betlogs
        ]);
        // return view('admin.twod.bet_slips.detail')->with(['data'=>$betslip]);
    }

    public function reject($id){
        $betslip = TwodBetSlip::where('id',$id)->first();
        if(!$betslip) return abort(404);
        $betslip->update(['is_reject'=>!$betslip->is_reject]);
        return redirect()->route('admin.twod_bet_slips.index')->with(['success'=>'Reject Successfully!']);
    }
}
