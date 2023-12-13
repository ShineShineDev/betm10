<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Threedsection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Http\Resources\TransactionResource;


class TransactionController extends Controller
{
    public function getlist(Request $request){
            $query = PaymentTransaction::where('customer_id', $request->user()->id);
            $queryOne = PaymentTransaction::where('customer_id', $request->user()->id);
                 
            $with = $query->where('type','withdraw')->get();
            $dep = $queryOne->where('type','deposit')->get();
       
             $final = [
            'deposit' => TransactionResource::collection($dep),
            'withdraw' => TransactionResource::collection($with),
        ];

            
            
        return response()->json($final);
    }
    
    public function store(Request $request)
    {
       try{
        DB::beginTransaction();
            $request->validate([
                "customer_id" => 'required',
                "type" => 'required',
                "amount" => 'required',
                "payment_id" => 'required',
            ]);

            $randomString = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Str::upper($randomString);

            $data = Transaction::create([
                "customer_id" => $request->customer_id,
                "transaction_id" => $randomString,
                "type" => $request->type,
                "amount" => $request->amount,
                "payer_account_name" => $request->payer_account_name,
                "payer_account_phone" => $request->payer_account_phone,
                "payment_transaction_id" => $request->payment_transaction_id,
                "receiver_account_name" => $request->receiver_account_name,
                "receiver_account_phone" => $request->receiver_account_phone,
                "payment_id" => $request->payment_id,
                "duration" => $request->duration,
                "note" => $request->note,
                "status" => $request->status,
            ]);
            DB::commit();
            return response()->json(Transaction::find($data->id));
       }catch(Exception $e){
        DB::rollback();
        return response()->json(["errorMessage" =>$e->getMessage(),500]);
       }
    }
}
