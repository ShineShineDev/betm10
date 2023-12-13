<?php

namespace App\Http\Controllers\admin\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Support;
use Illuminate\Support\Str;

class SupportController extends Controller
{
    public function index(){
      $data = Support::all();
       return view('admin.support.index', compact('data'));
    }
    
    public function store(Request $request)
    {
       $validated = $request->validate([
        'phone' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);
    $imageName = time() . '-' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
    $request->file('image')->move(public_path('uploads/slides'), $imageName);
    $validated['image'] = '/uploads/slides/' . $imageName;
    Support::create($validated);
    $data = Support::all();
    return back()->with('data');
    }
}