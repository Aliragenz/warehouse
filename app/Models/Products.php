<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['name', 'description', 'productCode', 'price', 'supplier_id'];

    // Define the relationship with Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(stockTransactions::class, 'product_id');
    }

    public function getStockAttribute()
    {
        return $this->stockTransactions()
            ->selectRaw("
                SUM(CASE WHEN type = 'in' THEN quantity ELSE 0 END) -
                SUM(CASE WHEN type = 'out' THEN quantity ELSE 0 END) AS stock_balance
            ")
            ->first()
            ->stock_balance ?? 0;
    }
}
