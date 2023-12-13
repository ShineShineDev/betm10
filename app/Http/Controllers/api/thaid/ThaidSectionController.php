<?php

namespace App\Http\Controllers\api\thaid;

use App\Http\Controllers\Controller;
use App\Models\ThaiDBettingSlip;
use Illuminate\Http\Request;
use App\Http\Resources\thaid\LatestThaidSectionResource;
use App\Http\Resources\thaid\ThaidBetSlipResource;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use App\Models\ThaiDBettingLog;
use App\Models\Customer;

class ThaidSectionController extends Controller
{
    use ApiResponser;
    public function getLatestSection()
    {
        $latest_section = $this->getThaiDlatestSection();

        if (!$latest_section)
            return $this->successResponse([]);
        return $this->successResponse(new LatestThaidSectionResource($latest_section));
    }
    public function bet(Request $request)
    {

        $validator = Validator::make($request->only('bet_logs'), ['bet_logs' => ['required', 'array'],]);

        if ($validator->fails())
            return $this->respondValidationErrors('Fail', $validator->errors(), 403);

        $latest_section = $this->getThaiDlatestSection();

        if (!$latest_section)
            return $this->errorResponse("Section not Created !", 400);

        if ($this->checkTime($latest_section->opening_date, $latest_section->closing_time))
            return $this->errorResponse("Section Closed !", 400);

        $customer = Customer::find($request->user()->id);

        $total_bet_amount = count($request->bet_logs) * $latest_section->to_bet_amount;
        if ($total_bet_amount > $customer->balance)
            return $this->errorResponse("Insufficient amount !", 400);

        $slip_number = $customer->id . '#' . uniqid();
        $created_bet_slip = ThaiDBettingSlip::create([
            "slip_number" => $slip_number,
            'customer_id' => $customer->id,
            'total_amount' => $total_bet_amount,
            'thaid_section_id' => $latest_section->id,
            'bet_date' => now()
        ]);

        foreach ($request->bet_logs as $number) {
            ThaiDBettingLog::create([
                'thaid_section_id' => $latest_section->id,
                'thaid_bet_slip_id' => $created_bet_slip->id,
                'customer_id' => $request->user()->id,
                'slip_number' => $slip_number,
                'bet_number' => $number,
            ]);
        }
        $customer->balance = $customer->balance - $total_bet_amount;
        $customer->save();
        return $this->successResponse($this->betResponse($created_bet_slip));
    }
    private function betResponse($data)
    {
        return [
            "id" => $data->id,
            "slip_number" => $data->slip_number,
            "customer_id" => $data->customer_id,
            "total_amount" => $data->total_amount,
            "thaid_section_id" => $data->thaid_section_id,
            "bet_date" => $data->bet_date,
        ];
    }

    private function checkTime($date, $time)
    {
        $closingDateTime = $date . " " . $time;
        $currentDateTime = date("Y-m-d H:i");
        $closingTimestamp = strtotime($closingDateTime);
        $currentTimestamp = strtotime($currentDateTime);
        if ($closingTimestamp < $currentTimestamp)
            return true;
        return false;
    }

    function betHistory(Request $request)
    {
        $threed_betting_slip = ThaiDBettingSlip::query()->where('customer_id', $request->user()->id)->with('thaiDSection', 'thaiDBettingLogs')->orderByDesc('id')->get();
        return $this->successResponse(ThaidBetSlipResource::collection($threed_betting_slip));
    }

}










