<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TwodManager\TwodDefaultSettings\UpdateTwodDefaultSetting;
use App\Http\Requests\Admin\TwodManager\TwodDefaultSettings\UpdateTwodDefaultSettingRequest;
use App\Models\TwodDefaultSetting;
use Illuminate\Http\Request;

class TwodDefaultSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit()
    {
        $default_setting = TwodDefaultSetting::first();
        return view('admin.twod_manager.twod_default_settings.edit')->with(['data'=> $default_setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTwodDefaultSettingRequest $request)
    {
        $default_setting = TwodDefaultSetting::first();

        $data = $this->getRequestData($request);

        if($default_setting) $default_setting->update($data);

        TwodDefaultSetting::create($data);

        return redirect()->route('admin.twod_default_settings.edit')->with(['success' => 'Updated Successfully']);
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

    private function getRequestData($request){
        return [
            'opening_time'     => $request->opening_time,
            'closing_time'     => $request->closing_time,
            'odd'              => $request->odd,
            'user_commission'  => $request->user_commission,
            'agent_commission' => $request->agent_commission,
            'min_amount'       => $request->min_amount,
            'max_amount'       => $request->max_amount,
            'block_numbers'    => $request->block_numbers,
            'created_at'       => now()
        ];
    }
}
