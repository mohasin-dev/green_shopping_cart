<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use App\District;
use App\Upazila;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
use File;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Order;
use App\Subscriber;

class DashboardController extends Controller
{
    public function index()
    {
        $total_order = Order::count();
        $total_user = User::where('status', 2)->count();
        // $total_subscriber = Subscriber::count();
        $total_sale = Order::where('complete', 1)->sum('total');
        $todays_order = Order::where('created_at', today())->count();
        $todays_sale = Order::where('complete', 1)->where('created_at', today())->sum('total');
        $total_product = Product::count();

        // $total_order = 10;
        // $total_user = 10;
        // $total_subscriber = 10;
        // $total_sale = 10;
        // $todays_order = 10;
        // $todays_sale = 10;
        // $total_product = 10;
        return view('backend.dashboard', compact('total_product', 'total_order', 'total_sale', 'todays_sale', 'todays_order', 'total_user'));
    }

    public function profile()
    {
        $admin_id = Auth::user()->id;
        $admin = User::find($admin_id);
        return view('admin.profile', compact('admin'));
    }

    public function edit($id)
    {
        $districts = District::all();
        $upazilas = Upazila::all();
         return view('admin.edit', compact('districts', 'upazilas'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            if(File::exists('images/user'.$user->image)){
                File::delete('images/user'.$user->image);
               }
            $image = $request->file('image');
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/user/'.$filename);
            Image::make($image)->resize(200, 200)->save($location);
        }else{
            $filename = 'user.png';
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->upazila_id = $request->upazila_id;
        $user->image = $filename;
        $user->save();
        Toastr::success('Profile Successfully Updated:)','Success');
        return redirect()->route('admin.profile');
    }

    public function change_password()
    {
        return view('admin.changepassword');
    }

    public function change_password_update(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->route('admin.dashboard');
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }
    }

    public function get_upazila_list(Request $request){
        // echo "hoitasa $request->district_id";
        $string_to_send = "";
        $upazilas = Upazila::where('district_id', $request->district_id)->get();
        foreach($upazilas as $upazila){
            $string_to_send .= "<option value='$upazila->id'>$upazila->upazila_name</option>";
        }
        echo $string_to_send;
    }

}
