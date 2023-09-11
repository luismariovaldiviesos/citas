<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','precio','procedimiento_id'];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function procedimiento(){

        return $this->belongsTo(Procedimiento::class);

    }
}
