<?php

namespace App\Http\Controllers\admin;

use App\Models\Slide;
use App\Models\SlideText;
use App\Traits\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ThreeDBettingSlip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SlideController extends Controller
{
    use FileUpload;

    public function index()
    {
        return view('admin.slide.index', compact('home_page_slides', 'service_page_slides', 'home_banner_text', 'service_banner_text'));
    }

    public function create()
    {
        return view('admin.slide.create');
    }

    private function base64ToImage($base64)
    {
        $image = str_replace('data:image/png;base64,', '', $base64);
        $image = str_replace(' ', '+', $image);
        $imageName = time() . '-' . Str::random(10) . '.' . 'png';
        File::put(public_path('uploads/slides') . '/' . $imageName, base64_decode($image));
        return '/uploads/slides/' . $imageName;
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        Slide::create([
            'name' => $request->name,
            'image' => $this->base64ToImage($request->image),
            'link' => $request->link,
            'sort' => $request->sort ?? 0,
        ]);
        Session::flash('success', 'Slide created successfully!');
        return redirect()->route('admin.dashboard');
    }


    public function show(Slide $slide)
    {
        //
    }


    public function edit(Slide $slide)
    {
        return view('admin.slide.edit', compact('slide'));
    }


    public function update(Request $request, Slide $slide)
    {
        $request->validate($this->rules());

        $slide->update([
            'name' => $request->name,
            'sort' => $request->sort ?? 0,
        ]);

        if ($request->has('image')) {
            $this->deleteFile($slide->image);
            $image = $this->base64ToImage($request->image);
            $slide->update([
                'image' => $image
            ]);
        }

        Session::flash('success', 'Slide updated successfully!');
        return redirect()->route('admin.dashboard');
    }


    public function destroy(Slide $slide)
    {
        $slide->delete();
        Session::flash('success', 'Slide deleted successfully!');
        return redirect()->route('admin.dashboard');
    }


    public function rules()
    {
        return [
            'image' => 'required',
            'name' => 'nullable|string|max:255',
            'sort' => 'nullable|integer',
        ];
    }

    public function slideTextEdit($id)
    {
        $slidetext = SlideText::where('id', $id)->first();
        return view('admin.slidetext.edit', compact('slidetext'));
    }

    public function slideTextUpdate(Request $request)
    {
        SlideText::where('id', $request->id)->update([
            'text' => $request->text,
        ]);
        $slides = Slide::all();
        $slidetext = SlideText::first();
        return view('admin.dashboard', compact(['slides', 'slidetext']));
    }
}
