<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use softDeletes;
    protected $dates=['delete_at'];
    protected $table ='products';
    const  AVILABLE = 'available';
    const  UNAVILABLE = 'unavailable';
    protected $fillable = ['name', 'image', 'description', 'seller_id', 'status', 'quantity'];
    protected $hidden=['pivot'];

    public function isAvilable()
    {
        return $this->status == Product::AVILABLE;

    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function seller(){

    return $this->belongsTo(Seller::class);

    }
    public function categories(){

        return $this->belongsToMany(Category::class);

    }

}
