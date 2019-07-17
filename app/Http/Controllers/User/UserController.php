<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Product;
use App\Order;
use App\OrderDetail;
use App\District;
use App\Upazila;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
use File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_order = Order::where('user_id', Auth::id())->count();
        $total_amount = Order::where('complete', 1)->where('user_id', Auth::id())->sum('total');
        $total_product = Product::count();
        $products = Product::all();
        return view('user.userdashboard', compact('products', 'total_order', 'total_amount'));
    }

    public function profile()
    {
        return view('user.profile');
    }


    public function change_password()
    {
        return view('user.changepassword');
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
                return redirect()->route('user.dashboard');
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }
    }


    public function order()
    {
        $user_id = Auth::User()->id;
        $orders = Order::where('user_id', $user_id)->get();
        return view('user.order', compact('orders'));
    }

    // public function order_details($order_id)
    // {
    //     $order_details = OrderDetail::where('order_id', $order_id)->get();
    //     $total_products = OrderDetail::where('order_id', $order_id)->sum('quantity');
    //     return view('user.orderDetails', compact('order_details', 'total_products'));
    // }
        public function order_details($order_id)
        {
            $userId = Order::findOrFail($order_id)->first()->user_id;
            $userDetails = User::findOrFail($userId)->first();
            $shippingDetails = Order::where('id', $order_id)->first();
            $orderDetails = OrderDetail::where('order_id', $order_id)->get();
            return view('user.orderDetails', compact('order_id', 'userDetails', 'shippingDetails', 'orderDetails'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $districts = District::all();
        $upazilas = Upazila::all();
         return view('user.edit', compact('districts', 'upazilas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $currentDate = Carbon::now()->toDateString();

        if ($request->hasFile('image')) {
            if(File::exists('images/user'.$id->image)){
                File::delete('images/user'.$id->image);
               }
            $image = $request->file('image');
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/user/'.$filename);
            Image::make($image)->resize(200, 200)->save($location);
        }else{
            $filename = 'user.png';
        }

        $user = User::findOrFail($id);
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
        return redirect()->route('user.profile');
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



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
