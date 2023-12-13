<?php

namespace App\Http\Controllers\admin\thaid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThaiDSection;

class ThaidSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = ThaiDSection::paginate(30);
        return view('admin.thaid.section.index', compact(['sections']));
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
        $request->validate([
            "opening_date" => "required",
            "opening_time" => "required",
            "closing_time" => "required",
            "to_bet_amount" => "required",
            "user_commission" => "required",
            "agent_commission" => "required",
            "is_maintenace" => "required",
        ]);
        $input = [
            'opening_date' => $request->opening_date,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'to_bet_amount' => $request->to_bet_amount,
            'user_commission' => $request->user_commission,
            'agent_commission' => $request->agent_commission,
            'is_maintenace' => $request->is_maintenace,
            'status' => 1
        ];
        ThaiDSection::create($input);
        return back()->with('success', 'Section Added');

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
