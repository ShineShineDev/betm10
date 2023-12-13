<?php

namespace App\Http\Controllers\admin;

use App\Models\ClosingDay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClosingDayController extends Controller
{
    public function index()
    {
        $data = ClosingDay::paginate(10);
        return view('admin.closing_days.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.closing.create');
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
            'date' => 'required|date|date_format:Y-m-d',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $closingDay = new ClosingDay;
        $closingDay->date = $request->date;
        $closingDay->title = $request->title;
        $closingDay->description = $request->description ?? '';
        $closingDay->save();
        return redirect()->route('admin.closing-days.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClosingDay  $closingDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClosingDay $closingDay)
    {
        $closingDay->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
