<?php

namespace App\Http\Livewire;
use App\Models\Tratamiento;
use Livewire\WithPagination;
use Livewire\WithFileUploads;  // para imagenes subir
use Illuminate\Support\Facades\Storage; // para almacenar archivos

use Livewire\Component;


class TratamientosController extends Component
{
    use WithPagination;

    public  $nombre, $precio, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componentName = "Tratamientos";
    }

    public function render()
    {
        $data = Tratamiento::all();
        return view('livewire.tratamiento.tratamientos', ['tratamientos' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
