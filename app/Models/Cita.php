<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'descripcion','fecha_ini','fecha_fin','paciente_id','medico_id',
        'receta','user_id','tratamiento_id','precio_tratamiento','total','saldo_cita','estado_id'
    ];

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

     // TIENE UN PACIENTE

     public function paciente()
     {
         return $this->belongsTo(Paciente::class);
     }

      // TIENE UN USUARIO

      public function user()
      {
          return $this->belongsTo(User::class);
      }

       // TIENE UN medico

       public function medico()
       {
           return $this->belongsTo(Medico::class);
       }

    public function liquidaciones(){
        return $this->hasMany(Liquidacion::class);
    }
}
