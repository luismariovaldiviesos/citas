<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\PagoExtra;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreatePdfController extends Controller
{

    public function crearPdf($medico_id, $reportType, $dateFrom = null, $dateTo = null)
    {
        $citas = [];
        $pagosextras = [];
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
                ->where('citas.pago_id',1)
                 ->get();
                 $pagosextras = PagoExtra::whereBetween('created_at',[$from,$to])->get();
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
        ->where('citas.pago_id',1)
        ->get();
        $pagosextras = PagoExtra::whereBetween('created_at',[$from,$to])->get();
        //dd('por medicos');
    }

    $medico = $medico_id == 0 ? 'Todos' : Medico::find($medico_id)->name;
    $pdf = PDF::loadView('pdf.crearpdf', compact('citas','pagosextras','reportType','medico','dateFrom','dateTo','total_diario','extras'));
    return $pdf->stream('reporte.pdf'); // visualizar

    }

}
