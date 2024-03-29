
<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        @can('ver_liquidacion')

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName}} | {{$pageTitle}}</b>
                </h4>
                {{-- @can('crear_liquidacion')
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-success" data-toggle="modal"
                            data-target="#theModal">Agregar</a>
                        </li>
                    </ul>
                 @endcan --}}
            </div>




            <div class="widget-content">

                @can('buscar_liquidacion')


                    @include('common.searchbox')

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
                                <th class="text-center text-white table-th">cancelado</th>
                                <th class="text-center text-white table-th">SALDO CITA</th>
                                <th class="text-center text-white table-th">CITA</th>
                                {{-- <th class="text-center text-white table-th">IMÁGEN</th> --}}
                                <th class="text-center text-white table-th">LIQUIDAR SALDOS</th>
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
                                        <td class="text-center "><span class="badge badge-info">  {{$c->total}}</span></td>

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
                                        @can('editar_liquidacion')
                                            <a href="javascript:void(0)"
                                            wire:click="edit({{$c->id}})"
                                            class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        {{-- @can('eliminar_liquidacion')
                                        @if ($c->saldo_cita != '0.00')
                                        <a href="javascript:void(0)"
                                        onclick="Confirm('{{$c->id}}')"
                                        class="btn btn-dark " title="Delete">
                                          <i class="fas fa-trash"></i>
                                        </a>
                                        @endif

                                        @endcan --}}


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

    @include('livewire.liquidaciones.form')

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
