<?php

namespace App\Http\Controllers\admin\twod;

use Exception;
use Carbon\Carbon;
use App\Models\TwodBetLog;
use App\Models\TwodBetSlip;
use App\Models\TwodSection;
use Illuminate\Http\Request;
use App\Models\TwodNumberInfo;
use App\Models\TwodBlockNumber;
use App\Models\TwodDefaultSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Twod\StoreTwodSectionRequest;
use App\Http\Requests\Admin\Twod\UpdateTwodSectionRequest;
use App\Models\Customer;
use App\Models\TwodType;

class TwodSectionController extends Controller
{
    public function index()
    {
        $data = TwodSection::with(['type','bet_slips.bet_logs'])
                    ->withSum('bet_slips', 'total_amount')
                    ->orderBy('opening_datetime', 'desc')
                    ->paginate(10);
        $types = TwodType::orderBy('id','desc')->get();

        $data->each(function ($item) {
            $item->total_reward_amount = $item->bet_slips->flatMap->bet_logs->sum('reward_amount');
        });
                    
        return view('admin.twod.sections.index')->with(['data' => $data,'types'=>$types]);
    }

    public function create()
    {
    }

    public function store(StoreTwodSectionRequest $request)
    {

        [$data, $default] = $this->getRequestData($request);

        $section = TwodSection::create($data);

        $block_numbers_data = $this->getTwodBlockNumber($default->block_numbers, $section->id);

        TwodBlockNumber::insert($block_numbers_data);

        return redirect()->route('admin.twod_sections.index')->with(['success' => 'New Bet Round added successfully!']);
    }

    public function show($section_id)
    {
        $section = TwodSection::withSum('bet_slips', 'total_amount')
            ->with('bet_slips.bet_logs')
            ->where('id', $section_id)
            ->first();

        if (!$section) return abort(404);


        $totalsByNumber = [];

        foreach ($section->bet_slips as $bet_slip) {
            foreach ($bet_slip->bet_logs as $bet_log) {
                $number = $bet_log->bet_number;
                $betAmount = $bet_log->bet_amount;

                if (!isset($totalsByNumber[$number])) {
                    $totalsByNumber[$number] = 0;
                }

                $totalsByNumber[$number] += $betAmount;
            }
        }

        ksort($totalsByNumber);
        return view('admin.twod.sections.detail')->with(['data' => $section, 'totalsByNumber' => $totalsByNumber]);
    }

    public function confirmWinningNumber(Request $request) {
        $request->validate([
            'section_id' => 'required'
        ]);

        $section = TwodSection::with('bet_slips')->where('id',$request->section_id)->first();
        
        if (!$section) return abort(404);
        
        $slipData = TwodBetSlip::where('twod_section_id', $section->id)->get();

        try {
            DB::beginTransaction();

            foreach ($slipData as $s) {

                $bet = TwodBetLog::where('twod_bet_slip_id', $s->id)->where('bet_number', $section->winning_number)->first();

                if($bet){

                    $bet->update([
                        'reward_amount' => $bet->bet_amount * $section->odd,
                        'reward_status' => 1,
                    ]);
    
                    $cu = Customer::where('id',$s->customer_id)->first();

                    Customer::where('id',$s->customer_id)->update([
                        'balance' => $cu->balance + ( $bet?->bet_amount * $section->odd),
                    ]);

                }
            }

            $section->update([
                'status' => 1
            ]);
           
            DB::commit();
            return back();

        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            // return back()->with(['errorMessage' => $e->getMessage(), 500]);
        }

       
    }

    public function get_section_data($section_id){

        $section = TwodSection::where('id',$section_id)->first();
        
        if (!$section) return abort(404);

        $twodBetSlips = TwodBetSlip::where('twod_section_id',$section_id)
                        ->where('is_reject','!=',1)
                        ->get();

        $bet_logs = TwodBetLog::whereIn(
                        'twod_bet_slip_id',
                        $twodBetSlips->pluck('id')->toArray()
                        )
                        ->where('bet_number',$section->winning_number)
                        ->whereNull('is_reject')
                        ->get();

        $data = [
            'tot_bet_slips'  => count($twodBetSlips),
            'reward_amount'  => number_format((int)$bet_logs->sum('bet_amount') * (int)$section->odd),
            'odd'            => $section->odd,
            'winning_number' => $section->winning_number
        ];

        return response()->json($data,200);
    }

    public function edit($section_id)
    {
        $data = TwodSection::where('id', $section_id)->with('numbers', 'bet_slips')->first();
        $types = TwodType::orderBy('id','desc')->get();
        return view('admin.twod.sections.edit')->with(['data' => $data,'types'=> $types]);
    }

    public function update($section_id,UpdateTwodSectionRequest $request)
    {
        $data  = [
            'opening_datetime' => $request->opening_datetime,
            'closing_datetime' => $request->closing_datetime,
            'odd'              => $request->odd,
            'min_amount'       => $request->min_amount,
            'max_amount'       => $request->max_amount,
            'user_commission'  => $request->user_commission,
            'agent_commission' => $request->agent_commission,
        ];

        TwodSection::where('id', $section_id)->update($data);
        return redirect()->route('admin.twod_sections.index')->with(['success' => 'Updated successfully!']);
    }

    public function destroy()
    {
    }

    public function add_winning_number(Request $request)
    {
        $request->validate([
            'winning_number' => 'required',
            'section_id'    => 'required|exists:twod_sections,id'
        ]);
        try {
            DB::beginTransaction();
          
            TwodSection::where('id', $request->section_id)->update([
                'winning_number' => $request->winning_number,
            ]);
            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            // return back()->with(['errorMessage' => $e->getMessage(), 500]);
        }
    }

    public function add_number($section_id, Request $request)
    {
        $request->validate([
            'number' => 'required|numeric|max:2',
            'min_amount' =>  'required',
            'max_amount' =>  'required',
        ]);

        TwodNumberInfo::create([
            'section_id'    => $section_id,
            'number'        => $request->number,
            'min_amount'    => $request->min_amount,
            'max_amount'    => $request->max_amount,
        ]);

        return 'success';
    }

    private function getRequestData($request)
    {

        $date = Carbon::parse($request->opening_date);
        $time = Carbon::parse($request->opening_time);  
        $opening_datetime = $date->setTime($time->hour, $time->minute, $time->second)->setTimezone(config('app.timezone'));

        $default = TwodDefaultSetting::first();
        $closing_datetime = Carbon::parse($request->opening_date)->subMinutes($default->closing_time);

        $data  = [
            'opening_datetime' => $opening_datetime,
            'closing_datetime' => $closing_datetime,
            'odd'              => $default->odd,
            'min_amount'       => $default->min_amount,
            'max_amount'       => $default->max_amount,
            'user_commission'  => $default->user_commission,
            'agent_commission' => $default->agent_commission,
        ];

        return [$data, $default];
    }

    private function getTwodBlockNumber($numbers, $section_id)
    {
        if ($numbers)  $num_arr = explode(',', $numbers);
        $data = [];
        foreach ($num_arr as $item) {
            $data[] = [
                'twod_section_id' => $section_id,
                'number' => $item,
            ];
        }
        return $data;
    }
}
