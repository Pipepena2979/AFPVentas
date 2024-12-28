<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos() {
        //** RELACION DE UNO A MUCHOS (DE UN CATEGORIA A MUCHOS PRODUCTOS) */
        return $this->hasMany(Producto::class);
    }
}
