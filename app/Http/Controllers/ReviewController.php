<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $price = $request->price;
        $quality = $request->quality;
        $sum = $price + $quality;
        $star = $sum/2;

        $this->validate($request,[
            'name' => 'required'
        ]);
        $review = new Review();
        $review->price = $request->price;
        $review->quality = $request->quality;
        $review->name = $request->name;
        $review->summery = $request->summery;
        $review->review = $request->review;
        $review->star = $star;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::id();
        $review->save();
        Toastr::success('Thanks For Your Review :)', 'Success', ["positionClass" => "toast-bottom-right",]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(review $review)
    {
        //
    }
}
