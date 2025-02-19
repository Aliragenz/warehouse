<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockTransactions extends Model
{
    /** @use HasFactory<\Database\Factories\StockTransactionsFactory> */
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['transCode', 'product_id', 'quantity', 'type', 'customer_id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function purchase()
    {
        return $this->hasOne(purchases::class, 'stock_transaction_id');
    }

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }
}
