<?php

namespace App\Http\Controllers\Admin;

use App\fontAwesome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class FontAwesomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $icons = FontAwesome::all();
        return view('backend.fontAwesome.index', compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.fontAwesome.create');
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
            'icon' => 'required|unique:font_awesomes',
            
        ]);


        $fontAwesome = new FontAwesome();
        $fontAwesome->icon = $request->icon;
        $fontAwesome->save();
        Toastr::success('fontAwesome Successfully Saved :)' ,'Success');
        return redirect()->route('admin.fontAwesome.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fontAwesome  $fontAwesome
     * @return \Illuminate\Http\Response
     */
    public function show(fontAwesome $fontAwesome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fontAwesome  $fontAwesome
     * @return \Illuminate\Http\Response
     */
    public function edit(fontAwesome $fontAwesome)
    {
        return view('backend.fontAwesome.edit', compact('fontAwesome'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fontAwesome  $fontAwesome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fontAwesome $fontAwesome)
    {
        $this->validate($request,[
            'icon' => 'required',
        ]);


        $fontAwesome->icon = $request->icon;
        $fontAwesome->save();
        Toastr::success('fontAwesome Successfully Updated :)' ,'Success');
        return redirect()->route('admin.fontAwesome.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fontAwesome  $fontAwesome
     * @return \Illuminate\Http\Response
     */
    public function destroy(fontAwesome $fontAwesome)
    {
        $fontAwesome->delete();
        Toastr::success('fontAwesome Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
