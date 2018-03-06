<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=['buyer_id','product_id','quantity'];


    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
