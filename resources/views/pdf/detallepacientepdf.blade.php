<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial paciente</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">
</head>
<body>

        {{-- encabezado --}}

        <section class="header" style="top: -287px;">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td colspan="2" class="text-center">
                        <span style="font-size: 25px; ;">Historial {{ $nombrepaciente }}</span>
                    </td>
                </tr>

            </table>
        </section>

          {{-- table --}}
        <section style="margin-top: -260px">
            <h2 class="card-title text-center">Citas:</h2>
            <table border="2px" cellpadding ="2" cellspacing="2" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="25%">FECHA</th>
                        <th width="15%">TRATAMIENTO</th>
                        <th width="15%"> ESTADO CITA</th>
                        <th width="15%">PRECIO</th>
                        <th width="15%">PAGADO</th>
                        <th width="15%">SALDO</th>
                        <th width="15%">MEDICO</th>

                    </tr>
                </thead>
                <tbody >
                    @foreach ($citas as $c )
                    <tr>
                        <td align="center">{{\Carbon\Carbon::parse($c->fecha_ini)->isoFormat('LL')}}</td>
                        <td align="center">{{$c->tratamiento->nombre}}</td>
                        <td align="center">{{$c->estado->nombre}}</td>
                        <td align="center">{{$c->precio_tratamiento}}</td>
                        <td align="center">{{$c->total}}</td>
                        <td align="center">{{$c->saldo_cita}}</td>
                        <td align="center">{{$c->medico->nombre}}</td>


                            @php
                                $totalpagadopaciente = $totalpagadopaciente+$c->total
                            @endphp



                            @php
                                $totalpendientepaciente = $totalpendientepaciente+$c->saldo_cita
                            @endphp


                    </tr>
                    @endforeach
                </tbody >

            </table>

            <h3>Abonado : {{$totalpagadopaciente}}</h3>
            <h3>Deuda : {{$totalpendientepaciente}}</h3>
            <h3>Total: {{$totalcitas = $totalpendientepaciente + $totalpagadopaciente}}</h3>


            <h2 class="card-title text-center">Saldos pendientes en procedimientos</h2>
                <table border="2px" cellpadding ="2" cellspacing="2" class="table-items" width="100%">
                    <thead>
                        <tr>
                            <th width="33%">NOMBRE</th>
                            <th width="33%">SALDO</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($saldosprocedimientos as  $key => $sp )

                            @if ($key > 1) <!-- Verifica si no es la primera fila -->
                                <tr>
                                    <td align="center">{{$sp['nombre']}}</td>
                                    <td align="center">{{$sp['saldo']}}</td>
                                </tr>
                            @endif

                     @endforeach
                    </tbody>

                </table>

              <h2>Saldo pendiente: {{ $totalpendientepaciente}}</h2>



        </section>

        <section class="footer">
            <table cellpadding ="0" cellspacing="0" class="table-items" width="100%">
                <tr>
                    <td width="20%">
                        <span>Sistema de Citas Khipu v2</span>
                        <p>Contacto: whatsApp:  0987308688</p>
                    </td>
                    <td width="60%" class="text-center">

                    </td>
                    <td  width="20%"  class="text-center">
                        página <span class="pagenum"></span>
                    </td>
                </tr>
            </table>
        </section>

</body>
</html>
