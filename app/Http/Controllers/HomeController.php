<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Slider;
use App\Setting;
use App\Testimonial;
use Carbon\Carbon;
use App\Client;
use App\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->take(5)->get();
        $clients = Client::orderBy('id', 'desc')->take(40)->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->take(5)->get();
        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $categories = Category::orderBy('id', 'desc')->take(12)->get();
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();
        $specialOffers = Product::where('special_offer', 1)->where('discount', 1)->orderBy('id', 'desc')->get()->chunk(3);
        $specialDeals = Product::where('special_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get()->chunk(3);
        $newProductss = Product::orderBy('id', 'desc')->get();
        $newProductsss = Product::orderBy('id', 'desc')->get()->chunk(3);
        $newProducts = Product::orderBy('id', 'desc')->get()->chunk(2);
        $featuredProducts = Product::where('featured', 1)->get();
        $newArrivalProducts = Product::latest()->inRandomOrder();
        return view('frontend.home', compact('clients', 'specialDeals', 'specialOffers', 'hotDeals','testimonials', 'sliders', 'navCategories', 'categories', 'newProductsss', 'newProducts', 'newProductss', 'featuredProducts', 'newArrivalProducts'));
    }

    public function product_details($slug){
        $product = Product::where('product_slug', $slug)->first();
        $count = $product->reviews->count();
        if($product->reviews->count() > 0){
            $total = 0;
            foreach($product->reviews as $review){
               $total += $review->star;
            }
            $result = $total/$count;
        }else{
            $result = 0;
        }
        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();
        $newProductss = Product::orderBy('id', 'desc')->take(40)->get();
        $product = Product::where('product_slug', $slug)->first();
        return view('frontend.details', compact('navCategories', 'result', 'product', 'newProductss', 'hotDeals'));
    }

    public function newProducts(){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();
        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $newProducts = Product::orderBy('id', 'desc')->paginate(16);
        return view('frontend.newProduct', compact('hotDeals', 'newProducts', 'navCategories'));
    }
    public function featuredProducts(){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $featuredProducts = Product::orderBy('id', 'desc')->paginate(16);
        return view('frontend.featuredProduct', compact('hotDeals', 'featuredProducts', 'navCategories'));
    }
    public function newArrivalProducts(){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $newArrivalProducts = Product::orderBy('id', 'desc')->paginate(16);
        return view('frontend.newArrivalProduct', compact('hotDeals', 'newArrivalProducts', 'navCategories'));
    }
    public function bestSallerProducts(){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $bestSallerProducts = Product::orderBy('id', 'desc')->paginate(16);
        return view('frontend.bestSallerProduct', compact('hotDeals', 'bestSallerProducts', 'navCategories'));
    }
    public function upsaleProducts(){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $upsaleProducts = Product::orderBy('id', 'desc')->paginate(16);
        return view('frontend.upsaleProduct', compact('hotDeals', 'upsaleProducts', 'navCategories'));
    }

    public function categoryProducts($category_id){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $categoryName = Category::findOrFail($category_id)->first()->category_name;
        $categoryProducts = Product::where('category_id', $category_id)->paginate(16);
        return view('frontend.categoryProduct', compact('hotDeals', 'categoryName', 'categoryProducts', 'navCategories'));
    }

    public function subcategoryProducts($subCategory_id){
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

        $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
        $subCategoryName = Subcategory::findOrFail($subCategory_id)->first()->subcategory_name;
        $subcategoryProducts = Product::where('subcategory_id', $subCategory_id)->paginate(16);
        return view('frontend.subCategoryProduct', compact('hotDeals', 'subCategoryName', 'subcategoryProducts', 'navCategories'));
    }

    public function checkoutLogin()
    {
        return view('frontend.checkoutLogin');
    }
    public function checkoutLoginConfirm(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //dd('test');
        //print_r($request->all());
        //Find user by this email
        $user = User::where('email', $request->email)->first();
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
        //Log Him Now
        return redirect()->intended(route('checkout'));
        //return back();
        }else{
        // session()->flash('sticky_error', 'Sorry!! Invalid email or password !!');
        Toastr::error('Sorry!! Invalid email or password :(' ,'Error');
        return back();
        }
    }
    public function reviewLogin()
    {
        return view('frontend.reviewLogin');
    }
    public function reviewLoginConfirm(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //dd('test');
        //print_r($request->all());
        //Find user by this email
        $user = User::where('email', $request->email)->first();
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
        //Log Him Now
        return redirect()->intended(route('home'));
        //return back();
        }else{
        // session()->flash('sticky_error', 'Sorry!! Invalid email or password !!');
        Toastr::error('Sorry!! Invalid email or password :(' ,'Error');
        return back();
        }
    }

    public function search(Request $request)
    {
        $hotDeals = Product::where('hot_deal', 1)->where('discount', 1)->orderBy('id', 'desc')->get();

         $navCategories = Category::orderBy('id', 'desc')->take(6)->get();
         $term = $request->search;
         $search_products = Product::join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
             ->join('categories', 'categories.id', '=', 'subcategories.category_id')
             ->orWhere('product_title', 'like', '%'.$term.'%')
             ->orWhere('product_subtitle', 'like', '%'.$term.'%')
             ->orWhere('regular_price', 'like', '%'.$term.'%')
             ->orWhere('product_image', 'like', '%'.$term.'%')
             ->orWhere('subcategory_name', 'like', '%'.$term.'%')
             ->orWhere('category_name', 'like', '%'.$term.'%')
             ->paginate(16);
             return view('frontend.search', compact('hotDeals', 'navCategories', 'search_products', 'term'));
    }



}
