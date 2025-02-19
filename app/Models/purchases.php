<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchases extends Model
{
    /** @use HasFactory<\Database\Factories\PurchasesFactory> */
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['purchase_date', 'stock_transaction_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockTransaction()
    {
        return $this->belongsTo(stockTransactions::class, 'stock_transaction_id');
    }
}
