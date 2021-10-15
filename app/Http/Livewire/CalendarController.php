<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Estado;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Pago;
use App\Models\Tratamiento;
use Livewire\Component;

class CalendarController extends Component
{
    public $events ;
    public $title, $start, $end, $tratamiento, $pago, $estado;


    // para agendar
    public $fecha_ini, $fecha_fin, $descripcion, $medico_id, $receta, $tratamiento_id, $pago_id, $estado_id, $paciente_id;

    // datos para cita
    public $medicos, $tratamientos, $pagos, $estados, $pacientes, $buscar_paciente;

    public $editar ="no";


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
        $this->medicos = Medico::all();
        $this->tratamientos = Tratamiento::all();
        $this->pagos = Pago::all();
        $this->estados =Estado::all();
        $this->pacientes = Paciente::all();
        //dd($this->pacientes);
        $this->events = json_encode($events);
        return view('livewire.calendario.component')->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        dd(  $this->descripcion,$this->fecha_ini, $this->fecha_fin, $this->paciente_id, $this->medico_id, $this->receta,
                $this->tratamiento_id, $this->pago_id,$this->estado
            );
    }

    public function resetUI(){

    }

    public function cargarPaciente($paciente)
    {
        $pacienteJson =json_decode($paciente);
        $this->buscar_paciente = $pacienteJson->nombre;
        $this->paciente_id = $pacienteJson->id;


        //dd($paciente);


    }
}
