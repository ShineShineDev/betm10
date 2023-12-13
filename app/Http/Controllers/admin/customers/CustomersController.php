<?php

namespace App\Http\Controllers\admin\customers;

use Carbon\Carbon;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Thaidbetslip;
use App\Models\Thaidcomfirm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerDeposit;
use App\Models\CustomerWithdraw;
use App\Models\PaymentTransaction;
use App\Models\TwodBetSlip;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(100);
        return view('admin.customers.index', compact(['customers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $dp = PaymentTransaction::where('customer_id',$id)->where('status','comfirm')->where("type","deposit")->get();
        $totalAmount = 0;
        foreach($dp as $d){
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return view('admin.customers.show', compact(['customer', 'totalAmount', 'totalAmountW']) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'is_suspended' => 'required',
        ]);
        $new_password = $request->new_password;
        $customer = Customer::find($id);
        if ($new_password != null) {
            $customer->password = Hash::make($new_password);
            $customer->save();
        }
        $customer->is_suspended = $request->is_suspended;
        $customer->type = $request->type;
        $customer->save();
        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showManageBalance($id){
        $customer = Customer::find($id);
        $dp = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return view('admin.customers.balance',compact('customer', 'totalAmount', 'totalAmountW'));
    }

    public function show2DBettingLists($id)
    {
        $customerTran = Transaction::where('customer_id', $id)->get();
        $customer = Customer::find($id);
        $dp = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return view('admin.customers.twodtransaction', compact('customer', 'customerTran','totalAmount', 'totalAmountW'));
    }

    public function show3DBettingLists($id)
    {
        $customer = Customer::find($id);
        $dp = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return view('admin.customers.threedtransaction', compact('customer', 'totalAmount', 'totalAmountW'));
    }

    public function showthaidBettingLists($id)
    {
        $customer = Customer::find($id);
        $bet = Thaidbetslip::with(['section', 'customer'])->where('customer_id',$id)->get();
        $finalArray = [];
        $reward = 0;
        foreach ($bet as $item) {
            $ToalAmount = 0;
            $Data = Thaidcomfirm::where('thaibetslip_id', $item['id'])->orderBy('created_at', 'desc')->get();
            foreach ($Data as $datas) {
                $ToalAmount += $datas['price'];
                $reward += $datas['reward'];
            }
            array_push($finalArray, [
                'name' => $item->customer[0]->name,
                'id' => $item['id'],
                'slip_number' => $item['slip_number'],
                'amount' => $ToalAmount,
                'reward' => $reward,
                'draw_date' => $item['draw_date'],
                'status' => $item->status === null ? Carbon::now()->lte(Carbon::parse($item->section?->opening_date)) : $item->status,
                'bet_date' => $item['bet_date'],
                'data' => $Data->toArray(),
            ]);
        }
        $dp = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return view('admin.customers.thaidtransaction', compact('customer','finalArray', 'totalAmount', 'totalAmountW'));
    }

    public function showTransactions($id)
    {
        $customerTran = Transaction::where('customer_id',$id)->get();
        $customer = Customer::find($id);
        $dp = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return view('admin.customers.transaction', compact('customer', 'customerTran', 'totalAmount','totalAmountW'));
    }

    public function addAmount(Request $request){
        $customerbalance = Customer::where('id',$request->customer_id)->first();
        Customer::where('id',$request->customer_id)->update([
            'balance' => $customerbalance->balance + (int)$request->add_amount
        ]);
        $randomString = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        Transaction::create([
            'customer_id' => $request->customer_id,
            'transaction_id' => $randomString,
            'type' => 'addition',
            'amount'=> (int)$request->add_amount,
            'payer_account_name'=> auth()->user()->name,
            'payer_account_phone' => auth()->user()->phone,
            'payment_transaction_id'=>0,
            'status'=> "success",
            'transaction_model' => "admin",
            'transaction_type' => "admin",
            'customer_name' => null,
            'payment_account_name' => null,
            ''
        ]);
        $dp = PaymentTransaction::where('customer_id', $request->customer_id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $request->customer_id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return back()->with('totalAmount', 'totalAmountW');
    }

    public function minusAmount(Request $request)
    {
        $customerbalance = Customer::where('id', $request->customer_id)->first();
        Customer::where('id', $request->customer_id)->update([
            'balance' => $customerbalance->balance - (int)$request->substract_amount
        ]);
        $randomString = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        Transaction::create([
            'customer_id' => $request->customer_id,
            'transaction_id' => $randomString,
            'type' => 'substract',
            'amount' => (int)$request->substract_amount,
            'payer_account_name' => auth()->user()->name,
            'payer_account_phone' => auth()->user()->phone,
            'payment_transaction_id' => 0,
            'status' => "success",
            'transaction_model' => "admin",
            'transaction_type' => "admin",
            'customer_name' => null,
            'payment_account_name' => null,
            ''
        ]);
        $dp = PaymentTransaction::where('customer_id', $request->customer_id)->where('status', 'comfirm')->where("type", "deposit")->get();
        $totalAmount = 0;
        foreach ($dp as $d) {
            $totalAmount += $d['customer_amount'];
        };
        $wd = PaymentTransaction::where('customer_id', $request->customer_id)->where('status', 'comfirm')->where("type", "withdraw")->get();
        $totalAmountW = 0;
        foreach ($wd as $w) {
            $totalAmountW += $w['customer_amount'];
        };
        return back()->with('totalAmount', 'totalAmount');
    }




}
