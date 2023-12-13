<?php

namespace App\Http\Controllers\admin\twod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Twod\StoreTwodScheduleRequest;
use App\Models\TwodSchedule;
use App\Models\TwodType;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class TwodScheduleController extends Controller
{
    public function index(){
        $data = TwodSchedule::paginate(15);
        $types = TwodType::orderBy('id','desc')->get();
        return view('admin.twod.schedules.index')->with(['data'=> $data,'types'=>$types]);
    }

    public function create(){
    }
    
    public function store(StoreTwodScheduleRequest $request){

        $data = $this->getRequestData($request,true);
    
        TwodSchedule::create($data);

    
        return redirect()->route('admin.twod_schedules.index')->with(['success' => 'Created Successfully']);
        
    }

    public function edit($id){
        $types = TwodType::orderBy('id','desc')->get();
        $twodSchedule = TwodSchedule::where('id',$id)->first();
        return view('admin.twod.schedules.edit')->with(['data'=>$twodSchedule,'types'=>$types]);
        // return response()->json([
        //     "data" => $twodSchedule
        // ],200);
    }

    public function update(StoreTwodScheduleRequest $request,$id){

        $schedule = TwodSchedule::where('id',$id)->first();
    
        $data = $this->getRequestData($request,false);
    
        if(!$schedule) return abort(404);

        $schedule->update($data);
    
        return redirect()->route('admin.twod_schedules.index')->with(['success' => 'Updated Successfully']);
 
    }

    public function destroy($id){

        $schedule = TwodSchedule::where('id',$id)->first();

        if(!$schedule) return abort(404);

        $schedule->delete();

        return response()->json(['success'=> true]);
    }

    private function getRequestData($request,$create){
        $data = [
            'twod_type_id'     => $request->twod_type_id,
            'opening_time'     => $request->opening_time,
            'closing_time'     => $request->closing_time,
            'odd'              => $request->odd,
            'user_commission'  => $request->user_commission,
            'agent_commission' => $request->agent_commission,
            'min_amount'       => $request->min_amount,
            'max_amount'       => $request->max_amount,
            'block_numbers'    => $request->block_numbers,
            'status'           => $request->status ? 1 : 0,
        ];
        if($create) $data['created_at'] = now();
        if(!$create) $data['updated_at'] = now();
        return $data;
    }

}
