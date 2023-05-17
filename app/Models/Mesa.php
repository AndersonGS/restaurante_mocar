<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'lugares', 'foto',
    ];

    // Relação com a tabela "reserva"
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
