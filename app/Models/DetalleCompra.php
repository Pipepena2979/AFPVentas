<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    public function compra() {
        //** RELACION DE MUCHOS A UNO (DE MUCHOS DETALLES A UNA COMPRA) */
        return $this->belongsTo(Compra::class);
    }

    public function producto() {
        //** RELACION DE MUCHOS A UNO (DE MUCHOS DETALLES A UN PRODUCTO) */
        return $this->belongsTo(Producto::class);
    }
}
