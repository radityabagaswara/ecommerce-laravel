<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function Brands()
    {
        return $this->belongsTo('App\Models\Brands', 'brands_id');
    }

    public function Categories()
    {
        return $this->belongsTo('App\Models\Categories', 'categories_id');
    }
}
