<?php

namespace App\Http\Controllers\admin;

use App\Models\Slide;
use App\Models\SlideText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $slides = Slide::all();
        $slidetext = SlideText::first();
        return view('admin.dashboard', compact(['slides', 'slidetext']));
    }
}