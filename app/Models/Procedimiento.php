<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','precio'];


    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }

    //un procedimiento tiene citas a traves de tratamientos;

    public function citas() {
        return $this->hasManyThrough(Cita::class, Tratamiento::class);
    }

    // // total de citas y saldo restante para el procedimiento
    // public function calcularSaldo(){
    //     // $costoProcedimiento = $this->precio; // Supongo que tienes un campo 'precio' en tu modelo 'Procedimiento'.
    //     // $costoTotalTratamientos = $this->tratamientos->sum('precio');
    //     // $totalCitas = Cita::whereIn('tratamiento_id', $this->tratamientos->pluck('id'))->sum();

    //     // // Calcula el saldo restando el costo total de los tratamientos de las citas.
    //     // $saldo = $costoProcedimiento - ($costoTotalTratamientos * $totalCitas);

    //     // return $saldo;

    //     $costoProcedimiento = $this->precio; // Supongo que tienes un campo 'costo' en tu modelo 'Procedimiento'.

    //     // Obtén la suma de los campos 'total' de todas las citas relacionadas con los tratamientos del procedimiento.
    //     $sumaTotalCitas = Cita::whereIn('tratamiento_id', $this->tratamientos->pluck('id'))->sum('total');

    //     // Calcula el saldo restando el costo total de los tratamientos y la suma de los campos 'total' de las citas.
    //     $saldo = $costoProcedimiento - $sumaTotalCitas;

    //     return $saldo;
    // }

    public function calcularSaldoParaPaciente($pacienteId)
    {
        // Obtener todas las citas relacionadas con el paciente.
        $citasDelPaciente = Cita::where('paciente_id', $pacienteId)->get();

        // Inicializar un arreglo para almacenar los saldos y nombres de procedimientos.
        $saldosDeProcedimientos = [];

        foreach ($citasDelPaciente as $cita) {
            $procedimiento = $cita->tratamiento->procedimiento;
            $procedimientoId = $procedimiento->id;
            $procedimientoNombre = $procedimiento->nombre; // Reemplaza 'nombre' por el nombre real de la columna que almacena los nombres de los procedimientos.

            if (!isset($saldosDeProcedimientos[$procedimientoId])) {
                //dd('aqui');
                $saldosDeProcedimientos[$procedimientoId] = [
                    'nombre' => $procedimientoNombre,
                    'saldo' => $procedimiento->precio - $cita->total,
                ];
            } else {
                $saldosDeProcedimientos[$procedimientoId]['saldo'] -= $cita->tratamiento->precio;
            }
        }

        return $saldosDeProcedimientos;
    }
}





