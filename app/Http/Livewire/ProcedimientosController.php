<?php

namespace App\Http\Livewire;

use App\Models\Procedimiento;
use Livewire\Component;
use Livewire\WithPagination;

class ProcedimientosController extends Component
{
    use WithPagination;

    public  $nombre, $precio, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componentName = "Procedimientos";
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {


        if(strlen($this->search)> 0)
        {
            $data = Procedimiento::where('nombre','like', '%'. $this->search .'%')
            ->paginate($this->pagination);
        }
        else
        {
            $data = Procedimiento::orderBy('id','asc')
            ->paginate($this->pagination);
        }
        //dd($data);

        return view('livewire.procedimientos.component', ['procedimientos' => $data])->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id)
    {

        $record = Procedimiento::find($id, ['id','nombre','precio']);
        $this->nombre = $record->nombre;
        $this->precio = $record->precio;
        $this->selected_id = $record->id;

        // notificar al fornt que la info ya esta cargada en las propiedaddes y que
        // puede mostrar el modal
        // para eso se emite el evento :

        $this->emit('show-modal', 'editar elemento');
    }

    public function Store()
    {

        $rules = [
            'nombre' => 'required|unique:procedimientos|min:3',
            'precio' => 'required',

        ];

        $messages = [
            'nombre.required' => 'El nombre del procedimiento es requerido',
            'nombre.unique' => 'El nombre del procedimiento ya esta en uso ',
            'nombre.min' => 'El nombre del procedimiento debe tener mínimo tres caracteres',
            'precio.required' => 'El precio del procedimiento es requerido',



        ];

        $this->validate($rules,$messages);

        $procedimiento = Procedimiento::create([

            'nombre' => $this->nombre,
            'precio' => $this->precio

        ]);
        //dd($pago);
        $procedimiento->save();
        $this->resetUI();
        $this->emit('procedimiento-added','procedimiento registrado correctamente');
    }


    public function Update()
    {
        $rules = [
            'nombre' => "required|unique:procedimientos,nombre,{$this->selected_id}|min:3",
            'precio' => 'required',

        ];

        $messages = [
            'nombre.required' => 'El nombre del procedimiento es requerido',
            'nombre.unique' => 'El nombre del procedimiento ya esta en uso ',
            'nombre.min' => 'El nombre del procedimiento debe tener mínimo tres caracteres',
            'precio.required' => 'El precio del procedimiento es requerido',


        ];
        $this->validate($rules,$messages);


        $procedimiento =  Procedimiento::find($this->selected_id);
        //dd($tratamiento);
        $procedimiento->update([
            'nombre' => $this->nombre,
            'precio' => $this->precio
        ]);

        $this->resetUI();
        $this->emit('procedimiento-updated','Procedimiento actualizado correctamente');


    }
    public function resetUI()
    {
        $this->nombre ='';
        $this->precio ='';
        $this->search='';
        $this->selected_id=0;
    }

    protected $listeners = [

        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Procedimiento $procedimiento)
    {
        //$tratamiento = Tratamiento::find($id);
        $procedimiento->delete();
        $this->resetUI();
        $this->emit('proce-deleted','Procedimiento eliminado correctamente');
    }



}
