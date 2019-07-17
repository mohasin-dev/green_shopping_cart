<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Setting;
use Carbon\Carbon;
use Image;
use File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $setting = Setting::findOrFail(1)->first();
        return view('backend.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $currentDate = Carbon::now()->toDateString();

        if ($request->hasFile('logo')) {
            if(File::exists('images/setting/'.$setting->logo)){
             File::delete('images/setting/'.$setting->logo);
            }
            $image = $request->file('logo');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(100, 50)->save($location);
            $setting->logo = $filename;
        }

        if ($request->hasFile('banner1')) {
            if(File::exists('images/setting/'.$setting->banner1)){
             File::delete('images/setting/'.$setting->banner1);
            }
            $image = $request->file('banner1');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(482, 180)->save($location);
            $setting->banner1 = $filename;
        }

        if ($request->hasFile('banner2')) {
            if(File::exists('images/setting/'.$setting->banner2)){
             File::delete('images/setting/'.$setting->banner2);
            }
            $image = $request->file('banner2');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(336, 180)->save($location);
            $setting->banner2 = $filename;
        }

        if ($request->hasFile('banner3')) {
            if(File::exists('images/setting/'.$setting->banner3)){
             File::delete('images/setting/'.$setting->banner3);
            }
            $image = $request->file('banner3');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(482, 180)->save($location);
            $setting->banner3 = $filename;
        }
        if ($request->hasFile('banner4')) {
            if(File::exists('images/setting/'.$setting->banner4)){
             File::delete('images/setting/'.$setting->banner4);
            }
            $image = $request->file('banner4');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(482, 180)->save($location);
            $setting->banner4 = $filename;
        }
        if ($request->hasFile('banner5')) {
            if(File::exists('images/setting/'.$setting->banner5)){
             File::delete('images/setting/'.$setting->banner5);
            }
            $image = $request->file('banner5');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(262, 83)->save($location);
            $setting->banner5 = $filename;
        }
        if ($request->hasFile('banner6')) {
            if(File::exists('images/setting/'.$setting->banner6)){
             File::delete('images/setting/'.$setting->banner6);
            }
            $image = $request->file('banner6');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(262, 264)->save($location);
            $setting->banner6 = $filename;
        }
        if ($request->hasFile('banner7')) {
            if(File::exists('images/setting/'.$setting->banner7)){
             File::delete('images/setting/'.$setting->banner7);
            }
            $image = $request->file('banner7');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(262, 264)->save($location);
            $setting->banner7 = $filename;
        }
        if ($request->hasFile('banner8')) {
            if(File::exists('images/setting/'.$setting->banner8)){
             File::delete('images/setting/'.$setting->banner8);
            }
            $image = $request->file('banner8');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(262, 264)->save($location);
            $setting->banner8 = $filename;
        }
        if ($request->hasFile('banner9')) {
            if(File::exists('images/setting/'.$setting->banner9)){
             File::delete('images/setting/'.$setting->banner9);
            }
            $image = $request->file('banner9');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(262, 264)->save($location);
            $setting->banner9 = $filename;
        }
        if ($request->hasFile('banner10')) {
            if(File::exists('images/setting/'.$setting->banner10)){
             File::delete('images/setting/'.$setting->banner10);
            }
            $image = $request->file('banner10');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/setting/'.$filename);
            Image::make($image)->resize(262, 316)->save($location);
            $setting->banner10 = $filename;
        }

        $setting->company_name = $request->company_name;
        $setting->email1 = $request->email1;
        $setting->email2 = $request->email2;
        $setting->address1 = $request->address1;
        $setting->address2 = $request->address2;
        $setting->mobile_number1 = $request->mobile_number1;
        $setting->mobile_number2 = $request->mobile_number2;
        $setting->live_news = $request->live_news;
        $setting->shipping_cost = $request->shipping_cost;
        $setting->save();
        Toastr::success('Settings Successfully Updated :)' ,'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
