<?php

namespace App\Http\Controllers\admin\thai_lottery_manager;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Thaidbetslip;
use App\Models\Thaidcomfirm;
use App\Models\Thaidsection;
use Illuminate\Http\Request;
use App\Models\Thaidpricenumber;
use App\Http\Controllers\Controller;

class WinnerController  extends Controller
{
    public function index(Request $request)
    {
        $data = Thaidcomfirm::with(['betslip.customer', 'betslip.section', 'thaidprice.thaidprice'])
        ->where('thaidprice', '!=', null)
        ->where('reward', 0)
        ->get()
        ->toArray();
        $oddA = Thaidsection::latest()->first();
        $odd = $oddA->rate;
        $ReturnBath = 0;
        if ($data) {
            $odd = $data[0]['betslip'][0]['section']['rate'];
            $bath = 0;
            foreach ($data as $d) {
                $bath += $d['thaidprice'][0]['thaidprice']['amount'];
            }
            $ReturnBath = $bath * $odd;
            return view('admin.thai_lottery_manager.winner.winner', compact('data', 'odd', 'ReturnBath'));
        }
        return view('admin.thai_lottery_manager.winner.winner', compact('data', 'odd', 'ReturnBath'));
    }

    public function comfirm(Request $request)
    {

        $dataAll = Thaidcomfirm::with(['betslip.customer', 'betslip.section', 'thaidprice.thaidprice'])->where('thaidprice', '!=', null)->get()->toArray();
        $odd = $dataAll[0]['betslip'][0]['section']['rate'];

        $finalArray = [];
        foreach ($dataAll as $d) {
            Thaidcomfirm::where('thaidprice', '!=', null)->where('id', $d['id'])->update([
                'reward' => $d['thaidprice'][0]['thaidprice']['amount'] * $odd
            ]);
            Thaidbetslip::where('id', $d['betslip'][0]['id'])->where('is_reject', 0)->update([
                'reward' => $d['thaidprice'][0]['thaidprice']['amount'] * $odd,
                'draw_date' => Carbon::now()
            ]);

            $cus = Customer::where('id', $d['betslip'][0]['customer'][0]['id'])->first();
            Customer::where('id', $d['betslip'][0]['customer'][0]['id'])->update([
                'balance' => $cus->balance + $d['thaidprice'][0]['thaidprice']['amount'] * $odd
            ]);

            $randomString = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Str::upper($randomString);

            $data = Transaction::create([
                "customer_id" => $d['betslip'][0]['customer'][0]['id'],
                "transaction_id" => $randomString,
                "type" => 'addition',
                "amount" => $d['thaidprice'][0]['thaidprice']['amount'] * $odd,
                "payer_account_name" => 'Admin',
                "payer_account_phone" => 0,
                "receiver_account_name" =>  $d['betslip'][0]['customer'][0]['name'],
                "receiver_account_phone" =>  $d['betslip'][0]['customer'][0]['phone'],
                "payment_id" => 0,
                "note" => null,
                'transaction_model' => 'Winner',
                'transaction_type' =>'reward',
                "status" => 'pending',
            ]);
        }

        $data = Thaidcomfirm::with(['betslip.customer', 'betslip.section', 'thaidprice.thaidprice'])->where('thaidprice', '!=', null)->get()->toArray();
        $odd = $data[0]['betslip'][0]['section']['rate'];
        $bath = 0;
        foreach ($data as $d) {
            $bath += $d['thaidprice'][0]['thaidprice']['amount'];
        }
        $ReturnBath = $bath * $odd; 
        return back()->with('data', 'odd', 'ReturnBath');
    }

    public function list()
    {
        $data = Thaidcomfirm::with(['betslip.customer', 'betslip.section', 'thaidprice.thaidprice'])->where('thaidprice', '!=', null)->where('reward','!=',0)->get()->toArray();
        $ReturnBath = 0;

        $oddA = Thaidsection::latest()->first();
        $odd = $oddA->rate;
        $bath = 0;
        foreach ($data as $d) {
            $bath += $d['thaidprice'][0]['thaidprice']['amount'];
        }
        $ReturnBath = $bath * $odd;
        return view('admin.thai_lottery_manager.winner.winnerlist', compact('data', 'odd', 'ReturnBath'));
    }

    public function filter(Request $request){
        $data = Thaidcomfirm::with(['betslip.customer', 'betslip.section', 'thaidprice.thaidprice'])
        ->where('thaidprice', '!=', null)
        ->where('reward', '!=', 0)
        ->whereBetween('created_at',[$request->from_date,$request->to_date])
        ->get()
        ->toArray();
        if($data){
            $ReturnBath = 0;
            $odd = $data[0]['betslip'][0]['section']['rate'];
            $bath = 0;
            foreach ($data as $d) {
                $bath += $d['thaidprice'][0]['thaidprice']['amount'];
            }
            $ReturnBath = $bath * $odd;
            return view('admin.thai_lottery_manager.winner.winnerlist', compact('data', 'odd', 'ReturnBath'));
        }
        $oddA = Thaidsection::latest()->first();
        $odd = $oddA->rate;
        $ReturnBath = 0;
        return view('admin.thai_lottery_manager.winner.winnerlist', compact('data', 'odd', 'ReturnBath'));
    }
}
