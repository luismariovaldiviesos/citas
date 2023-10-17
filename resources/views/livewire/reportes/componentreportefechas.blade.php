<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{$componentName}}</b></h4>
            </div>
            @can('ver_reporte')
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el usuario</h6>
                                <div class="form-group">
                                    <select wire:model="medico_id" class="form-control">
                                        <option value="0">Todos</option>
                                        @foreach($doctores as $medico)
                                        <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Elige el tipo de reporte</h6>
                                <div class="form-group">
                                    <select wire:model="reportType" class="form-control">
                                        <option value="0">Ventas del día</option>
                                        <option value="1">Ventas por fecha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha desde</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateFrom" class="form-control flatpickr" placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha hasta</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateTo" class="form-control flatpickr" placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire:click="$refresh" class="btn btn-dark btn-block">
                                    Consultar
                                </button>

                                <a class="btn btn-dark btn-block {{count($citas)  <1 && count($liquidaciones) <1 ? 'disabled' : '' }}"
                                href="{{ url('crearpdf/pdf' . '/' . $medico_id . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank">Generar PDF</a>

                                {{-- <a  class="btn btn-dark btn-block {{count($citas) <1 ? 'disabled' : '' }}"
                                href="{{ url('report/excel' . '/' . $medico_id . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}" target="_blank">Exportar a Excel</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <!--TABLAE-->
                        <div class="table-responsive">
                            <table class="table table-bordered table striped ">
                                <thead class="text-white" style="background: #3B3F5C">
                                    <tr>
                                            <th class="text-white table-th text-center" style="width: 5%">cita</th>
                                            <th class="text-white table-th text-center">PACIENTE</th>
                                            <th class="text-white table-th text-center">TRATAMIENTO</th>
                                            <th class="text-white table-th text-center">MÉDIC@</th>
                                            <th class="text-white table-th text-center">PRECIO</th>
                                            <th class="text-white table-th text-center">CANCELADO</th>
                                            <th class="text-white table-th text-center">SALDO</th>
                                            <th class="text-white table-th text-center">FECHA</th>                                           
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($citas) <1)
                                    <tr><td colspan="7"><h5>Sin Resultados</h5></td></tr>
                                    @endif
                                    @foreach ($citas as $c )
                                        <tr>

                                            <td class="text-center" ><h6>{{$c->id}}</h6></td>
                                            <td class="text-center"><h6>{{$c->paciente->nombre}}</h6></td>
                                            <td class="text-center"><h6>{{$c->tratamiento->nombre}}</h6></td>
                                            <td hidden><h6>{{$sumCitas = $sumCitas+$c->total_ini }}</h6></td>
                                            <td class="text-center"><h6>{{$c->nombremedico}}</h6></td>
                                           <td class="text-center"><h6>{{$c->precio_tratamiento}}</h6></td>
                                           <td class="text-center"><h6>{{$c->total_ini}}</h6></td>
                                           <td class="text-center"><h6>{{$c->saldo_cita}}</h6></td>
                                           <td class="text-center"><h6>{{\Carbon\Carbon::parse($c->created_at)->isoFormat('LL')}}</h6></td>
                                        

                                       </tr>
                                        @endforeach
                                </tbody>
                                {{-- <tfoot class="p-3 mb-2 bg-white text-dark">
                                    <tr>
                                        <th>
                                            <h6 class="badge bage-info"> subtotal en citas :  {{$sumCitas}} </h6>
                                        </th>
                                       
                                    </tr>
                                </tfoot>  --}}
                              
                                
                            </table>
                            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-body  badge badge-info">
                                  <h5 class="card-title">SUBTOTAL CITAS</h5>
                                  <h4 class="card-text">{{$sumCitas}}</h4>
                                </div>
                            </div>
                        
                          
                        </div>

                        <br>


                         {{-- TABLA DE PAGOS --}}

                         <div class="table-responsive">
                            <table class="table mt-1 table-bordered table-striped ">
                                <h4 class="card-title text-center"><b>Valores Liquidados</b></h4>
                                <thead class="text-white" style="background: #3B3F5C">
                                    <tr>
                                        <th class="text-white table-th text-center" style="width: 5%">cita</th>
                                        <th class="text-white table-th text-center">DESCRIPCION</th>
                                        <th class="text-white table-th text-center">PACIENTE</th>
                                        <th class="text-white table-th text-center">medico</th>
                                        <th class="text-white table-th text-center">MONTO</th>
                                        <th class="text-white table-th text-center">FECHA</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($liquidaciones) <1 )
                                        <tr><td colspan="7"><h5>Sin pagos extras</h5></td></tr>
                                    @endif
                                    @foreach ($liquidaciones as $pe )
                                    <tr>
                                        <td class="text-center"><h6>{{$pe->cita_id}}</h6></td>
                                         <td class="text-center"><h6>{{$pe->observaciones}}</h6></td>
                                         <td class="text-center"><h6>{{$pe->cita->paciente->nombre}}</h6></td>
                                         <td class="text-center"><h6>{{$pe->cita->medico->nombre}}</h6></td>
                                         <td class="text-center"><h6>{{$pe->monto_liquidado}}</h6></td>
                                         <td hidden><h6>{{$sumExtras = $sumExtras+$pe->monto_liquidado }}</h6></td>
                                         <td class="text-center"><h6>{{\Carbon\Carbon::parse($pe->created_at)->isoFormat('LL')}}</h6></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {{-- <tfoot class="p-3 mb-2 bg-white text-dark">
                                    <tr>
                                        <th>
                                            <h4 class="">subtotal en liquidaciones:  {{$sumExtras}} </h4>
                                        </th>
                                    </tr>
                                </tfoot> --}}
                            </table>
                            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-body  badge badge-success">
                                  <h5 class="card-title">SUBTOTAL LIQUIDACIONES</h5>
                                  <h4 class="card-text">{{$sumExtras}}</h4>
                                </div>
                            </div>
                        </div>
                        {{-- <h2>TOTAL en CAJA: {{ $sumCitas + $sumExtras }}</h2> --}}
                        <div class="card text-bg-dark mb-3" style="max-width: 18rem; margin: 0 auto; text-align: center;">
                            <div class="card-body badge badge-dark" style="color: white;">
                                <h5 class="card-title" style="color: white;">TOTAL REPORTE</h5>
                                <h4 class="card-text" style="color: white;">{{ $sumCitas + $sumExtras}}</h4>
                            </div>
                        </div>
                        
                    </div>
                   
                </div>
            </div>
            @endcan
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        flatpickr(document.getElementsByClassName('flatpickr'),{
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firstDayofWeek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado",
                    ],
                },
                months: {
                    shorthand: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                    ],
                    longhand: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                    ],
                },

            }

        })


        //eventos
        window.livewire.on('show-modal', Msg =>{
            $('#modalDetails').modal('show')
        })
    })

    function rePrint(saleId)
    {
        window.open("print://" + saleId,  '_self').close()
    }
</script>






<script>

    document.addEventListener('DOMContentLoaded', function(){
        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firtsDayofWeek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado",
                    ],
                },
                    months: {
                    shorthand: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                    ],
                    longhand: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                    ],
                },
            }
        })

        //eventos
        window.livewire.on('show-modal', Msg => {
            $('#modalDetails').modal('show')
        })
    })
</script>
