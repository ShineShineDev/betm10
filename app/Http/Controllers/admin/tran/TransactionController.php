<?php

namespace App\Http\Controllers\admin\tran;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function filterDate(Request $request){
       
        $from_date = $request->from_Date;
        $to_date = $request->to_Date;
        $data = Transaction::whereBetween('created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59'])
        ->get();
        return view('admin.agents.index', compact('data'));
        
    }
}