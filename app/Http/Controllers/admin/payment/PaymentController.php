<?php

namespace App\Http\Controllers\admin\payment;

use App\Models\Pyament;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerDeposit;
use App\Models\CustomerWithdraw;
use App\Models\PaymentTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'payment_type' => 'required',
        'payment_name' => 'required',
        'payment_phone' => 'required',
        'rate' => 'nullable',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
    ]);

    // Generate a unique image name with a random string and the correct file extension
    $imageName = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();

    // Save the image to the 'public/uploads/slides' directory
    $request->file('image')->move(public_path('uploads/slides'), $imageName);

    // Add the image path to the validated data
    $validated['avatar'] = '/uploads/slides/' . $imageName;

    // Create a new Payment model instance with the validated data
    Pyament::create($validated);

    return back()->with('success', 'Payment record created successfully');
}

    
    public function index()
    {
        return response()->json(Pyament::all());
    }

    public function listdandw(){
        $data = PaymentTransaction::with(['payment_type'])->orderBy('id','desc')->get();
        return view('admin.transactions_manager.dandw', compact('data'));
    }

    public function comfirm($id){
        CustomerDeposit::where('id',$id)->update([
            'status' => 'comfirm',
        ]);
        $deposit = CustomerDeposit::with(['payment_type'])->get();
        return back()->with('deposit');
    }

    public function Withdrawcomfirm($id){
        CustomerWithdraw::where('id', $id)->update([
            'status' => 'comfirm',
        ]);
        $withdraw = CustomerWithdraw::with(['payment_type'])->get();
        return back()->with('withdraw');
    }

    public function listdandwfilter($id){
      $pay = PaymentTransaction::where('id',$id)->first();
      $cus_id = $pay->customer_id;
      $type = $pay->type;
      $Amount  =  $pay->customer_amount;
      if($type === "deposit"){
        PaymentTransaction::where('id', $id)->update([
                'status' => 'comfirm',
         ]);
        $cus = Customer::where('id',$cus_id)->first();
        Customer::where('id', $cus->id)->update([
            'balance' => $cus->balance + $Amount,
            'deposit' => $cus->deposit + $Amount
        ]);
            $randomStringtwo = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Transaction::create([
                'customer_id' => $cus_id,
                'transaction_id' => $randomStringtwo,
                'type' => 'addition',
                'amount' => (int)$Amount,
                'payer_account_name' => auth()->user()->name,
                'payer_account_phone' => auth()->user()->phone,
                'payment_transaction_id' => 0,
                "payment_id" => 0,
                'status' => "success",
                'transaction_model' => "deposit",
                'transaction_type' => "deposit",
                'customer_name' => $cus->name,
                'payment_account_name' => $cus->name,
            ]);

            $data = PaymentTransaction::with(['payment_type'])->get();
            return view('admin.transactions_manager.dandw', compact('data'));
      }else{
            PaymentTransaction::where('id', $id)->update([
                'status' => 'comfirm',
            ]);
            $cus = Customer::where('id', $cus_id)->first();
            Customer::where('id', $cus->id)->update([
                'balance' => $cus->balance - $Amount
            ]);
            $randomStringtwo = Str::random(20, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            Transaction::create([
                'customer_id' => $cus_id,
                'transaction_id' => $randomStringtwo,
                'type' => 'addition',
                'amount' => (int)$Amount,
                'payer_account_name' => auth()->user()->name,
                'payer_account_phone' => auth()->user()->phone,
                'payment_transaction_id' => 0,
                "payment_id" => 0,
                'status' => "success",
                'transaction_model' => "withdraw",
                'transaction_type' => "withdraw",
                'customer_name' => $cus->name,
                'payment_account_name' => $cus->name,
            ]);

            $data = PaymentTransaction::with(['payment_type'])->get();
            return view('admin.transactions_manager.dandw', compact('data'));
      }
    }
}
