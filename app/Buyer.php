<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends User
{
    use softDeletes;
    protected $dates=['delete_at'];

    public function transactions(){
      return $this->hasMany(Transaction::class);
    }
}
