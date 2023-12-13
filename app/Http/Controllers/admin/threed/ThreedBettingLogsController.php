<?php

namespace App\Http\Controllers\admin\threed;

use App\Http\Controllers\Controller;
use App\Models\ThreeDBettingLog;
use App\Models\ThreeDSection;
use Illuminate\Http\Request;

class ThreedBettingLogsController extends Controller
{

    public function index()
    {
        $lateset_section = ThreeDSection::orderBy('id', 'DESC')->first();
        $threed_betting_logs = ThreeDBettingLog::orderBy('bet_number')->get()->groupBy(function ($data) {
            return $data->bet_number;
        });
        // return $threed_betting_logs;
        return view('admin.threed.bet_logs.index', compact(['threed_betting_logs', 'lateset_section']));
    }

}