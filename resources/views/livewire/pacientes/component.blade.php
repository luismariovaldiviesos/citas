
<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            @can('ver_paciente')
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName}} registrados: {{$pacientes}} | {{$pageTitle}}</b>
                </h4>

                @can('crear_paciente')
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                         data-target="#theModal">Agregar</a>

                    </li>
                </ul>
                @endcan


            </div>
            @can('buscar_paciente')
             @include('common.searchbox')
            @endcan

            @include('livewire.pacientes.detallepaciente')

            <div class="widget-content">

                <div class="table-responsive">
                    <table class="table mt-1 table-bordered table-striped">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="text-white table-th">NOMBRE</th>
                                <th class="text-center text-white table-th">TELÉFONO</th>
                                <th class="text-center text-white table-th">EMAIL</th>
                                <th class="text-center text-white table-th">PROCEDIMIENTOS</th>
                                <th class="text-center text-white table-th">DIRECCION</th>
                                <th class="text-center text-white table-th">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $paciente )

                                  <tr>
                                    <td><h6>{{$paciente->nombre}}</h6></td>
                                    <td class="text-center"><h6>{{$paciente->telefono}}</h6></td>
                                    <td class="text-center"><h6>{{$paciente->email}}</h6></td>
                                    {{-- <td class="text-center">
                                        <span>
                                            <img src="{{ asset('storage/pacientes/' . $r->imagen ) }}" alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                        </span>
                                     </td> --}}

                                    <td class="text-center">
                                            @foreach ($paciente->citas->unique('tratamiento.procedimiento.id')  as $cita )
                                            <h6>
                                                @if ($cita->tratamiento)
                                                 {{ $cita->tratamiento->procedimiento->nombre }}
                                                @else

                                            @endif
                                            </h6>
                                            @endforeach

                                    </td>
                                    <td class="text-center"><h6>{{$paciente->direccion}}</h6></td>



                                    <td class="text-center">

                                        @can('crear_cita')


                                                {{-- <a href="javascript:void(0)" class="btn btn-dark mtmobile" data-toggle="modal"
                                                data-target="#theModalCitasPacientes">Agendar</a> --}}

                                                <a href="javascript:void(0)"
                                        wire:click="agendar({{$paciente->id}})"
                                        class="btn btn-dark mtmobile">Agendar</a>

                                        @endcan

                                       @can('editar_paciente')
                                        <a href="javascript:void(0)"
                                        wire:click="edit({{$paciente->id}})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                       @endcan

                                        @can('detalle_paciente')
                                        <a href="javascript:void(0)"
                                        wire:click="detallePaciente({{$paciente->id}})"
                                        class="btn btn-dark mtmobile" title="Detalle">
                                            <i class="fas fa-list"></i>
                                        </a>
                                        @endcan

                                        @can('eliminar_paciente')
                                            <a href="javascript:void(0)"
                                            onclick="Confirm({{$paciente->id}} ,  {{ $paciente->citas->count() }})"
                                            class="btn btn-dark " title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>

            </div>
            @endcan

        </div>

    </div>

  @include('livewire.pacientes.form')
  @include('livewire.pacientes.formcitas')


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










        window.livewire.on('paciente-added', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('paciente-updated', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('paciente-deleted', Msg =>{
           noty(Msg)
        })
        window.livewire.on('hide-modal', Msg =>{
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg =>{
            $('#theModal').modal('show')
        })
        window.livewire.on('show-modal-', Msg =>{
            $('#theModalCitasPacientes').modal('show')
        })

        window.livewire.on('show-detail', Msg =>{
            $('#modalDetails').modal('show')
        })
        window.livewire.on('cita-error', Msg =>{
            noty(Msg)
        })
        window.livewire.on('cita-added', Msg =>{
            $('#theModalCitasPacientes').modal('hide')
            noty(Msg)
        })

    });

    function Confirm(id, citas)
     {
         if(citas > 0)
         {
            swal('NO SE PUEDE ELIMINAR EL PACIENTE, TIENE CITAS ASIGNADAS')
             return ;
         }

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
