<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = new Customer;
        if ($request->search) {
            $customers = $customers->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', $request->search)->orWhere('phone', 'LIKE', $request->search);
            });
        }
        $customers = $customers->latest()->paginate(100);
        return view('admin.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:customers|string|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->password = Hash::make($request->password);
        $customer->save();
        return redirect()->route('admin.customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customer.index');
    }
    
    public function showChangePassword(Request $request, Customer $customer)
    {
        return view('admin.customer.change-password', compact('customer'));
    }

    public function updatePassword(Request $request, Customer $customer)
    {
    
        $request->validate([
            'password' => 'required|string|min:8'
        ]);

        $customer->password = Hash::make($request->password);
        $customer->update();
        return redirect()->route('admin.customer.show', $customer->id);
    }
    

    public function show2DBettingLists(Request $request, Customer $customer)
    {
        $betting_lists = $customer->betting_logs_2d()->paginate(10);
        return view('admin.customer.twod_betting_list', compact('betting_lists', 'customer'));
    }

    public function show3DBettingLists(Request $request, Customer $customer)
    {
        $betting_lists = $customer->betting_logs_3d()->paginate(10);
        return view('admin.customer.threed_betting_list', compact('betting_lists', 'customer'));
    }

    public function showManageBalance(Request $request, Customer $customer)
    {
        return view('admin.customer.balance', compact('customer'));
    }

    public function showTransactions(Request $request, Customer $customer)
    {
        $transactions = $customer->transactions()->paginate(10);
        return view('admin.customer.transaction', compact('customer', 'transactions'));
    }

    public function addBalance(Request $request, Customer $customer)
    {
        $request->validate([
            'add_amount' => 'required|integer|min:1'
        ]);
        $customer->add((int)$request->add_amount);
        return back();
    }

    public function substractBalance(Request $request, Customer $customer)
    {
        $request->validate([
            'substract_amount' => 'required|integer|min:1|max:' . $customer->balance
        ]);
        $customer->substract((int)$request->substract_amount);
        return back();
    }
}
