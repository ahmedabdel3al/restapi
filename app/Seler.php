<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;

class Seler extends User
{
    use softDeletes;
    protected $dates=['delete_at'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
