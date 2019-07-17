<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use File;
use Image;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('backend.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'name' => 'required|unique:brands',
            //'url' => 'required|unique:brands',
            //'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/brand/'.$filename);
            Image::make($image)->resize(255, 291)->save($location);
        }else{
            $filename = 'default.png';
        }


        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = str_slug($request->name);
        $brand->logo = $filename;
        $brand->save();
        Toastr::success('brand Successfully Saved :)' ,'Success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        return view('backend.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brand $brand)
    {
        $this->validate($request,[
            'name' => 'required',
            // 'url' => 'required',
            // 'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        if ($request->hasFile('logo')) {

            if(File::exists('images/brand/' .$brand->logo)){
                File::delete('images/brand/' .$brand->logo);
            }

            $image = $request->file('logo');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/brand/'.$filename);
            Image::make($image)->resize(255, 291)->save($location);
        }else{
            $filename = 'default.png';
        }

        $brand->name = $request->name;
        $brand->slug = str_slug($request->name);
        $brand->logo = $filename;
        $brand->save();
        Toastr::success('brand Successfully Updated :)' ,'Success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        $brand->delete();
        Toastr::success('brand Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
