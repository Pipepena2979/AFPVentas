<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function detalles() {
        //** RELACION DE UNO A MUCHOS (DE UNA COMPRA A MUCHOS DETALLES) */
        return $this->hasMany(DetalleCompra::class);
    }

    public function proveedor() {
        //** RELACION DE MUCHOS A UNO (DE MUCHAS COMPRAS A UN PROVEEDOR) */
        return $this->belongsTo(Proveedor::class);
    }
}
