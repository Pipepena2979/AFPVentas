<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    public function venta() {
        //** RELACION DE MUCHOS A UNO (DE MUCHOS DETALLES A UNA VENTA) */
        return $this->belongsTo(Venta::class);
    }

    public function producto() {
        //** RELACION DE MUCHOS A UNO (DE MUCHOS DETALLES A UN PRODUCTO) */
        return $this->belongsTo(Producto::class);
    }
}
