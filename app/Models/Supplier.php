<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['name', 'contact_info'];

    // Define any relationships
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
