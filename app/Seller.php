<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{
    use softDeletes;
    protected $dates=['delete_at'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
