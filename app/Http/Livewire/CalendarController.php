<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Estado;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Pago;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CalendarController extends Component
{
    use WithPagination, WithFileUploads;
    public $events ;
    public $title, $start, $end, $tratamiento, $pago, $estado;


    // para agendar
    public $fecha_ini, $fecha_fin, $descripcion, $medico_id, $receta, $tratamiento_id, $pago_id, $estado_id, $paciente_id;

    // datos para cita
    public $medicos, $tratamientos, $pagos, $estados, $pacientes, $buscar_paciente;

    public $editar ="no";

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {
        //$events = Cita::select('id','descripcion AS title','fecha_ini AS start','fecha_fin AS end')->get();
        //dd($events);

        // $events = Cita::join('pacientes as p', 'p.id','citas.paciente_id')
        // ->join('tratamientos as t', 't.id','citas.tratamiento_id')
        // ->join('pagos as pa', 'pa.id','citas.pago_id')
        // ->join('estados as e', 'e.id','citas.estado_id')
        // ->select('p.nombre as title','citas.id','fecha_ini AS start','fecha_fin AS end',
        //         't.nombre as tratamiento','pa.nombre as pago', 'e.nombre as estado')->get();
        //dd($events);
        $this->medicos = Medico::all();
        $this->tratamientos = Tratamiento::all();
        $this->pagos = Pago::all();
        $this->estados =Estado::all();
        $this->pacientes = Paciente::all();
        //dd($this->pacientes);
        //$this->events = json_encode($events);
        return view('livewire.calendario.component')->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        // dd(  $this->descripcion,$this->fecha_ini, $this->fecha_fin, $this->paciente_id, $this->medico_id, $this->receta,
        //         $this->tratamiento_id, $this->pago_id,$this->estado
        //     );


        $this->validaFechas();

        $rules = [
            'paciente_id' => 'required',
            'descripcion' => 'required',
            'medico_id' => 'required',
            'tratamiento_id' => 'required',
            'pago_id' => 'required',
            'estado' => 'required'

        ];
        $messages =[
            'paciente_id.required' => 'Ingresa un paciente',
            'descripcion.required' => 'Ingresa una descripción de la cita',
            'medico_id.required' => 'Ingresa un medico',
            'tratamiento_id.required' => 'Ingresa un tratamiento',
            'pago_id.required' => 'Ingresa un pago',
            'estado.required' => 'Ingresa un estado'

        ];

        $this->validate($rules,$messages);
        $cita = Cita::create([
            'descripcion' => $this->descripcion,
            'fecha_ini' => $this->fecha_ini,
            'fecha_fin' => $this->fecha_fin,
            'paciente_id' => $this->paciente_id,
            'medico_id' => $this->medico_id,
            'receta' => $this->receta,
            'user_id' => Auth::user()->id,
            'tratamiento_id' => $this->tratamiento_id,
            'pago_id' => $this->pago_id,
            'estado_id' => $this->estado
        ]);
        $cita->save();
        $this->resetUI();
        $this->emit('cita-added','cita registrada correctamente');



    }


    public function Update()
    {
        dd(
                $this->title, $this->start, $this->end, $this->tratamiento, $this->pago, $this->estado
            );
            // $this->descripcion,$this->fecha_ini, $this->fecha_fin, $this->paciente_id, $this->medico_id, $this->receta,
            //     $this->tratamiento_id, $this->pago_id,$this->estado
    }

    public function resetUI(){

        $this->descripcion ='';
        $this->fecha_ini = '';
        $this->fecha_fin = '';
        $this->medico_id ='';
        $this->receta = "";
        $this->tratamiento_id ='';
        $this->pago_id='';
        $this->estado='';
        $this->resetValidation();
        $this->resetPage();

    }

    public function validaFechas()
    {
        if($this->fecha_ini == null || $this->fecha_fin == null)
       {
        $this->emit('cita-error','Selecciona una fecha válida');
        return;
       }
       else
       {
        if($this->fecha_fin <= $this->fecha_ini)
        {
            $this->emit('cita-error','Fecha final debe ser mayor a fecha inicial');
            return;
        }

       }
    }




}
