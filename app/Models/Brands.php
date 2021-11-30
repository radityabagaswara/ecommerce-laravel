<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    public function products()
    {
        return $this->hasMany('App\Models\Products', 'brands_id', "id");
    }
}
