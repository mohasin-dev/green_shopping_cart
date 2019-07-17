<?php
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Setting;

function price_format($value) {
    return '৳' . number_format($value, 2, '.', '');
  }

//  function price_format($price) {
//     return money_format('৳%i', $price / 100);
//   }

// function price_format($price) {
//     return '৳' . number_format($price, 2, '.', '');
//   }

function setting(){
   return Setting::findOrFail(1)->first();
}


function items(){
    return Cart::count();
}
function contents(){
    return Cart::content();
}
