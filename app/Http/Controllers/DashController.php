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

        $sql =  "SELECT c.fecha, IFNULL(c.total,0) as total FROM(
            SELECT '$array[0]' as fecha
            UNION
            SELECT '$array[1]' as fecha
            UNION
            SELECT '$array[2]' as fecha
            UNION
            SELECT '$array[3]' as fecha
            UNION
            SELECT '$array[4]' as fecha
            UNION
            SELECT '$array[5]' as fecha
            UNION
            SELECT '$array[6]' as fecha
            ) d
            LEFT JOIN (
            SELECT SUM(total) as total, DATE(created_at) as
            fecha FROM citas WHERE created_at BETWEEN '$start' AND '$finish'
            AND estatus ='CERRADO' GROUP BY DATE(created_at)) c ON d.fecha =  c.fecha";


        print_r($array);

        //return view('dash');
    }
}
