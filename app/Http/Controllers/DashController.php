<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Tratamiento;
use App\Models\Estado;
use App\Models\Cita;
use App\Models\Paciente;
use DB;

class DashController extends Controller
{

    public function data()
    {

        $currentYear =  date('Y');
        $start =  date('Y-m-d', strtotime('monday this week')); // lunes
        $finish =  date('Y-m-d', strtotime('sunday this week'));// domingo

        $d1 =  strtotime($start);
        $d2 = strtotime($finish);
        $array =  array();
        for($currentDate =  $d1; $currentDate <= $d2; $currentDate +=(86400))  // se suma un dia (86400 segundos)
        {
            $dia = date('Y-m-d', $currentDate); // convertir dia en formato unix  a formato ingles standard
            $inicio = $dia. ' 00:00:00';
            $fin = $dia. ' 23:59:59';

            $array[] = $dia; //lunes masrtes etc
        }


        print_r($array);

        //return view('dash');
    }
}
