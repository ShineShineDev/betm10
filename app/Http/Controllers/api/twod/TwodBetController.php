<?php

namespace App\Http\Controllers\api\twod;

use Exception;
use Ramsey\Uuid\Uuid;
use App\Models\TwodBetLog;
use App\Models\Transaction;
use App\Models\TwodBetSlip;
use App\Models\TwodSection;
use Illuminate\Support\Str;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\TwodBlockNumber;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Twod\StoreBetRequest;
use App\Http\Resources\twod\TwodBetListResource;
use App\Http\Resources\twod\TwodBetLogDetailResource;
use App\Models\Customer;

class TwodBetController extends Controller
{
    use ApiResponser;

    public function bet_list(){

        $data = TwodBetSlip::with('bet_logs','customer','section')
                            ->whereAuth()
                            ->latest()
                            ->get();

        if(!$data) return $this->errorResponse('No Data Found',204);

        return $this->successResponse(TwodBetListResource::collection($data),200);
    }

    public function detail($bet_slip_id){

        $data = TwodBetSlip::with(['bet_logs'=>function($query){
                                $query = $query->orderBy('bet_number','asc')->get();
                            },'section'])
                            ->where('id',$bet_slip_id)
                            ->whereAuth()
                            ->first();
        
        if(!$data) return $this->errorResponse('No Data Found',204);

        return $this->successResponse(new TwodBetLogDetailResource($data),200);
        
    }

    public function bet(StoreBetRequest $request,$id){

        $user_balance = request()->user()->balance;

        $total_bet_amount = $this->calculate_tot_bet_amount($request);

        if($user_balance < $total_bet_amount) 

        return $this->errorResponse('Insufficient Balance!',403); 

        $section = TwodSection::where('id',$id)->first();
        
        $block_numbers = TwodBlockNumber::where('twod_section_id',$id)->get()->pluck('number')->toArray();

        if($section->ended) return $this->errorResponse('Section is ended!',403); 

        foreach(json_decode($request->numbers) as $key => $item){

            if(in_array($item->number,$block_numbers)) 
            return $this->errorResponse($item->number.' is blocked number!',403);
            
            if($item->amount > $section->max_amount)
            return $this->errorResponse($item->number.' Invalid Amount!',403);

            if($item->amount < $section->min_amount)
            return $this->errorResponse($item->number.' Invalid Amount!',403);

        }

        try {
            DB::beginTransaction();

            $bet_slip = $this->create_bet_slip($request,$id);

            $this->create_bet_logs($request,$bet_slip->id);

          
            $randomStringtwo = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Transaction::create([
                'customer_id' => $request->user()->id,
                'transaction_id' => $randomStringtwo,
                'type' => 'addition',
                'amount' => $bet_slip->total_amount,
                'payer_account_name' => $request->user()->name,
                'payer_account_phone' => $request->user()->phone,
                'payment_transaction_id' => 0,
                'status' => "success",
                'transaction_model' => "twoD",
                'transaction_type' => "bet",
                'customer_name' => $request->user()->name,
                'payment_account_name' => $request->user()->name,
            ]);

            $customer = Customer::where('id',$request->user()->id)->first();
            Customer::where('id',$request->user()->id)->update([
                'balance' => $customer->balance - $bet_slip->total_amount,
            ]);
            DB::commit();
            return $this->successResponse($bet_slip);

        } catch (Exception $e) {

            DB::rollback();
            
            return $this->errorResponse($e->getMessage(),500);
            
        }
    
    }

    /**
     * 
     *
     * Private functions 
     * 
    */

    private function create_bet_slip($request,$section_id){

        $data =  [
            'customer_id'     => auth()->user()->id,
            'twod_section_id' => $section_id,
            'slip_number'     => $this->generate_slip_number(),
            'total_amount'    => $this->calculate_tot_bet_amount($request),
            'bet_date'        => now(),
            'is_reject'       => 0,
            'created_at'      => now()
        ];

        return TwodBetSlip::create($data);
    }

    private function create_bet_logs($request,$bet_slip_id){
        
        $betlog_data = [];

        foreach(json_decode($request->numbers) as $key => $item){
            $betlog_data[] = [
                'twod_bet_slip_id' => $bet_slip_id,
                'slip_number'      => $this->generate_slip_number(),
                'reward_amount'    => 0,
                'draw_date'        => now(),
                'bet_number'       => $item->number,
                'bet_amount'       => $item->amount,
                'created_at'       => now()
            ];
        }

        return TwodBetLog::insert($betlog_data);
    }

    private function calculate_tot_bet_amount($request){

        $total_bet_amount = 0;

        foreach(json_decode($request->numbers) as $key => $item){
            $total_bet_amount += (int)$item->amount;
        }

        return $total_bet_amount;
    }

    private function generate_slip_number(){

        // $uuid = Uuid::uuid4();

        $slip_number = Str::random(10);
        return '#'.str_replace('-', '', $slip_number);

    }
}
