<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalendarioController extends Component
{
    public $buscar_paciente, $fecha_ini, $fecha_fin;

    public function render()
    {
        return view('livewire.calendario.component')
        ->extends('layouts.theme.app')
        ->section('content');
    }

}
