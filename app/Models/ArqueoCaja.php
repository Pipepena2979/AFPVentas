<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArqueoCaja extends Model
{
    use HasFactory;

    public function movimientos()
    {
        // RELACION DE UNO A MUCHOS (DE UN ARQUEO DE CAJA A MUCHOS MOVIMIENTOS)
        return $this->hasMany(MovimientoCaja::class);
    }
}
