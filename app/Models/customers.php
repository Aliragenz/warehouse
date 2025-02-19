<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    /** @use HasFactory<\Database\Factories\CustomersFactory> */
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['name', 'phone'];

    public function transactions()
    {
        return $this->hasMany(stockTransactions::class, 'customer_id');
    }
}
