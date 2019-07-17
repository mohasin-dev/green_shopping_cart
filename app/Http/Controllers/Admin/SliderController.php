<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use File;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'title' => 'required',
            // 'description' => 'required|max:150',
            'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/slider/'.$filename);
            Image::make($image)->resize(848, 270)->save($location);
        }else{
            $filename = 'default.jpg';
        }

        $slider = new Slider();
        $slider->branding = $request->branding;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $filename;
        $slider->save();
        Toastr::success('slider Successfully Saved :)' ,'Success');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request,[
            //'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            if(File::exists('images/slider/' .$slider->image)){
                File::delete('images/slider/' .$slider->image);
            }
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/slider/'.$filename);
            Image::make($image)->resize(848, 270)->save($location);
        }else{
            $filename = 'default.jpg';
        }

        $slider->branding = $request->branding;
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $filename;
        $slider->save();
        Toastr::success('slider Successfully Saved :)' ,'Success');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        Toastr::success('slider Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
