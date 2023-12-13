<?php

namespace App\Http\Controllers\admin\thai_lottery_manager;

use App\Models\Thaidprice;
use Illuminate\Http\Request;
use App\Models\Thaidpricenumber;
use App\Http\Controllers\Controller;
use App\Models\Thaidcomfirm;

class ThaiLotteryNumberDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Data = Thaidcomfirm::get();
        $totalAmount = 0;
        foreach($Data as $d){
            $totalAmount += $d['price'];;
        }
        $Obj = [
            'total_price' => $totalAmount,
            'data' => $Data,
        ];
        return view('admin.thai_lottery_manager.thai_lottery_number_details.index', compact('Obj'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}