<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Estado;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Pago;
use App\Models\Tratamiento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CalendarController extends Component
{
    use WithPagination, WithFileUploads;
    public $events ;
    public $title, $start, $end, $tratamiento, $pago, $estado , $id_cita;


    // para agendar
    public $fecha_ini, $fecha_fin, $descripcion, $medico_id, $receta, $tratamiento_id, $pago_id, $estado_id, $paciente_id;

    // datos para cita
    public $medicos, $tratamientos, $pagos, $estados, $pacientes;

    public $editar ="si", $hoy;


    public function mount()
    {

    }

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
        session()->flash('message', 'CITA AGENDADA CORRECTAMENTE');
         return redirect()->to('/calendario');
        //$this->emit('cita-added','cita registrada correctamente');



    }




    public function Update()
    {

            $cita = Cita::find($this->id_cita);
            //dd($cita->fecha_ini) ;
            if($this->tratamiento_id == null || $this->tratamiento_id == 'Elegir')
            {
                $this->tratamiento_id = $cita->tratamiento_id;
            }
            if($this->pago_id == null || $this->pago_id == 'Elegir')
            {
                $this->pago_id = $cita->pago_id;
            }
            if($this->estado_id == null || $this->estado_id == 'Elegir')
            {
                $this->estado_id = $cita->estado_id;
            }

            $cita->update([
                'descripcion' => $this->title,
                'fecha_ini' => $cita->fecha_ini,
                'fecha_fin' => $cita->fecha_fin,
                'paciente_id' => $cita->paciente_id,
                'medico_id' => $cita->medico_id,
                'receta' => $this->receta,
                'user_id' => Auth::user()->id,
                'tratamiento_id' => $this->tratamiento_id,
                'pago_id' => $this->pago_id,
                'estado_id' => $this->estado_id
            ]);
            $this->resetUI();
            $this->emit('cita-updated', 'Cita Actualizada ');
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
