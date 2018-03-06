<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';
    const  AVILABLE = 'available';
    const  UNAVILABLE = 'unavailable';
    protected $fillable = ['name', 'image', 'description', 'seler_id', 'status', 'quantity'];

    public function isAvilable()
    {
        return $this->status == Product::AVILABLE;

    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function seler(){

    return $this->belongsTo(Seler::class);

    }
    public function categories(){

        return $this->belongsToMany(Category::class);

    }

}
