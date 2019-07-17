<?php

namespace App\Http\Controllers\Admin;

use App\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use File;
use Image;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();
        return view('backend.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.create');
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
            'title' => 'required',
            'short_description' => 'required|max:150',
            //'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        if ($request->hasFile('bg_image')) {

            $image = $request->file('bg_image');
            $filename1 = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/about/bg_images/'.$filename1);
            Image::make($image)->resize(1600, 900)->save($location);
        }else{
            $filename1 = 'bg_image.jpg';
        }

        if ($request->hasFile('fg_image')) {

            $image = $request->file('fg_image');
            $filename2 = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/about/fg_images/'.$filename2);
            Image::make($image)->resize(1600, 900)->save($location);
        }


        $about = new About();
        $about->title = $request->title;
        // $about->slug = str_slug($request->title);
        $about->short_description = $request->short_description;
        $about->description = $request->description;
        $about->bg_image = $filename1;
        $about->fg_image = $filename2;
        $about->save();
        Toastr::success('about Successfully Saved :)' ,'Success');
        return redirect()->route('admin.about.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('backend.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
    $this->validate($request,[
        'title' => 'required',
        'short_description' => 'required|max:150',
        //'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
    ]);

    if ($request->hasFile('bg_image')) {

        $image = $request->file('bg_image');

        if(File::exists('images/about/bg_images/' .$about->bg_image)){
            File::delete('images/about/bg_images/' .$about->bg_image);
        }

        $filename1 = time().'.'.$image->getClientOriginalExtension();
        $location = public_path('images/about/bg_images/'.$filename1);
        Image::make($image)->resize(1600, 900)->save($location);
    }else{
        $filename1 = 'bg_image.jpg';
    }

    if ($request->hasFile('fg_image')) {

        $image = $request->file('fg_image');

        if(File::exists('images/about/fg_images/' .$about->fg_image)){
            File::delete('images/about/fg_images/' .$about->fg_image);
        }

        $filename2 = time().'.'.$image->getClientOriginalExtension();
        $location = public_path('images/about/fg_images/'.$filename2);
        Image::make($image)->resize(1600, 900)->save($location);
    }


    $about->title = $request->title;
    // $about->slug = str_slug($request->title);
    $about->short_description = $request->short_description;
    $about->description = $request->description;
    $about->bg_image = $filename1;
    $about->fg_image = $filename2;
    $about->save();
    Toastr::success('about Successfully Updated :)' ,'Success');
    return redirect()->route('admin.about.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $about->delete();
        Toastr::success('about Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
