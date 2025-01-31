<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    use HasFactory;

    public function arqueo()
    {
        // RELACION DE MUCHOS A UNO (DE MUCHOS MOVIMIENTOS A UN ARQUEO DE CAJA)
        return $this->belongsTo(ArqueoCaja::class);
    }
}
