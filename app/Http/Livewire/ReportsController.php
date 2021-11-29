<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Medico;
use App\Models\Cita;
use App\Models\Pago;
use Carbon\Carbon;


class ReportsController extends Component
{

    public $componentName, $data,
            $reportType, $medico_id, $dateFrom, $dateTo, $cita_id, $pago_id;

    public function mount()
    {

         $this->componentName = 'Reportes de Citas';
         $this->data = [];
         $this->details = [];
         $this->sumDetails =0;
         $this->countDetails =0;
         $this->reportType =0; // por defecto para que el reporte sea venta del dia
         $this->medico_id =0;
         $this->cita_id =0;

            }
    public function render()
    {
        $this->citasPorFecha();
        return view('livewire.reportes.component', [
            'medicos' => Medico::orderBy('nombre','asc')->get(),
            'pagos' => Pago::orderBy('nombre','asc')->get()

        ])->extends('layouts.theme.app')
        ->section('content');
    }

    function citasPorFecha()
    {
        if($this->reportType == 0) // ventas del dia
        {
            $from =  Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to =  Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }
        else
        {
            $from =  Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to =  Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo ==''))
        {
            return;
        }
        if($this->medico_id == 0) // si no se elige el usuario se muestra las ventas de todos ls usuarios
        {
            $this->data = Cita::join('medicos as m', 'm.id', 'citas.medico_id')
            ->select('citas.*','m.nombre as medico')
            ->whereBetween('citas.created_at', [$from, $to])
            ->get();
        }
        else{
            $this->data = Cita::join('medicos as m', 'm.id', 'citas.medico_id')
            ->select('citas.*','m.nombre as medico')
            ->whereBetween('citas.created_at', [$from, $to])
            ->where('medico_id', $this->medico_id)
            ->where('pago_id', $this->pago_id)
            ->get();
        }
    }

    public function reporteDiario(){
        return "diario reporte";
    }

    public function reporteFechas(){
        return " reporte fechas";
    }


}
