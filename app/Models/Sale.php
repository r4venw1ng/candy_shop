<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'customer_id',
        'total',
    ];

    // Relación con Customer (una venta pertenece a un cliente)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relación con SaleDetail (una venta tiene muchos detalles)
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }
}
