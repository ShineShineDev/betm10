<?php

namespace App\Http\Controllers\admin\threed;

use App\Http\Controllers\Controller;
use App\Models\ThreeDDefaultSetting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ThreedDefaultSettingController extends Controller
{

    public function index()
    {
        return \Redirect::route('admin.threed.default_settings.edit', 1);
    }

    public function edit($id)
    {
        $threed_default_setting = ThreeDDefaultSetting::find(1);
        return view('admin.threed.default_settings.edit', compact(['threed_default_setting']));
    }

    public function update(Request $request, $id)
    {

        $input = $request->only([
            "odd",
            "r_odd",
            "min_amount",
            "max_amount",
            "user_commission",
            "agent_commission",
            "closing_time",
            "block_numbers",
            "is_maintenace",
        ]);
        ThreeDDefaultSetting::where('id', $id)->update($input);
        return \Redirect::route('admin.threed.default_settings.edit', 1)->with('success', 'Updated!');
    }
}