<?php

namespace App\Http\Controllers\admin\thai_lottery_manager;

use App\Http\Controllers\Controller;
use App\Models\Thaidsection;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThaidSectionController  extends Controller
{
    public function thaidsection(){
        $data = Thaidsection::orderBy('opening_date', 'desc')->get();
        return view('admin.thai_lottery_manager.section.index',compact('data'));  
    }

    public function thaidsectioncreate(Request $request){
       $date = $request->sectiondate;
       Thaidsection::create([
        'opening_date' => $date,
        'date'=> Carbon::now(),
        'rate' => $request->rate,
        'price' => $request->price,
       ]);
       return back();
    }

    public function delete($id){
       Thaidsection::where('id',$id)->delete();
       return back();
    }
}
