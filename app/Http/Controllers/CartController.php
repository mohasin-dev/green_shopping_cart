<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Coupon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();

        if(!$coupon){
            Toastr::error('Invalid Coupon code. Please try again :(', 'Error', ["positionClass" => "toast-bottom-right",]);
            return back();
        }

        session()->put('coupon', [
            'name' => $coupon->coupon_code,
            //'discount' => (Cart::subtotal()),
            'discount' => round($coupon->percentage/100*Cart::subtotal()),
        ]);
        Toastr::success('Coupon has beeb applied :)', 'Success', ["positionClass" => "toast-bottom-right",]);
        return back();
    }

    public function couponDestroy(){
        //return $request;
        session()->forget('coupon');
        Toastr::success('Coupon has beeb removed :)', 'Success', ["positionClass" => "toast-bottom-right",]);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_details = Product::find($request->product_id);

        // $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
        //     return $cartItem->id === $request->product_id;
        // });
        // if ($duplicates->isNotEmpty()) {
        //     echo "Item already added";
        // }
        Cart::add($product_details->id, $product_details->product_title, 1, $product_details->regular_price, 1)
        ->associate('App\Product');
        echo "Item has been added";

    }
    public function store2(Request $request)
    {
        // echo $request->product_id;
        // echo "<br>";
        // echo $request->color;
        if($request->color){
            $product_details = Product::find($request->product_id);
            Cart::add($product_details->id, $product_details->product_title, 1, $product_details->regular_price, $request->color)
            ->associate('App\Product');
            echo "Item has been added";
        }else{
            $product_details = Product::find($request->product_id);
            Cart::add($product_details->id, $product_details->product_title, 1, $product_details->regular_price, 1)
            ->associate('App\Product');
            echo "Item has been added";
        }


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
    public function update(Request $request)
    {
        $this->validate($request,[
            'product_qty' => 'required|numeric|between:1,5',
        ]);

        Cart::update($request->rowId, $request->product_qty);
        echo "Product Quantity Updated!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Cart::remove($request->product_id);
        echo "Item has been removed";
    }
}
