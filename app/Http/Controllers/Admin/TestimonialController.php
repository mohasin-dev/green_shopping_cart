<?php

namespace App\Http\Controllers\Admin;

use App\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonial.create');
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
            'name' => 'required',
        ]);

        $image = $request->file('avatar');
        $slug = str_slug($request->name);
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('avatar')) {
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/testimonial/'.$filename);
            //$path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
            Image::make($image)->resize(400, 400)->save($location);
        }
        
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organization = $request->organization;
        $testimonial->opinion = $request->opinion;
        $testimonial->avatar = $filename;
        $testimonial->save();
        Toastr::success('testimonial Successfully Saved :)' ,'Success');
        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('backend.testimonial.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $image = $request->file('avatar');
       
        $slug = str_slug($request->name);
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('avatar')) {
            if(File::exists('images/testimonial/' .$testimonial->avatar)){
                File::delete('images/testimonial/' .$testimonial->avatar);
            }
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/testimonial/'.$filename);
            //$path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
            Image::make($image)->resize(400, 400)->save($location);
            $testimonial->avatar = $filename;
        }
        
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organization = $request->organization;
        $testimonial->opinion = $request->opinion;
        $testimonial->save();
        Toastr::success('testimonial Successfully Saved :)' ,'Success');
        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        Toastr::success('Testimonial Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
