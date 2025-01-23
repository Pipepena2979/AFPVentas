<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public function detallesVenta() {
        //** RELACION DE UNO A MUCHOS (DE UNA VENTA A MUCHOS DETALLES) */
        return $this->hasMany(DetalleVenta::class);
    }

    public function cliente() {
        //** RELACION DE MUCHOS A UNO (DE MUCHAS VENTAS A UN CLIENTE) */
        return $this->belongsTo(Cliente::class);
    }
}
