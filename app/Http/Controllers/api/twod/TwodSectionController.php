<?php

namespace App\Http\Controllers\api\twod;

use Carbon\Carbon;
use App\Models\TwodSection;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\TwodBlockNumber;
use App\Http\Controllers\Controller;
use App\Http\Resources\twod\TwodCalendarResource;
use App\Rules\MonthNameValidationRule;
use App\Http\Resources\twod\TwodSectionListResource;
use App\Models\TwodBetSlip;

class TwodSectionController extends Controller
{
    use ApiResponser;
    
    public function section_list(){

    //   $data = TwodSection::with('type')->whereDate('opening_datetime',now())->orderBy('opening_datetime')->get();
      
        $data = TwodSection::with('type')->orderBy('opening_datetime')->get();

        return $this->successResponse(TwodSectionListResource::collection($data));

    }

    public function detail($section_id){

        $data = TwodSection::with('type')->where('id',$section_id)->first();

        if(!$data) return $this->errorResponse('No Data Found',204);

        return $this->successResponse(new TwodSectionListResource($data));
    }

    public function get_numbers($section_id){
     
        $section = TwodSection::with('numbers')->where('id',$section_id)->first();

        if(!$section) return $this->errorResponse('No Data Found',204);

        $numbers = $this->getNumbersInfo($section);
        
        return $this->successResponse($numbers);
    }

    public function calendar(Request $request){
        $request->validate([
            'month_name' => ['required', new MonthNameValidationRule],
            'year'       => 'required',
        ]);

        $monthName = $request->month_name; 
        $date = Carbon::parse("1 $monthName");
        $monthNumber = $date->format('m');

        $data = TwodSection::select('id','winning_number','opening_datetime')
                            ->whereMonth('opening_datetime',$monthNumber)
                            ->whereYear('opening_datetime',$request->year)
                            ->get();

        return $this->successResponse(TwodCalendarResource::collection($data),200);

    }
  
  	  public function getWinners(){
        $section = TwodSection::
                    whereDate('opening_datetime',now())
                    ->whereTime('opening_datetime',"<=",now())
                    ->orderBy('opening_datetime', 'desc')
                    ->first();
        
        $slips = TwodBetSlip::with(['customer'])
                    ->withSum('bet_logs','reward_amount')
                    ->where('twod_section_id',$section->id)
                    ->whereDate('created_at',now())
                    ->orderBy('bet_logs_sum_reward_amount','desc')
                    ->get()
                    ->groupBy('customer_id')->all();
        
        $winners = [];
        foreach($slips as $key => $item){
            $total_reward = 0;
            $indexKey = 0;
            foreach($item as $i => $slip){
                $indexKey = $i;
                $total_reward += $slip->bet_logs_sum_reward_amount;
            }
            $item[$indexKey]->customer->total_reward = $total_reward;
            $winners[] = $this->formatWinners($item[$indexKey]->customer);
        }

        return $this->successResponse($winners);
    }


    private function formatWinners($customer){
        return [
            'id' => $customer->id,
            'name' => $customer->name,
            'phone' => $customer->phone,
            'image' => $customer->image ?? '',
            'total_reward' => $customer->total_reward
        ];
    }


    private function getNumbersInfo($section){
        $block_numbers = TwodBlockNumber::where('twod_section_id',$section->id)->get()->pluck('number')->toArray();
        $numbers = [];
        for ($i = 0; $i <= 99; $i++) {
            $number = str_pad($i, 2, '0', STR_PAD_LEFT);

            $number_min = $section->min_amount;
            $number_max = $section->max_amount;
          	$max_limit_amount = $section->max_limit_amount;

            if(in_array($number,$section->numbers->pluck('number')->toArray())){
                // return $number;
                $number_min = $section->numbers->where('number',$number)->first()->min_amount;
                $number_max = $section->numbers->where('number',$number)->first()->max_amount; 
              	$max_limit_amount = $section->numbers->where('number',$number)->first()->max_limit_amount; 
            }

            $numbers[] = [
                'number' => $number,
                'minimum_amount' => $number_min,
                'maximum_amount' => $number_max,
                'percent'        => $section->getPercent($number),
                'is_blocked'     => (boolean)in_array($number,$block_numbers),
              	'max_limit_amount'=> $max_limit_amount ?? 0
            ];  
        }
        return $numbers;
    }
}
