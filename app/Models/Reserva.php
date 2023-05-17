<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mesa;
use App\Models\User;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'res_mesa', 'user_id', 'mesa_id',
    ];

    // Relação user com a tabela reserva
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação mesa com a tabela reserva
    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }
}
