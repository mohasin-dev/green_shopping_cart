<?php

namespace App\Http\Controllers\Admin;

use App\Sale_details;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleDetailsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale_details  $sale_details
     * @return \Illuminate\Http\Response
     */
    public function show(Sale_details $sale_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale_details  $sale_details
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale_details $sale_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale_details  $sale_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale_details $sale_details)
    {
        // $product_size = $request->product_size ;
        // if($product_size < 2){

        // }else{
        //     echo "2 er base";
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale_details  $sale_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale_details $sale_details)
    {
        //
    }


}
