<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::whereIn('key', ['facebook_link', 'telegram_link', 'youtube_link'])->get();
        $data = [];
        foreach($settings as $key=>$setting){
            $data[$setting->key] = $setting->value;
        }

        return view('admin.setting.index',[
            'settings' => $data
        ]);
    }

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $data) {
            $settings  = Setting::where('key', $key)->update([
                'value' => $data,
            ]);
        }
        return redirect()->route('admin.setting.index', compact('settings'));
    }
}
