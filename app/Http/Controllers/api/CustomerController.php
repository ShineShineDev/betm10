<?php

namespace App\Http\Controllers\api;

use Exception;
use Carbon\Carbon;
use App\Models\Pyament;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerDeposit;
use App\Models\CustomerWithdraw;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    
     public function checkToken(Request $request){
        $request->validate([
            'token' => 'required'
        ]);
        try {
            $request->user()->update(['fcm_token_key' => $request->token]);
            return response()->json([
                'user' => Customer::find($request->user()->id),
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }
    
    public function balance(Request $request)
    {
        $data = Customer::where('id', $request->user()->id)->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
         $request->validate([
            'payment_id' => 'required',
            'customer_amount' => 'required',
            'customer_phone' => 'required',
            'customer_name' => 'required',
            'transaction_number'=>'required'
         ]);
        try {
            DB::beginTransaction();
            $cu = PaymentTransaction::create([
                'customer_id' => $request->user()->id,
                'payment_id' => $request->payment_id,
                "customer_amount" => $request->customer_amount,
                "customer_phone" => $request->customer_phone,
                "customer_name" => $request->customer_name,
                "transaction_number" => $request->transaction_number,
                "date" => Carbon::now(),
                "type"=>"deposit",
                "status" => 'pending',
            ]);

            $randomStringtwo = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Transaction::create([
                'customer_id' => $request->user()->id,
                'transaction_id' => $randomStringtwo,
                'type' => 'addition',
                'amount' => (int)$request->customer_amount,
                'payer_account_name' => $request->customer_name,
                'payer_account_phone' => $request->customer_phone,
                'payment_transaction_id' => $cu->id,
                "payment_id" => $request->payment_id,
                'status' => "success",
                'transaction_model' => "deposit",
                'transaction_type' => "deposit",
                'customer_name' => $request->customer_name,
                'payment_account_name' => $request->customer_name,
            ]);

            DB::commit();
            $data = [
                'data' => PaymentTransaction::with(['payment_type'])->find($cu->id),
                'message' => 'Successfully Create',
            ];
            return response()->json($data, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["errorMessage" => $e->getMessage(), 500]);
        }
    }

    public function storeWithdraw(Request $request)
    {
        $request->validate([
            'payment_id' => 'required',
            'customer_amount' => 'required',
            'customer_phone' => 'required',
            'customer_name' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $cu = PaymentTransaction::create([
                'customer_id' => $request->user()->id,
                'payment_id' => $request->payment_id,
                "customer_amount" => $request->customer_amount,
                "customer_phone" => $request->customer_phone,
                "customer_name" => $request->customer_name,
                "date" => Carbon::now(),
                "type" => "withdraw",
                "status" => 'pending',
            ]);

            $randomStringtwo = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Transaction::create([
                'customer_id' => $request->user()->id,
                'transaction_id' => $randomStringtwo,
                'type' => 'addition',
                'amount' => (int)$request->customer_amount,
                'payer_account_name' => $request->customer_name,
                'payer_account_phone' => $request->customer_phone,
                'payment_transaction_id' => $cu->id,
                "payment_id" => $request->payment_id,
                'status' => "success",
                'transaction_model' => "withdraw",
                'transaction_type' => "withdraw",
                'customer_name' => $request->customer_name,
                'payment_account_name' => $request->customer_name,
            ]);
            DB::commit();
            $data = [
                'data' => PaymentTransaction::with(['payment_type'])->find($cu->id),
                'message' => 'Successfully Create',
            ];
            return response()->json($data, 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['errorMessage' => $e->getMessage(), 500]);
        }
    }
}
