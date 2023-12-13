<?php

namespace App\Http\Controllers\admin\threed;

use App\Models\ThreeDBettingLog;
use App\Models\ThreeDBettingSlip;
use App\Models\ThreeDBlockNumber;
use App\Models\ThreeDDefaultSetting;
use App\Models\ThreeDNumberLimit;
use App\Models\ThreeDSection;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ThreedSectionController extends Controller
{
    public function index()
    {

        $threed_sections = Threedsection::with('threedBettingLogs')->orderBy('opening_date', 'DESC')->paginate(20);
        $latest_threed_sections = ThreeDSection::orderByDesc('opening_date')->first();
        return view('admin.threed.section.index', compact(['threed_sections', 'latest_threed_sections']));
    }


    public function store(Request $request)
    {
        // return $request->all();
        $default_setting = ThreeDDefaultSetting::find(1);
        $block_numbers_array = explode(",", $default_setting->block_numbers);

        $input = [
            'opening_date' => $request->opening_date,
            'opening_time' => $request->opening_time,
            'closing_time' => $default_setting->closing_time,
            'odd' => $default_setting->odd,
            'r_odd' => $default_setting->r_odd,
            'min_amount' => $default_setting->min_amount,
            'max_amount' => $default_setting->max_amount,
            'user_commission' => $default_setting->user_commission,
            'agent_commission' => $default_setting->agent_commission,
            'is_maintenace' => $default_setting->is_maintenace,
            'status' => 1
        ];
        $is_created_threed_section = ThreeDSection::create($input);

        if (!$is_created_threed_section) {
            return back()->with('success', 'Fail!');
        }

        $threed_section_id = $is_created_threed_section->id;

        //adding block numbers  to three_d_block_numbers Table

        foreach ($block_numbers_array as $block_number) {
            ThreeDBlockNumber::create([
                "threed_section_id" => $threed_section_id,
                "number" => $block_number
            ]);
        }
        return back()->with('success', 'Section Added');
    }

    public function show($id)
    {
        $threed_section = ThreeDSection::with('threedBlockNumbers', 'threedNumberLimits')->find($id);
        return view('admin.threed.section.show', compact(['threed_section']));
    }


    public function winningNumberBeforeConfirm(Request $request)
    {
        $request->validate([
            'section_id' => ['required', 'integer', 'min:1'],
            'winning_number' => ['required', 'integer', 'max:999'],
        ]);

        $section_id = $request->section_id;
        $winning_number = $request->winning_number;

        $section = ThreeDSection::find($section_id);

        $threed_bet_slips = ThreeDBettingSlip::all();

        $threed_sections = ThreeDSection::orderBy('id', 'DESC')->paginate(20);

        $multiply = $section->odd;
        // return $multiply;
        $reverse_multiply = $section->r_odd;
        $user_commission = $section->user_commission;
        $agent_commission = $section->agent_commission;


        $bet_Log_match = ThreeDBettingLog::where('threed_section_id', $section_id)->where('bet_number', $winning_number)->get();


        $total_slip = null;
        $individual_reward_amoun_array = [];
        foreach ($bet_Log_match as $bet_log) {
            $total_slip = ThreeDBettingSlip::count('id', $bet_log->threed_bet_slip_id);
            array_push($individual_reward_amoun_array, $bet_log->bet_amount * $multiply);
        }

        $win_info = [
            'winning_number' => $winning_number,
            'multiply' => $multiply,
            'reverse_multiply' => $reverse_multiply,
            'total_slip' => $total_slip,
            'reward_amount' => number_format(array_sum($individual_reward_amoun_array)),
            'reverse_reward_amount' => 23232,
            'date' => $section->created_at,
        ];

        return view('admin.threed.bet_slip.index', compact(['threed_bet_slips', 'threed_sections', 'win_info']));

    }

    public function update(Request $request, $id = null)
    {
        $request->validate([
            'section_id' => ['required', 'integer', 'min:1'],
            'winning_number' => ['required', 'integer', 'max:999'],
        ]);

        $section_id = $request->section_id;
        $winning_number = $request->winning_number;

        $section = ThreeDSection::find($section_id);

        return $section;

    }

    public function deleteBlockNumber($id)
    {
        return ThreeDBlockNumber::destroy($id) ?
            back()->with('success', 'Success') :
            back()->with('success', 'Fail');
    }

    public function storeBlockNumber(Request $request)
    {
        $request->validate([
            'threed_section_id' => ['required', 'integer', 'min:1'],
            'number' => ['required', 'integer', 'min:1', 'max:999'],
        ]);
        return ThreeDBlockNumber::create($request->only('threed_section_id', 'number')) ?
            back()->with('success', 'Success') :
            back()->with('success', 'Fail');
    }

    public function storeNumberLimit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'number' => ['required', 'integer', 'min:1', 'max:999'],
            'min_amount' => ['required', 'integer', 'min:100'],
            'max_amount' => ['required', 'integer', 'min:100'],
            'threed_section_id' => ['required', 'integer', 'min:1'],
        ]);
        return ThreeDNumberLimit::create(
            $request->only(
                'threed_section_id',
                'number',
                'min_amount',
                'max_amount',
            )
        ) ?
            back()->with('success', 'Success') :
            back()->with('success', 'Fail');
    }

    public function deleteNumberLimit($id)
    {
        if (!$id)
            return back()->with('success', 'Fail');

        return ThreeDNumberLimit::destroy($id) ?
            back()->with('success', 'Success') :
            back()->with('success', 'Fail');

    }

    private function calculateReverseMultiply($number)
    {

    }
    private function calculateMultiply()
    {

    }
}