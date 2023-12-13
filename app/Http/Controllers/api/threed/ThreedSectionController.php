<?php

namespace App\Http\Controllers\api\threed;



use App\Http\Resources\threed\ThreedBetSlipResource;
use App\Http\Resources\threed\ThreedSectionListResource;
use App\Http\Resources\threed\ThreedSectionHistorytResource;
use App\Models\ThreeDBettingLog;
use App\Models\ThreeDBettingSlip;
use App\Models\ThreeDSection;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class ThreedSectionController extends Controller
{
    use ApiResponser;

    public function getLatestSection()
    {
        $latest_section = ThreeDSection::where('opening_date', '>', Carbon::now())->with(['threedBlockNumbers', 'threedNumberLimits'])->orderByDesc('opening_date')->first();

        if (!$latest_section)
            return $this->successResponse([]);

        return $this->successResponse(new ThreedSectionListResource($latest_section));
    }
    

    public function bet(Request $request)
    {
        // return $this->errorResponse("Section Closed !", 400);
        $validator = Validator::make($request->only('bet_logs'), ['bet_logs' => ['required', 'array'],]);
        if ($validator->fails())
            return $this->respondValidationErrors('Fail', $validator->errors(), 403);

        $latest_section = $this->latestSection();

        if (!$latest_section)
            return $this->errorResponse("Section not Created !", 400);

        if ($this->checkTime($latest_section->opening_date, $latest_section->closing_time))
            return $this->errorResponse("Section Closed !", 400);

        if ($this->matchesWithBlockNumbers($request))
            return $this->errorResponse("Contain Block Number", 400);

        if ($this->checkWithNumberLimit($request))
            return $this->errorResponse("Over Amount(Number Limit)", 400);

        $total_bet_amount = array_reduce($request->bet_logs, function ($res, $item) {
            return $res + $item['amount'];
        }, 0);
        $customer = Customer::find($request->user()->id);
        if ($total_bet_amount > $customer->balance)
            return $this->errorResponse("Insufficient amount !", 400);

        
        $slip_number = $request->user()->id . '-' . uniqid();
        $created_bet_slip = ThreeDBettingSlip::create([
            'customer_id' => $request->user()->id,
            'threed_section_id' => $latest_section->id,
            'slip_number' => $slip_number,
            'total_amount' => $total_bet_amount,
            'bet_date' => now()
        ]);
        foreach ($request->bet_logs as $data) {
            $number = $data["number"];
            $amount = (int) $data["amount"];
            ThreeDBettingLog::create([
                'threed_section_id' => $latest_section->id,
                'threed_bet_slip_id' => $created_bet_slip->id,
                'slip_number' => $slip_number,
                'bet_number' => $number,
                'bet_amount' => $amount
            ]);
        }
        $customer->balance = $customer->balance - $total_bet_amount;
        $customer->save();
        return $this->successResponse($created_bet_slip);
    }

    public function betHistory(Request $request)
    {
        $threed_betting_slip = ThreeDBettingSlip::query()->where('customer_id', $request->user()->id)->with('threeDSection', 'threeDBettingLogs')->orderByDesc('id')->get();
        return $this->successResponse(['slips' => ThreedBetSlipResource::collection($threed_betting_slip)]);
    }
    public function getHistoryByYear($year)
    {
        return ThreedSectionHistorytResource::collection(ThreeDSection::select('id', 'opening_date', 'winning_number')->whereYear('opening_date', $year)->orderBy('id')->get());
    }

    private function matchesWithBlockNumbers($request)
    {
        $latest_section = $this->latestSection();
        $block_numbers = $latest_section->threedBlockNumbers;
        $hasMatchesWithBlockNumber = false;
        foreach ($request->bet_logs as $bet_log) {
            foreach ($block_numbers as $block_number) {
                if ($bet_log["number"] == $block_number->number) {
                    $hasMatchesWithBlockNumber = true;
                    break 2;
                }
            }
        }
        return $hasMatchesWithBlockNumber;
    }

    private function checkWithNumberLimit($request)
    {
        $latest_section = $this->latestSection();
        $numberLimits = $latest_section->threedNumberLimits;
        $beyondWithNumberLimits = false;
        foreach ($request->bet_logs as $bet_log) {
            // dd($bet_log["number"]);
            foreach ($numberLimits as $numberLimit) {
                // dd($numberLimit->max_amount);
                if ($bet_log["number"] == $numberLimit->number) {
                    $currentBetedAmount = $this->currentTotalBetAmountWithProvidedSectionIdAndNum($latest_section->id, $numberLimit->number);
                    // dd($currentBetedAmount);
                    if ($currentBetedAmount >= $numberLimit->max_amount)
                        $beyondWithNumberLimits = true;
                }
            }
        }
        return $beyondWithNumberLimits;
    }

    private function checkTime($date, $time)
    {
        $closingDateTime = $date->toDateString() . " " . $time;
        $currentDateTime = date("Y-m-d H:i");        
        $closingTimestamp = strtotime($closingDateTime);
        $currentTimestamp = strtotime($currentDateTime);
        if ($closingTimestamp < $currentTimestamp)
            return true;
        return false;
    }
    
}

