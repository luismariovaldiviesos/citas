
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        @can('ver_cita')

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName}} | {{$pageTitle}}</b>
                </h4>
                @can('crear_cita')
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-success" data-toggle="modal"
                            data-target="#theModal">Agregar</a>
                        </li>
                    </ul>
                 @endcan
            </div>




            <div class="widget-content">

                @can('buscar_cita')

                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            @include('livewire.citas.estadosearch')
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <h6>Fecha cita</h6>
                            @include('livewire.citas.fechasearch')
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 align-self-center d-flex justify-content-around">
                        @if ($estado_id >0 || $fechasearch != null )
                            <button wire:click.prevent='Limpiar' type="button"
                            class="btn btn-dark">Limpiar filtros</button>
                        @endif

                    </div>
                </div>
                @endcan

                <div class="table-responsive">
                    <table class="table mt-1 table-bordered table-striped">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="text-white table-th">PACIENTE</th>
                                <th class="text-center text-white table-th">FECHA CITA</th>
                                <th class="text-center text-white table-th">HORA CITA</th>
                                <th class="text-center text-white table-th">TELÉFONO</th>
                                <th class="text-center text-white table-th">TRATAMIENTO</th>
                                <th class="text-center text-white table-th">SALDO CITA</th>
                                <th class="text-center text-white table-th">CITA</th>
                                {{-- <th class="text-center text-white table-th">IMÁGEN</th> --}}
                                <th class="text-center text-white table-th">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($citas) <1)
                                <tr><td colspan="7"><h4>No hay datos para mostrar</h4></td></tr>
                             @endif
                            @foreach ($citas as $c )
                                <tr>

                                        <td><h6>{{$c->paciente->nombre}}</h6></td>
                                        <td class="text-center"><h6>{{\Carbon\Carbon::parse($c->fecha_ini)->isoFormat('LL')}}</h6></td>
                                        <td class="text-center"><h6>{{\Carbon\Carbon::parse($c->fecha_ini)->format('H:i');}}</h6></td>
                                        <td class="text-center"><h6>{{$c->paciente->telefono}}</h6></td>
                                        <td class="text-center"><h6>{{$c->tratamiento->nombre}}  {{$c->tratamiento->precio}}</h6></td>
                                        {{-- <td class="text-center">
                                            <span class="badge {{$c->estado_pago == 'PAGADO' ? 'badge-success' : 'badge-danger'}} text-uppercase">
                                                {{$c->estado_pago}}
                                            </span>
                                        </td> --}}
                                        <td class="text-center">
                                            <span class="badge {{$c->saldo_cita == '0.00' ? 'badge-success' : 'badge-danger'}} text-uppercase">
                                                {{$c->saldo_cita}}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge {{$c->estado_id == '1' ? 'badge-success' : 'badge-danger'}} text-uppercase">
                                                {{$c->estado->nombre}}
                                            </span>

                                        </td>


                                    <td class="text-center">
                                        @can('editar_cita')
                                            <a href="javascript:void(0)"
                                            wire:click="edit({{$c->id}})"
                                            class="btn btn-dark mtmobile" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('eliminar_cita')
                                            @if ($c->total == '0.00')
                                            <a href="javascript:void(0)"
                                            onclick="Confirm('{{$c->id}}')"
                                            class="btn btn-dark " title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                            @endif
                                        @endcan

                                        {{-- si hay liquidaciones --}}
                                         @if ($c->liquidaciones->count() > 0)
                                            <a href="javascript:void(0)"
                                            wire:click="detalleLiquidaciones({{$c->id}})"
                                            class="btn btn-dark mtmobile" title="Liquidaciones">
                                                <i class="fas fa-list"></i>
                                            </a>
                                         @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$citas->links()}}
                </div>

            </div>

        </div>
        @endcan

    </div>

  @include('livewire.citas.form')
  @include('livewire.citas.detalleliquidaciones')

</div>


<script>

    document.addEventListener('DOMContentLoaded', function(){

        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: true,
            static: true,
            dateFormat: 'Y-m-d H:i',
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

        window.livewire.on('cita-added', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('cita-updated', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('user-updated', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('user-deleted', Msg =>{
           noty(Msg)
        })
        window.livewire.on('hide-modal', Msg =>{
            $('#theModal').modal('hide')


        })
        window.livewire.on('show-modal', Msg =>{
            $('#theModal').modal('show')
        })

        window.livewire.on('sin-resultados', Msg =>{
            noty(Msg)
        })
        window.livewire.on('cita-error', Msg =>{
            noty(Msg)
        })
        window.livewire.on('show-detail', Msg =>{
            $('#modalDetails').modal('show')
        })

    });

    function Confirm(id)
     {

         swal({
             title: 'CONFIRMAR',
             text: '¿ DESEA ELIMINAR EL REGISTRO ?',
             type: 'warning',
             showCancelButton: true,
             cancelButtonText: 'Cerrar',
             cancelButtonColor: '#fff',
             confirmButtonColor: '#3B3F5C',
             confirmButtonText: 'Aceptar'
         }).then(function(result){
             if(result.value)
             {
                 window.livewire.emit('deleteRow', id) //deleteRow va al listener del controller
                 swal.close()
             }
         })
     }

</script>
