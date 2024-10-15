<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'sku', 'weight', 'category', 'status'
    ];

    public $timestamps = true; 
}
