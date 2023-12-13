<?php

namespace App\Http\Controllers\admin\threed;

use App\Http\Controllers\Controller;
use App\Models\ThreeDBettingSlip;
use App\Models\ThreeDSection;
use Illuminate\Http\Request;

class ThreeDBetSlipController extends Controller
{

    public function index()
    {
        $threed_bet_slips = ThreeDBettingSlip::with('threedBettingLogs', 'threeDSection')->orderBy('id', 'DESC')->paginate(20);
        $latest_threed_sections = ThreeDSection::orderByDesc('opening_date')->first();
        return view('admin.threed.bet_slip.index', compact(['threed_bet_slips', 'latest_threed_sections']));
    }

    public function show($id)
    {
        $threed_bet_slip = ThreeDBettingSlip::with('threeDBettingLogs')->find($id);
        return view('admin.threed.bet_slip.show', compact(['threed_bet_slip']));
    }

    public function reject($id)
    {
        $betslip = ThreeDBettingSlip::where('id', $id)->first();
        if (!$betslip)
            return abort(404);
        $betslip->update(['is_reject' => !$betslip->is_reject]);
        return back()->with(['success' => 'Successfully!']);
    }

}