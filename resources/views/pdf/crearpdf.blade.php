<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Caja</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">
</head>
<body>

        {{-- encabezado --}}

        <section class="header" style="top: -287px;">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td colspan="2" class="text-center">
                        <span style="font-size: 25px; font-weight: bold;">Sistema de Citas</span>
                    </td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative; ">
                        {{-- <img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="invoice-logo"> --}}
                        <img src="{{ asset('storage/clinica/' . $logo ) }}" alt="imagen de ejemplo" height="80" width="90" class="rounded">
                    </td>

                    <td width="70%"  class="text-left text-company"  style="vertical-align: top; padding-top: 10px;">
                        @if ($reportType == 0)
                            <span style="font-size: 16px"><strong>Reporte del Día</strong></span>
                        @else
                            <span style="font-size: 16px"><strong>Reporte por fechas</strong></span>
                        @endif
                        <br>
                        @if ($reportType !=0)
                            <span style="font-size: 16px">
                                <strong>Fecha de Consulta: <br>
                                             {{\Carbon\Carbon::parse($dateFrom)->isoFormat('LL')}}
                                        al  {{\Carbon\Carbon::parse($dateTo)->isoFormat('LL')}}</strong></span>
                        @else
                            <span style="font-size: 16px"><strong>Fecha de Consulta : {{\Carbon\Carbon::now()->format('d-M-Y')}}</strong></span>
                        @endif
                        <br>
                        
                    </td>
                </tr>
            </table>
        </section>

          {{-- table --}}
        <section style="margin-top: -110px">
            <h4 class="card-title text-center"><b>Reporte de Citas  </b></h4>
            <table cellpadding ="0" cellspacing="0" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="10%">NUM CITA</th>
                        <th width="10%">PACIENTE</th>
                        <th width="12%">TRATAMIENTO</th>
                        <th width="10%">MEDICO</th>
                        <th width="12%">VALOR CANCELADO</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $c )
                    <tr>

                        <td align="center">{{$c->id}}</td>
                        <td align="center">{{$c->paciente->nombre}}</td>
                        <td align="center">{{$c->tratamiento->nombre}}  {{$c->tratamiento->precio}}</td>
                        <td align="center">{{$c->medico}}</td>
                        <td align="center">{{$c->total_ini }}</td>

                        @php
                            $total_diario = $total_diario+$c->total_ini
                        @endphp
                        {{-- <td align="center">{{$item->user}}</td>
                        <td align="center">{{\Carbon\Carbon::parse($item->created_at)->format('d-m-y')}}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
              
            </table>


            {{-- TABLA DE PAGOS EXTRAS  --}}
            <h4 class="card-title text-center"><b>Liquidaciones de citas</b></h4>
            <table cellpadding ="0" cellspacing="0" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="10%">NUM CITA</th>
                        <th width="10%">NOTA</th>
                        <th width="12%">PACIENTE</th>
                        <th width="10%">MONTO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liquidaciones as $pe )
                    <tr>
                        <td align="center">{{$pe->cita_id}}</td>
                        <td align="center">{{$pe->observaciones}}</td>
                        <td align="center">{{$pe->cita->paciente->nombre}}</td>
                        <td align="center">{{$pe->monto_liquidado}}</td>

                        @php
                            $extras = $extras+$pe->monto_liquidado
                        @endphp

                    </tr>
                    @endforeach
                </tbody>
              
            </table>

            <h3>SubTotal citas  {{$total_diario}}</h3>
            <h3>SubTotal liquidaciones {{ $extras }}</h3>
            <h2>TOTAL REPORTE:  {{ $total_diario + $extras }}</h2>

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
