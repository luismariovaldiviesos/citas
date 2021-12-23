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
                        <span style="font-size: 25px; font-weight: bold;">Historia clínica {{ $nombrepaciente }}</span>
                    </td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative; ">
                        <img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="invoice-logo">
                    </td>

                    <td width="70%"  class="text-left text-company"  style="vertical-align: top; padding-top: 10px;">

                        {{-- <span style="font-size: 14px">Usuario: {{$user}}</span> --}}
                    </td>
                </tr>
            </table>
        </section>

          {{-- table --}}
        <section style="margin-top: -110px">
            <h3 class="card-title text-center"><b>Reporte de citas {{ $nombrepaciente }}  </b></h3>
            <table border="2px" cellpadding ="2" cellspacing="2" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="25%">FECHA</th>
                        <th width="15%">TRATAMIENTO</th>
                        <th width="15%">CITA</th>
                        <th width="15%">VALOR</th>
                        <th width="15%">ESTADO</th>
                        <th width="15%">MEDICO</th>

                    </tr>
                </thead>
                <tbody >
                    @foreach ($citas as $c )
                    <tr>
                        <td align="center">{{\Carbon\Carbon::parse($c->fecha_ini)->isoFormat('LL')}}</td>
                        <td align="center">{{$c->tratamiento->nombre}}</td>
                        <td align="center">{{$c->estado->nombre}}</td>
                        <td align="center">{{$c->tratamiento->precio}}</td>
                        <td align="center">{{$c->estado_pago}}</td>
                        <td align="center">{{$c->medico->nombre}}</td>

                        @if ($c->estado_pago == 'PAGADO')
                            @php
                                $totalpagadopaciente = $totalpagadopaciente+$c->tratamiento->precio
                            @endphp


                        @elseif ($c->estado_pago == 'PENDIENTE')
                            @php
                                $totalpendientepaciente = $totalpendientepaciente+$c->tratamiento->precio
                            @endphp
                         @endif

                    </tr>
                    @endforeach
                </tbody >

                <tfoot >
                    <tr>
                        <td colspan="2" style="border: 10px"><h4 class="text-center font-weight-bold">
                        <span class="badge badge-danger">CANCELADO:</span></h4></td>
                        <td style="border: 10px"><h4 class="text-center">{{$totalpagadopaciente}}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 10px"><h4 class="text-center font-weight-bold">
                        <span class="badge badge-danger">PENDIENTE:</span></h4></td>
                        <td style="border: 10px"> <h4 class="text-center">{{$totalpendientepaciente}}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 10px"><h4 class="text-center font-weight-bold">
                        <span class="badge badge-primary">TOTAL PACIENTE:</span></h4></td>
                        <td style="border: 10px"><h4 class="text-center">{{$totalpagadopaciente + $totalpendientepaciente}}</h4></td>
                        {{-- <td><h5 class="text-center">{{$idpaciente}}</h5></td> --}}

                    </tr>
                </tfoot>
            </table>







            {{-- <h2>TOTAL: $ {{ $total_diario + $extras }}</h2> --}}

        </section>

        <section class="footer">
            <table cellpadding ="0" cellspacing="0" class="table-items" width="100%">
                <tr>
                    <td width="20%">
                        <span>Sistema de ventas Khipu v1</span>
                    </td>
                    <td width="60%" class="text-center">
                        <link rel="stylesheet" href="https://khipuweb.herokuapp.com">
                        <a href="https://khipuweb.herokuapp.com">Sitio web</a>
                    </td>
                    <td  width="20%"  class="text-center">
                        página <span class="pagenum"></span>
                    </td>
                </tr>
            </table>
        </section>

</body>
</html>
