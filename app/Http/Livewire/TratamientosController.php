<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use Livewire\Component;
use App\Models\Tratamiento;
use Livewire\WithPagination;
use App\Models\Procedimiento;

use Livewire\WithFileUploads;  // para imagenes subir
use Illuminate\Support\Facades\Storage; // para almacenar archivos


class TratamientosController extends Component
{
    use WithPagination;

    public  $nombre, $precio, $procedimiento_id, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componentName = "Tratamientos";
    }


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }



    public function render()
    {
        if(strlen($this->search)> 0)
        {
            $data = Tratamiento::where('nombre','like', '%'. $this->search .'%')
            ->paginate($this->pagination);
        }
        else
        {
            $data = Tratamiento::orderBy('id','asc')
            ->paginate($this->pagination);
        }

        $procedimientos = Procedimiento::all();

        return view('livewire.tratamientos.tratamientos', ['tratamientos' => $data,'procedimientos' => $procedimientos])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id)
    {

        $record = Tratamiento::find($id);
        $citasConSaldos = Cita::where('tratamiento_id','=',$record->id)
        ->where('saldo_cita','>',0)
        ->exists();
        if (!$citasConSaldos) {
            $citaEstado = Cita::where('tratamiento_id','=',$record->id)
            ->where('estado_id',1)
            ->exists();
            if (!$citaEstado) {
                $this->nombre = $record->nombre;
                $this->precio = $record->precio;
                $this->selected_id = $record->id;
                $this->procedimiento_id =  $record->procedimiento_id;
                $this->emit('show-modal', 'editar elemento');
            }else{ $this->emit('tratamiento-noedita', 'no se puede editar el tratamiento, tiene citas en estado  pendientes');}

        }
        else{
            $this->emit('tratamiento-noedita', 'no se puede editar el tratamiento, tiene saldos pendientes');
        }



    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|min:3',
            'precio' => 'required|numeric|between:0,10000',
            'procedimiento_id' =>  'required'
        ];

        $messages = [
            'nombre.required' => 'El nombre del tratamiento es requerido',
            'procedimiento_id.required' => 'El procedimiento del tratamiento es requerido',
            'nombre.min' => 'El nombre del tratamiento debe tener mínimo tres caracteres',

            'precio.required' => 'El precio del tratamiento es requerido',
            'precio.numeric' => 'El precio del tratamiento debe ser un valor númerico ',
            'precio.between' => 'El precio del tratamiento debe estar entre 0.99'
        ];

        $this->validate($rules,$messages);
        $tratamiento = Tratamiento::create([

            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'procedimiento_id' => $this->procedimiento_id

        ]);
        $tratamiento->save();
        $this->resetUI();
        $this->emit('tratamiento-added','Tratamiento registrado correctamente');

    }

     public function Update()
    {
        $rules = [
            'nombre' => 'required|min:3',
            'precio' => 'required|numeric|between:0,10000',
            'procedimiento_id' =>  'required'
        ];

        $messages = [
            'nombre.required' => 'El nombre del tratamiento es requerido',
            'procedimiento_id.required' => 'El procedimiento del tratamiento es requerido',
            'nombre.min' => 'El nombre del tratamiento debe tener mínimo tres caracteres',

            'precio.required' => 'El precio del tratamiento es requerido',
            'precio.numeric' => 'El precio del tratamiento debe ser un valor númerico ',
            'precio.between' => 'El precio del tratamiento debe estar entre 0.99'
        ];
        $this->validate($rules,$messages);


        $tratamiento =  Tratamiento::find($this->selected_id);
        //dd($tratamiento);
        $tratamiento->update([
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'procedimiento_id' => $this->procedimiento_id
        ]);

        $this->resetUI();
        $this->emit('tratamiento-updated','Tratamiento actualizado correctamente');


    }

    public function resetUI()
    {
        $this->nombre ='';
        $this->precio ='';
        $this->search='';
        $this->selected_id=0;
        $this->procedimiento_id ='';
    }

    protected $listeners = [

        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Tratamiento $tratamiento)
    {
        //$tratamiento = Tratamiento::find($id);
        $tratamiento->delete();
        $this->resetUI();
        $this->emit('tratamiento-deleted','Tratamiento eliminado correctamente');
    }
}
