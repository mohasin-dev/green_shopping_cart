<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'seen', 'complete', 'paid', 'custom_discount', 'total',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
