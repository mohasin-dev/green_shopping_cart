<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->get();
        return view('backend.client.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.client.create');
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
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->image);
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/client/'.$filename);
            //$path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
            Image::make($image)->resize(150, 100)->save($location);
        }

        $client = new Client();
        $client->image = $filename;
        $client->save();
        Toastr::success('client Successfully Saved :)' ,'Success');
        return redirect()->route('admin.client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        return view('backend.client.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        $this->validate($request,[
            'image' => 'required',
        ]);

        $image = $request->file('image');

        $slug = str_slug($request->image);
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            if(File::exists('images/client/' .$client->image)){
                File::delete('images/client/' .$client->image);
            }
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/client/'.$filename);
            //$path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
            Image::make($image)->resize(150, 100)->save($location);
            $client->image = $filename;
        }

        $client->save();
        Toastr::success('client Successfully Saved :)' ,'Success');
        return redirect()->route('admin.client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        $client->delete();
        Toastr::success('client Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
