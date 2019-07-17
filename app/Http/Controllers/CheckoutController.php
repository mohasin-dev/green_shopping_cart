<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\District;
use App\Upazila;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\OrderDetail;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        $upazilas = Upazila::all();
        return view('frontend.checkout', compact('districts', 'upazilas'));
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
        //return $request->all();
        // return $contents = Cart::content()->map(function ($item) {
        //     return $item->model->slug.', '.$item->qty;
        // })->values()->toJson();
    //    $contents = Cart::content();
    //     //echo "oh";
    //      dd($request->all());
    //      foreach($contents as $item){
    //         echo $item->id . "<br>";
    //     }
        $shipping_cost = 100;

        $order = new Order();
        $order->user_id = Auth::user() ? Auth::user()->id : null;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->district_id = $request->district_id;
        $order->upazila_id = $request->upazila_id;
        $order->phone = $request->phone;
        $order->payment_method = $request->payment_method;
        if($request->transaction_number){
            $order->transaction_number = $request->transaction_number;
        }
        if(session()->has('coupon')){
        $order->discount = session()->get('coupon')['discount'];
        $order->discount_code = session()->get('coupon')['name'];
        $subtotal = Cart::subtotal() - session()->get('coupon')['discount'];
        $order->subtotal = $subtotal;
        $order->shipping_cost = $shipping_cost;
        $order->total = $subtotal + $shipping_cost;
        }else{
            $subtotal = Cart::subtotal();
            $order->subtotal = $subtotal;
            $order->shipping_cost = $shipping_cost;
            $order->total = $subtotal + $shipping_cost;
        }
        $order->save();

        foreach (Cart::content() as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'color' => $item->weight,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        Cart::destroy();
        session()->forget('coupon');
        // Toastr::success('Order completed :)', 'Success', ["positionClass" => "toast-bottom-right",]);
        return redirect()->route('checkout.order.confirmation');
    }


    public function orderConfirmation(){
        return view('frontend.orderConfirmation');
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
    public function edit($id)
    {
        //
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
        //
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
