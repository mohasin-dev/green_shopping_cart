<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    // protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }



    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function size()
    {
        return $this->belongsTo('App\Size');
    }
    public function colors()
    {
        return $this->belongsToMany('App\Color')->withTimestamps();
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function images()
    {
      return $this->hasMany('App\ProductImage');
    }

    // public function category_product($category_name)
    // {
    //     $products = Product::where('subcategory_id', $category_name)->all();
    // }
}
