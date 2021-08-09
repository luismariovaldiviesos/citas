<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    //tien ujn tratamiento
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }

    //tien un pago
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

     //tien un estado
     public function estado()
     {
         return $this->belongsTo(Estado::class);
     }
}
