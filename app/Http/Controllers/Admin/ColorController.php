<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        return view('backend.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.color.create');
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
            'color_name' => 'required|unique:colors',
            //'url' => 'required|unique:colors',
            //'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);


        $color = new Color();
        $color->color_name = $request->color_name;
        $color->color_code = $request->color_code;
        $color->save();
        Toastr::success('color Successfully Saved :)' ,'Success');
        return redirect()->route('admin.color.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(color $color)
    {
        return view('backend.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, color $color)
    {
        $this->validate($request,[
            'color_name' => 'required',
            // 'url' => 'required',
            // 'image' => 'required|image|mimes:jpeg,bmp,png,jpg,gif'
        ]);

        $color->color_name = $request->color_name;
        $color->color_code = $request->color_code;
        $color->save();
        Toastr::success('color Successfully Updated :)' ,'Success');
        return redirect()->route('admin.color.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(color $color)
    {
        $color->delete();
        Toastr::success('color Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
