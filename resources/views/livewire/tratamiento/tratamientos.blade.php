<div class="row sales layout-top-spacing">

    <div class="col-sm-12">

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                         data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">

                <div class="table-reponsive">
                    <table class="table mt-1 table-bordered table-striped">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="text-white table-th">NOMBRE</th>
                                <th class="text-white table-th">PRECIO</th>
                                <th class="text-white table-th">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tratamientos as $tratamiento)
                                <tr>
                                    <td><h6>{{$tratamiento->nombre}}</h6></td>
                                    <td><h6> $ {{$tratamiento->precio}}</h6></td>
                                    {{-- <td class="text-center">
                                        <span>
                                            <img src="" alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                        </span>
                                    </td> --}}
                                    <td>
                                        <a href="javascript:void(0)"
                                        wire:click="Edit({{$tratamiento->id}})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                        onClick="Confirm()"
                                        class="btn btn-dark " title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Pagination
                </div>

            </div>

        </div>

    </div>

    @include('livewire.tratamiento.form')

</div>


<script>

    document.addEventListener('DOMContentLoaded', function(){

    });

</script>
