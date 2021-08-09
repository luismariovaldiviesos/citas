<?php

namespace App\Http\Livewire;

use App\Models\Medico;
use Livewire\Component;
use Livewire\WithPagination;


class MedicosController extends Component
{

    use WithPagination;

    public  $nombre, $ci, $telefono, $email,$imagen, $direccion;
    public  $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componentName = "Medicos/as";
    }


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function render()
    {
        if(strlen($this->search)> 0)
        {
            $data = Medico::where('nombre','like', '%'. $this->search .'%')
            ->paginate($this->pagination);
        }
        else
        {
            $data = Medico::orderBy('id','asc')
            ->paginate($this->pagination);
        }

        return view('livewire.medicos.medicos', ['medicos' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id)
    {

        $record = Medico::find($id, ['id','nombre','ci', 'telefono',  'email','imagen','direccion']);
        $this->nombre = $record->nombre;
        $this->ci = $record->ci;
        $this->telefono = $record->telefono;
        $this->email = $record->email;
        $this->imagen = $record->imagen;
        $this->direccion = $record->direccion;
        $this->selected_id = $record->id;

        // notificar al fornt que la info ya esta cargada en las propiedaddes y que
        // puede mostrar el modal
        // para eso se emite el evento :

        $this->emit('show-modal', 'editar elemento');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:medicos|min:3',
            'ci' => 'required|unique:medicos|min:10',

        ];

        $messages = [
            'nombre.required' => 'El nombre del estado es requerido',
            'nombre.unique' => 'El nombre del estado ya esta en uso ',
            'nombre.min' => 'El nombre del estado debe tener mínimo tres caracteres'
        ];

        $this->validate($rules,$messages);
        $estado = Estado::create([

            'nombre' => $this->nombre
        ]);

        $estado->save();
        $this->resetUI();
        $this->emit('estado-added','estado registrado correctamente');

    }

}
