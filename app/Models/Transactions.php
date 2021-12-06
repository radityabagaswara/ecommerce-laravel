<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public function Users()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    public function Products()
    {
        return $this->belongsToMany('App\Models\Products', 'transactions_products', 'transactions_id', 'products_id')->withPivot('qty', 'total', 'discount', 'price');
    }
}
