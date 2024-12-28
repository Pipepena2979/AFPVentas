<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public function users() {
        //** RELACION DE UNO A MUCHOS (DE UNA EMPRESA A MUCHOS USUARIOS) */
        return $this->hasMany(User::class);
    }
}
