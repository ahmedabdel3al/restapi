<?php

namespace App;


class Seler extends User
{

    public function products(){
        return $this->hasMany(Product::class);
    }
}
