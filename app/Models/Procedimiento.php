<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','precio'];


    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }

    //un procedimiento tiene citas a traves de tratamientos;

    public function citas() {
        return $this->hasManyThrough(Cita::class, Tratamiento::class);
    }

    // total de citas y saldo restante para el procedimiento
    public function calculaCitasSaldo(){
        $totalCitas =  $this->citas->count();
        $costoProcedimiento =  $this->precio;
        $saldoProcedimiento =  $costoProcedimiento - ($totalCitas *  $this->tratamiento->precio);
        return[
            'totalCitas' => $totalCitas,
            'saldoProcedimiento' => $saldoProcedimiento
        ];
    }

}
