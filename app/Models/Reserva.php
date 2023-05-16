<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mesa;

class Reserva extends Model
{
    use HasFactory;

    // Relação com a tabela "mesa"
    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'res_mesa');
    }
}
