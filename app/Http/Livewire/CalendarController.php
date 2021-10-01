<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;

class CalendarController extends Component
{
    public $events ;
    public function render()
    {
        //$events = Cita::select('id','descripcion AS title','fecha_ini AS start','fecha_fin AS end')->get();
        //dd($events);

        $events = Cita::join('pacientes as p', 'p.id','citas.paciente_id')
        ->join('tratamientos as t', 't.id','citas.tratamiento_id')
        ->join('pagos as pa', 'pa.id','citas.pago_id')
        ->join('estados as e', 'e.id','citas.estado_id')
        ->select('p.nombre as title','citas.id','fecha_ini AS start','fecha_fin AS end',
                't.nombre as tratamiento','pa.nombre as pago', 'e.nombre as estado')->get();
        //dd($events);

        $this->events = json_encode($events);
        return view('livewire.calendario.component')->extends('layouts.theme.app')
        ->section('content');
    }
}
