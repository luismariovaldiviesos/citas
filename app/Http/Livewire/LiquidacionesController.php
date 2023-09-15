<?php

namespace App\Http\Livewire;

use App\Models\Cita;
use App\Models\Liquidacion;
use Livewire\Component;
use Livewire\WithPagination;

class LiquidacionesController extends Component
{

    use WithPagination;
    public  $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    // citas
   public $paciente, $precio_tratamiento, $total_pagado, $saldo_pendiente, $cita_selected;

   // nuevo pago
   public $nuevo_pago, $observaciones;



    public function mount()
    {
        $this->pageTitle = "Listado";
        $this->componentName = "Liquidacion de saldos";
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function render()
    {
        $citas = Cita::where('saldo_cita', '>',0)->orderBy('created_at','asc')->paginate($this->pagination);
        //dd($this->citas);
        return view('livewire.liquidaciones.component', ['citas' => $citas])->extends('layouts.theme.app')
        ->section('content');;
    }



    public function edit(Cita $cita)
    {
        //dd($cita);
        //public $paciente, $precio_tratamiento, $total_pagado, $saldo_pendiente;

        $this->cita_selected = $cita;
        $this->paciente = $cita->paciente->nombre;
        $this->precio_tratamiento = $cita->tratamiento->precio;
        $this->total_pagado = $cita->total;
        $this->saldo_pendiente = $cita->saldo_cita;
        $this->emit('show-modal', 'editar elemento');
        //dd($this->paciente);
    }

    public function resetUI()
    {
        $this->paciente ='';
        $this->precio_tratamiento = '';
        $this->total_pagado = '';
        $this->saldo_pendiente ='';
        $this->nuevo_pago ="";
        $this->observaciones="";
        $this->resetValidation();
        $this->resetPage();
    }

    public  function Store(){

        $rules = [
            'nuevo_pago' => 'required|numeric',
        ];

        $messages = [
            'nuevo_pago.required' => 'Valor a pagar es requerido',
            'nuevo_pago.numeric' => 'Valor a pagar debe ser en números',
        ];
        $this->validate($rules, $messages);

        //dd($this->precio_tratamiento,$this->total_pagado,$this->saldo_pendiente);
        //dd($this->id_cita);
        //$cita = Cita::find($this->id_cita);

        // calculos de cita
            //*** el nuevo pago no puede ser mayor al saldo pendiente */
            if ($this->nuevo_pago > $this->saldo_pendiente) {
                $this->emit('cita-error','El valor pago no puede ser mayor al saldo pendiete ');
                return;
            }
            else{
                //dd($this->cita_selected);
                $new_tot =  $this->total_pagado + $this->nuevo_pago;
                $new_saldo =  $this->precio_tratamiento - $new_tot;
                $this->cita_selected->saldo_cita = $new_saldo;
                $this->cita_selected->total = $new_tot;
                $this->cita_selected->save();
                $liquidacion =  Liquidacion::create([
                    'observaciones' => $this->observaciones,
                    'monto_liquidado' => $this->nuevo_pago,
                    'cita_id' => $this->cita_selected->id
                ]);
                $this->emit('cita-added','Liquidación generada correctamente');
                $this->resetUI();

                //dd('total pagado: ' . $new_tot . 'nuevo saldo: ' . $new_saldo);
                // guarda saldos cita

            }





        // guarda liquidaciones


    }
}
