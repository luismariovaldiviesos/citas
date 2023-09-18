<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    use HasFactory;
    protected $fillable = ['observaciones','monto_liquidado','cita_id'];


    function cita() {
        return $this->belongsTo(Cita::class);
    }

}
