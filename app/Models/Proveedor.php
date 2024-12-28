<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    public function compras() {
        //** RELACION DE UNO A MUCHOS (DE UN PROVEEDOR A MUCHAS COMPRAS) */
        return $this->hasMany(Compra::class);
    }
}
