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
                        <img src="{{ asset('assets/img/logo.jpg') }}" alt="" class="invoice-logo">
                    </td>

                    <td width="70%"  class="text-left text-company"  style="vertical-align: top; padding-top: 10px;">
                        {{-- @if ($reportType == 0) --}}
                            <span style="font-size: 16px"><strong>Recaudación del Día</strong></span>
                        {{-- @else
                            <span style="font-size: 16px"><strong>Reporte de ventas por fechas</strong></span>
                        @endif --}}
                        <br>
                        {{-- @if ($reportType !=0)
                            <span style="font-size: 16px"><strong>Fecha de Consulta : {{$dateFrom}} al {{$dateTo}}</strong></span>
                        @else --}}
                            <span style="font-size: 16px"><strong>Fecha de Consulta : {{\Carbon\Carbon::now()->format('d-M-Y')}}</strong></span>
                        {{-- @endif --}}
                        <br>
                        {{-- <span style="font-size: 14px">Usuario: {{$user}}</span> --}}
                    </td>
                </tr>
            </table>
        </section>

          {{-- table --}}
        <section style="margin-top: -110px">
            <table cellpadding ="0" cellspacing="0" class="table-items" width="100%">
                <thead>
                    <tr>
                        <th width="10%">PACIENTE</th>
                        <th width="12%">TRATAMIENTO</th>
                        <th width="12%">PRECIO</th>
                        <th width="10%">MEDICO</th>
                        <th width="12%">PAGOS EXTRAS</th>
                        {{-- <th>USUARIO</th>
                        <th width="18%">FECHA</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d )
                    <tr>
                        <td align="center">{{$d->paciente->nombre}}</td>
                        <td align="center">{{$d->tratamiento->nombre}}</td>
                        <td align="center">{{$d->tratamiento->precio }}</td>
                        <td align="center">{{$d->medico}}</td>
                        @php
                            $total_diario = $total_diario+$d->tratamiento->precio
                        @endphp
                        {{-- <td align="center">{{$item->user}}</td>
                        <td align="center">{{\Carbon\Carbon::parse($item->created_at)->format('d-m-y')}}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <h2 class="">CAJA:  {{$total_diario}} </h2>
                        </th>
                    </tr>
                </tfoot>
            </table>
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
