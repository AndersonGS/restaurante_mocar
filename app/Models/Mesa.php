<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Mesa extends Model
{
    use HasFactory;

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'res_mesa');
    }
}
