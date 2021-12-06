<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionsProducts extends Model
{
    public function Products()
    {
        return $this->belongsTo('App\Models\Products', 'products_id');
    }

    public function Transactions()
    {
        return $this->belongsTo('App\Models\Transactions', 'transactions_id');
    }
}
