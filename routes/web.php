<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('test', function () {
    return view('mail.orderConfirm');
});

Route::get('empty', function () {
    Cart::destroy();
});
Route::get('ki-asa', function () {
    return $contents =  Cart::content();
});


// Route::get('/', function () {
//     return view('frontend.app')->name('home');
// });

Route::get('/', 'HomeController@index')->name('home');
Route::get('/{slug}/details', 'HomeController@product_details')->name('product.details');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/store', 'CartController@store')->name('cart.store');
Route::post('/cart/store2', 'CartController@store2')->name('cart.store2');
Route::post('/cart/update', 'CartController@update')->name('cart.update');
Route::post('/cart/destroy', 'CartController@destroy')->name('cart.destroy');
Route::post('cart/coupon', 'CartController@coupon')->name('cart.coupon');
Route::post('cart/coupon/destroy', 'CartController@couponDestroy')->name('cart.coupon.destroy');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/order-confirmation', 'CheckoutController@orderConfirmation')->name('checkout.order.confirmation');
Route::get('/new-products', 'HomeController@newProducts')->name('new.product');
Route::get('/featured-products', 'HomeController@featuredProducts')->name('featured.product');
Route::get('/new-arrival-products', 'HomeController@newArrivalProducts')->name('new.arrival.product');
Route::get('/best-saller-products', 'HomeController@bestSallerProducts')->name('best.saller.product');
Route::get('/upsale-products', 'HomeController@upsaleProducts')->name('upsale.product');
Route::get('category/{category_id}/products', 'HomeController@categoryProducts')->name('category.product');
Route::get('subcategory/{subCategory_id}/products', 'HomeController@subCategoryProducts')->name('subCategory.product');
Route::post('review', 'ReviewController@store')->name('review');
Route::get('checkout-login', 'HomeController@checkoutLogin')->name('checkout.login');
Route::post('checkout-login-confirm', 'HomeController@checkoutLoginConfirm')->name('checkout.login.confirm');
Route::get('review-login', 'HomeController@reviewLogin')->name('review.login');
Route::post('review-login-confirm', 'HomeController@reviewLoginConfirm')->name('review.login.confirm');
Route::post('/search', 'HomeController@search')->name('search');
Route::post('/get-upazila', 'CheckoutController@get_upazila_list')->name('upazila');

// Route::get('/autocomplete-search', 'HomeController@autocomplete_search')->name('autocomplete.search');
// Route::post('/coupon', 'CartController@coupon')->name('coupon');
// Route::post('/billing-address', 'CartController@billing_address')->name('billing_address');

// Route::get('/tag/{slug}', 'HomeController@tag')->name('tag');
// Route::get('/privacy', 'HomeController@privacy')->name('privacy');
// Route::get('/terms', 'HomeController@terms')->name('terms');
// Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['auth', 'user']], function (){
    Route::get('dashboard','UserController@index')->name('dashboard');
    Route::get('profile','UserController@profile')->name('profile');
    Route::get('order','UserController@order')->name('order');
    Route::get('order/details/{id}','UserController@order_details')->name('order.details');
    Route::get('change-password','UserController@change_password')->name('change_password');
    Route::post('change-password/update','UserController@change_password_update')->name('change_password.update');
    Route::get('profile-edit/{id}','UserController@edit')->name('edit');
    Route::post('user-update/{id}','UserController@update')->name('profile.update');
    Route::post('get-upazila', 'UserController@get_upazila_list')->name('upazila');
});

//Backend Route
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth', 'admin']], function (){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('profile','DashboardController@profile')->name('profile');
    Route::get('change-password','DashboardController@change_password')->name('change_password');
    Route::post('change-password/update','DashboardController@change_password_update')->name('change_password.update');
    Route::get('profile-edit/{id}','DashboardController@edit')->name('edit');
    Route::post('user-update/{id}','DashboardController@update')->name('profile.update');
    Route::post('get-upazila', 'DashboardController@get_upazila_list')->name('upazila');
    Route::get('setting','SettingController@edit')->name('setting.edit');
    Route::post('setting-update/{id}','SettingController@update')->name('setting.update');

    Route::resource('category','CategoryController');
    Route::resource('subcategory','SubcategoryController');
    Route::resource('brand','BrandController');
    Route::resource('tag','TagController');
    Route::resource('unit','UnitController');
    Route::resource('size','SizeController');
    Route::resource('color','ColorController');
    Route::resource('product','ProductController');
    Route::post('get-subcategory', 'ProductController@get_subcategory_list')->name('subcategory');
    Route::post('get-tag', 'ProductController@get_tag_list')->name('tag');
    Route::get('product/restore/{id}','ProductController@product_restore')->name('product.restore');
    Route::post('product/permanent-delete/{id}','ProductController@product_permanent_delete')->name('product.permanent.delete');
    Route::resource('fontAwesome','FontAwesomeController');
    Route::resource('service','ServiceController');
    Route::resource('about','AboutController');
    Route::resource('testimonial','TestimonialController');
    Route::resource('client','ClientController');
    Route::resource('whychooseus','WhyChooseUsController');
    Route::resource('slider','SliderController');
    Route::resource('coupon', 'CouponController');
    Route::get('sale-all', 'SaleController@allSale')->name('allSale');
    Route::resource('sale', 'SaleController');
    Route::get('sale/details/{id}','SaleController@order_details')->name('sale.details');
    Route::post('/custome-discount', 'SaleController@customeDiscount')->name('custome.discount');
    Route::post('/order-confirm/{id}', 'SaleController@order_confirm')->name('order_confirm');
    Route::post('/order-paid/{id}', 'SaleController@order_paid')->name('order_paid');
    Route::get('/subscriber','SubscriberController@index')->name('subscriber');
    Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');
});

// Auth::routes(['verify' => true]);

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
