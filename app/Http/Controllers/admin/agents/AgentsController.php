<?php

namespace App\Http\Controllers\admin\agents;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Agent;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaction::all();
        return view('admin.agents.index',compact('data'));
    }
    
     public function showPendings()
    {
        return view('admin.agents.create');
    }


    public function storeAgent(Request $request){
       $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'password' => 'required',
       ]);

       $agentCode = Str::random(6);
       $imageName = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
       $request->file('image')->move(public_path('uploads/image'), $imageName);
       $imagefront = time() . '-' . Str::random(10) . '.' . $request->file('nrc_front')->getClientOriginalExtension();
       $request->file('nrc_front')->move(public_path('uploads/image'), $imagefront);
       $imageback = time() . '-' . Str::random(10) . '.' . $request->file('nrc_back')->getClientOriginalExtension();
       $request->file('nrc_back')->move(public_path('uploads/image'), $imageback);

       $Agent = new Agent();
       $Agent->name = $request->name;
       $Agent->phone = $request->phone;
       $Agent->password = $request->password;
       $Agent->agent_code = $agentCode;
       $Agent->image = '/uploads/image/' . $imageName;
       $Agent->nrc_front_photo	 = '/uploads/image/' . $imagefront;
       $Agent->nrc_back_photo = '/uploads/image/' . $imageback;
       $Agent->save();

       return back();
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
        echo $id;
        return view('admin.agents.show');
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
