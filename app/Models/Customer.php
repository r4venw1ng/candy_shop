<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'customer_id';
    protected $fillable = ['name', 'phone', 'email', 'address', 'status'];

    // Método para obtener solo los clientes activos
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Método para obtener solo los clientes inactivos
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
