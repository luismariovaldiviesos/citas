<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Clinica;
use App\Models\Liquidacion;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\PagoExtra;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreatePdfController extends Controller
{

    public function crearPdf($medico_id, $reportType, $dateFrom = null, $dateTo = null)
    {
        $citas = [];
        $pagos=[];
        $liquidaciones = [];
        $total_diario = 0;
        $extras = 0;



        if($reportType == 0) // ventas del dia
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';

        } else {
           $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
           $to = Carbon::parse($dateTo)->format('Y-m-d')     . ' 23:59:59';
       }


       if($medico_id == 0)
       {
        $citas = Cita::join('medicos as m', 'm.id', 'citas.medico_id')
        ->select('citas.*','m.nombre as medico')
        ->where(function($query) use ($from,$to)
                {
                    $query->whereBetween('citas.created_at', [$from,$to])
                           ->orwhereBetween('citas.updated_at', [$from,$to]);
                })
                ->where('citas.total','!=','0.00')
                 ->get();
                 $liquidaciones = Liquidacion::whereBetween('created_at',[$from,$to])->get();
                // dd('todos');
    } else {
        $citas = Cita::join('medicos as m', 'm.id', 'citas.medico_id')
        ->select('citas.*','m.nombre as medico')
        ->where(function($query) use ($from,$to)
        {
            $query->whereBetween('citas.created_at', [$from,$to])
                   ->orwhereBetween('citas.updated_at', [$from,$to]);
        })
        ->where('medico_id', $medico_id)
        ->where('citas.total','!=','0.00')
        ->get();
        $liquidaciones =  Liquidacion::join('citas as c','c.id','liquidacions.cita_id')
        ->select('liquidacions.*')
        ->where(function($query) use ($from,$to)
        {
            $query->whereBetween('liquidacions.created_at', [$from,$to])
                   ->orwhereBetween('liquidacions.updated_at', [$from,$to]);
        })
        ->where('c.medico_id','=',$medico_id)
         ->get();
        //dd('por medicos');
    }
    $clinica = Clinica::all();
    $logo = $clinica[0]->image;
    //dd($logo);

    $medico = $medico_id == 0 ? 'Todos' : Medico::find($medico_id)->name;
    $pdf = PDF::loadView('pdf.crearpdf', compact('citas','liquidaciones','reportType','medico','dateFrom','dateTo','total_diario','extras','logo'));
    return $pdf->stream('reporte.pdf'); // visualizar

    }



    public  function detallePacientePDF(Paciente $idpaciente)
    {

        $clinica = Clinica::all();
        $logo = $clinica[0]->image;
        $totalpagadopaciente = 0;
        $totalpendientepaciente = 0;
        $totaldetallepaciente = 0;
        $sumExtras = 0;
       $citas = $idpaciente->citas;
       $pagos =  $idpaciente->pagoextras;
       $nombrepaciente = $idpaciente->nombre;
       //dd($citas);
       $detallepacientepdf = PDF::loadView('pdf.detallepacientepdf', compact('nombrepaciente','citas',
       'totalpagadopaciente','totalpendientepaciente',
       'totaldetallepaciente','pagos','sumExtras','logo'));
       return $detallepacientepdf->stream('detallepaciente.pdf');
    }

}
