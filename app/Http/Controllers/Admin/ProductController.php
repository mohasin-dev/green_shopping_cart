<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Product;
use App\Subcategory;
use App\Unit;
use App\Size;
use App\Tag;
use App\Color;
use File;
use Image;
use Auth;
use App\Category;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $deleted_products = Product::onlyTrashed()->get();
        return view('backend.product.index', compact('products', 'deleted_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $units = Unit::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $colors = Color::all();

        return view('backend.product.create', compact('colors', 'categories', 'subcategories', 'sizes', 'tags', 'units'));
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
            'product_title' => 'required',
            'product_description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_image' => 'required|image',
            'image' => 'required'
        ]);

        //$image = $request->file('image');
        $product_check = $request->product_title;
        if(Product::where('product_title', $product_check)->exists()){
           $slug = str_slug($request->product_title.'-'.str_random(5));
        }else{
            $slug = str_slug($request->product_title);

        }
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product/'.$filename);
            Image::make($image)->resize(700, 700)->save($location);
        }else{
            $filename = 'default.png';
        }

        $product = new product();
        $product->added_by = Auth::id();
        $product->product_title = $request->product_title;
        $product->product_subtitle = $request->product_subtitle;
        $product->product_slug = $slug;
        $product->product_short_description = $request->product_short_description;
        $product->product_description = $request->product_description;
        $product->stock = $request->stock;
        $product->stock_alert = $request->stock_alert;
        $product->purchase_price = $request->purchase_price;
        $product->size_id = $request->size_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->product_image = $filename;
        $product->discount_type = $request->discount_type;
        $product->discount_amount = $request->discount_amount;
        if(isset($request->featured))
        {
            $product->featured = true;
        }else {
            $product->featured = false;
        }
        if(isset($request->discount))
        {
            $product->discount = true;
            $discount_type = $request->discount_type;
            $discount_amount = $request->discount_amount;
            if($discount_type == 1){
                $product->regular_price = $request->regular_price - $discount_amount;
                $product->sale_price = $request->regular_price;
            }else{
                $discount = $request->regular_price *  $discount_amount / 100;
                $product->regular_price = $request->regular_price - $discount;
                $product->sale_price = $request->regular_price;
            }
        }else {
            $product->discount = false;
            $product->regular_price = $request->regular_price;
        }
        if(isset($request->hot_product))
        {
            $product->hot_product = true;
        }else {
            $product->hot_product = false;
        }
        if(isset($request->hot_deal))
        {
            $product->hot_deal = true;
        }else {
            $product->hot_deal = false;
        }
        if(isset($request->special_offer))
        {
            $product->special_offer = true;
        }else {
            $product->special_offer = false;
        }
        if(isset($request->special_deal))
        {
            $product->special_deal = true;
        }else {
            $product->special_deal = false;
        }
        $product->save();

        $product_id = $product->id;
        if($product_id){
            if ($request->hasFile('image')){
                $image = $request->file('image');
                foreach ($request->image as $image) {
                    $img = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/gallery/thumb/'.$img);
                    Image::make($image)->resize(80, 80)->save($location);

                    $location2 = public_path('images/gallery/preview/'.$img);
                    Image::make($image)->resize(400, 400)->save($location2);

                    $location3 = public_path('images/gallery/original/'.$img);
                    Image::make($image)->resize(1024, 1024)->save($location3);

                    $giarr = array(
                        "product_id" => $product_id,
                        "image" => $img,
                    );
                DB::table('product_images')->insert($giarr);
                }
            }
        }else{
            Toastr::error('Something went wrong :)','Error');
            return redirect()->route('admin.product.index');
        }

        $product->colors()->attach($request->colors);
        $product->tags()->attach($request->tags);
        Toastr::success('Product Successfully Saved :)','Success');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $units = Unit::all();
        $sizes = Size::all();
        $tags = Tag::all();
        $colors = Color::all();

        return view('backend.product.edit', compact('colors', 'subcategories', 'sizes', 'tags', 'units', 'product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'product_title' => 'required',
            'product_description' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ]);

        $slug = str_slug($request->product_title);
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('product_image')) {
            if(File::exists('images/product/'.$product->product_image)){
             File::delete('images/product/'.$product->product_image);
            }
            $image = $request->file('product_image');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product/'.$filename);
            Image::make($image)->resize(700, 700)->save($location);
            $product->product_image = $filename;
        }

        $product->added_by = Auth::id();
        $product->product_title = $request->product_title;
        $product->product_subtitle = $request->product_subtitle;
        $product->product_slug = $slug;
        $product->product_short_description = $request->product_short_description;
        $product->product_description = $request->product_description;
        $product->stock = $request->stock;
        $product->stock_alert = $request->stock_alert;
        $product->purchase_price = $request->purchase_price;
        $product->size_id = $request->size_id;
        $product->unit_id = $request->unit_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->discount_type = $request->discount_type;
         if(isset($request->featured))
         {
             $product->featured = true;
         }else {
             $product->featured = false;
         }
         if(isset($request->discount))
         {
             //echo "asa";
             $product->discount = true;
             $discount_type = $request->discount_type;
             $discount_amount = $request->discount_amount;
             if($discount_type == 1){
                 $product->regular_price = $request->regular_price - $discount_amount;
                 $product->sale_price = $request->regular_price;
                 $product->discount_amount = $request->discount_amount;
             }else{
                 $discount = $request->regular_price *  $discount_amount / 100;
                 $product->regular_price = $request->regular_price - $discount;
                 $product->sale_price = $request->regular_price;
                 $product->discount_amount = $request->discount_amount;
             }
         }else {
            //echo "nai";
             $product->discount = false;
             $product->discount_amount = 0;
             $product->regular_price = $request->regular_price;
             $product->sale_price = 0;
         }
        //  dd();
         if(isset($request->hot_product))
         {
             $product->hot_product = true;
         }else {
             $product->hot_product = false;
         }
         if(isset($request->hot_deal))
         {
             $product->hot_deal = true;
         }else {
             $product->hot_deal = false;
         }
         if(isset($request->special_offer))
         {
             $product->special_offer = true;
         }else {
             $product->special_offer = false;
         }
         if(isset($request->special_deal))
         {
             $product->special_deal = true;
         }else {
             $product->special_deal = false;
         }
        $product->save();

        $product_id = $product->id;
        if($product_id){
            if ($request->hasFile('image')){
                $images = DB::table('product_images')
                ->where('product_id', $product_id)->get();
                foreach ($images as $imagee) {
                   if(File::exists('images/gallery/thumb/'.$imagee->image)){
                       File::delete('images/gallery/thumb/'.$imagee->image);
                      }
                   if(File::exists('images/gallery/preview/'.$imagee->image)){
                       File::delete('images/gallery/preview/'.$imagee->image);
                      }
                   if(File::exists('images/gallery/original/'.$imagee->image)){
                       File::delete('images/gallery/original/'.$imagee->image);
                      }
                      DB::table('product_images')
                      ->where('product_id', $product_id)
                      ->delete();
                }
                foreach ($request->image as $image) {
                    $img = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    $location = public_path('images/gallery/thumb/'.$img);
                    Image::make($image)->resize(80, 80)->save($location);

                    $location2 = public_path('images/gallery/preview/'.$img);
                    Image::make($image)->resize(400, 400)->save($location2);

                    $location3 = public_path('images/gallery/original/'.$img);
                    Image::make($image)->resize(1024, 1024)->save($location3);

                    $giarr = array(
                        "product_id" => $product_id,
                        "image" => $img,
                    );
                DB::table('product_images')->insert($giarr);
                }
            }
        }else{
            Toastr::error('Something went wrong :)','Error');
            return redirect()->route('admin.product.index');
        }
        $product->colors()->attach($request->colors);
        $product->tags()->sync($request->tags);
         Toastr::success('Product Successfully Updated :)','Success');
         return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(File::exists('images/product/' .$product->product_image)){
            File::delete('images/product/' .$product->product_image);
        }

        $images = DB::table('product_images')
        ->where('product_id', $product->id)->get();
        foreach ($images as $imagee) {
           if(File::exists('images/gallery/thumb/'.$imagee->image)){
               File::delete('images/gallery/thumb/'.$imagee->image);
              }
           if(File::exists('images/gallery/preview/'.$imagee->image)){
               File::delete('images/gallery/preview/'.$imagee->image);
              }
           if(File::exists('images/gallery/original/'.$imagee->image)){
               File::delete('images/gallery/original/'.$imagee->image);
              }

            DB::table('product_images')
                ->where('product_id', $product->id)
                ->delete();
        }

        $product->colors()->detach();
        $product->tags()->detach();
        $product->delete();
        Toastr::success('product Successfully Deleted :)','Success');
        return redirect()->back();
    }

    public function product_restore($product_id){
        Product::onlyTrashed()->findOrFail($product_id)->restore();
        Toastr::success('product Successfully Restored :)','Success');
        return redirect()->back();
    }

    public function product_permanent_delete($product_id){
        Product::onlyTrashed()->findOrFail($product_id)->forceDelete();
        Toastr::success('product Successfully Permanently Deleted :)','Success');
        return redirect()->back();
    }

    public function get_subcategory_list(Request $request){
        //echo "hoitasa $request->category_id";
        $string_to_send = "";
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach($subcategories as $subcategory){
            $string_to_send .= "<option value='$subcategory->id'>$subcategory->subcategory_name</option>";
        }
        echo $string_to_send;
    }

    public function get_tag_list(Request $request){
        //echo "hoitasa $request->category_id";
        $string_to_send = "";
        $tags = Tag::where('subcategory_id', $request->subcategory_id)->get();
        foreach($tags as $tag){
            $string_to_send .= "<option value='$tag->id'>$tag->tag_name</option>";
        }
        echo $string_to_send;
    }
}
