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

}
