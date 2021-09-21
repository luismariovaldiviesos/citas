<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\User;
use App\Models\Tratamiento;
use App\Models\Pago;
use App\Models\Estado;
use Carbon\Carbon;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Component
{
    public $descripcion, $fecha_ini, $fecha_fin, $medico_id, $receta, $user_id, $buscar_paciente,
    $tratamiento_id, $pago_id, $citas ;


    public function mount()
    {
        $this->estado_id = 0;
        $this->citas = [];


    }
    public function save()
    {
        // dd($this->fecha_ini, $this->fecha_fin, $this->buscar_paciente, $this->descripcion, $this->medico_id, $this->receta,
        //  $this->user_id, $this->tratamiento_id, $this->pago_id);
    }

    public function render()
    {
        return view('livewire.calendario.component', [
            'estados' => Estado::orderBy('id','asc')->get(),
            'citas' => $this->citas,
            'pacientesSearch' => Paciente::all(),
            'pacientes' => Paciente::where('nombre','like','%'.$this->buscar_paciente.'%')->get(),
            'medicos' => Medico::all(),
            'tratamientos' => Tratamiento::all(),
            'pagos' => Pago::all(),
            'estados' => Estado::all()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

}
