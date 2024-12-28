<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function categoria() {
        //** RELACION DE MUCHOS A UNO (DE MUCHOS PRODUCTOS A UNA CATEGORIA) */
        return $this->belongsTo(Categoria::class);
    }

    public function compras() {
        //** RELACION DE UNO A MUCHOS (DE UN PRODUCTO A MUCHAS COMPRAS) */
        return $this->hasMany(Compra::class);
    }

}
