<?php

namespace App\Http\Controllers\admin\twod;

use App\Models\TwodType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwodTypeController extends Controller
{
    public function index()
    {
        $types = TwodType::latest()->paginate(10);
        return view('admin.twod.types.index',compact('types'));
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
            'name' => 'required|string|max:255'
        ]);

        $type = new TwodType();
        $type->name = $request->name;
        $type->has_set_value = ($request->has_set_value == "1");
        $type->save();

        return redirect()->route('admin.twod_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TwodType  $twodType
     * @return \Illuminate\Http\Response
     */
    public function show(TwodType $twodType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TwodType  $twodType
     * @return \Illuminate\Http\Response
     */
    public function edit(TwodType $twodType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TwodType  $twodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TwodType $twodType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TwodType  $twodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TwodType $twodType)
    {
        //
    }
}
