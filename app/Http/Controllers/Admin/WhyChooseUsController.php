<?php

namespace App\Http\Controllers\Admin;

use App\Why;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\FontAwesome;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whyChooseUses = Why::latest()->get();
        return view('backend.whyChooseUs.index',compact('whyChooseUses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = FontAwesome::latest()->get();
        return view('backend.whyChooseUs.create', compact('icons'));
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
            'title' => 'required|unique:whies',
        ]);


        $whyChooseUs = new Why();
        $whyChooseUs->title = $request->title;
        $whyChooseUs->description = $request->description;
        $whyChooseUs->icon_id = $request->icon_id;
        $whyChooseUs->save();
        Toastr::success('Item Successfully Saved :)' ,'Success');
        return redirect()->route('admin.whychooseus.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Why  $why
     * @return \Illuminate\Http\Response
     */
    public function show(Why $why)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Why  $why
     * @return \Illuminate\Http\Response
     */
    public function edit(Why $why, $id)
    {
        //echo $id;
        $whyChooseUs = Why::findOrFail($id);
        $icons = FontAwesome::latest()->get();
        return view('backend.whyChooseUs.edit',compact('whyChooseUs', 'icons'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Why  $why
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'title' => 'required',
        ]);

        $whyChooseUs = Why::findOrFail($id);
        $whyChooseUs->title = $request->title;
        $whyChooseUs->description = $request->description;
        $whyChooseUs->icon_id = $request->icon_id;
        $whyChooseUs->save();
        Toastr::success('Item Successfully Updated :)' ,'Success');
        return redirect()->route('admin.whychooseus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Why  $why
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $whyChooseUs = Why::findOrFail($id);
        $whyChooseUs->delete();
        Toastr::success('service Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
