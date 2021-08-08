<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;


    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }
}
