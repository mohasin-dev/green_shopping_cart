<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Order;
use App\Product;
use App\OrderDetail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Order::whereDate('created_at', Carbon::today())->get();
        return view('backend.order.index', compact('sales'));
    }

    public function allSale()
    {
        $sales = Order::all();
        return view('backend.order.index2', compact('sales'));
    }

    public function customeDiscount(Request $request)
    {
        //return $request->order_id .'--'. $request->discount;
         $order_info = Order::where('id', $request->order_id)->first();
         $total = $order_info->total;
         $discount = $request->discount;
         $after_discount_total = $total - $discount;

         Order::find($request->order_id)->update([
            'custom_discount' => $discount,
        ]);
         echo "Discount Applied";
    }


    public function order_details($sale_id)
    {
        Order::find($sale_id)->update([
            'seen' => true
        ]);
        $userId = Order::where('id', $sale_id)->first()->user_id;
        $userDetails = User::where('id', $userId)->first();
        $shippingDetails = Order::where('id', $sale_id)->first();
        $orderDetails = OrderDetail::where('order_id', $sale_id)->get();
        return view('backend.order.orderDetails', compact('sale_id', 'userDetails', 'shippingDetails', 'orderDetails'));
    }

    public function order_confirm($sale_id)
    {
        Order::find($sale_id)->update([
            'complete' => true
        ]);
         Mail::send(new OrderConfirm($sale_id));
        Toastr::success('Order Confirm Email Sent to Customer :)' ,'Success');
        return back();
    }

    public function order_paid($sale_id)
    {
        Order::find($sale_id)->update([
            'paid' => true
        ]);
        Toastr::success('This order is paid :)' ,'Success');
        return back();
    }
}
