<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-xl"  role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="text-white modal-title">
              <b>historial de citas  </b>
          </h5>
          <h6 class="text-center text warning" wire:loading>POR FAVOR ESPERE</h6>
        </div>
        <div class="modal-body">

            @if(count($citas) <1)
                 <tr><td colspan="7"><h4>El paciente no registra citas médicas</h4></td></tr>
            @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3B3F5C">
                        <tr>
                            <th class="table-th text-white text-center">FECHA</th>
                            <th class="table-th text-white text-center">TRATAMIENTO</th>
                            <th class="table-th text-white text-center">ESTADO CITA</th>
                            <th class="table-th text-white text-center">PRECIO</th>
                            <th class="table-th text-white text-center">PAGADO</th>
                            <th class="table-th text-white text-center">SALDO</th>
                            <th class="table-th text-white text-center">MEDICO</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($citas as $c )
                         <tr>

                             <td class="text-center"><h6>{{\Carbon\Carbon::parse($c->fecha_ini)->isoFormat('LL')}}</h6></td>
                             <td><h6>{{$c->tratamiento->nombre}}</h6></td>
                             <td><h6>{{$c->estado->nombre}}</h6></td>
                             <td><h6>{{$c->precio_tratamiento}}</h6></td>
                             <td><h6>{{$c->total}}</h6></td>
                             <td><h6>{{$c->saldo_cita}}</h6></td>
                             <td><h6>{{$c->medico->nombre}}</h6></td>
                             <td hidden><h6>{{$idpaciente = $c->paciente->id }}</h6></td>

                                 <td hidden><h6>{{$total = $total+$c->total }}</h6></td>
                                 <td hidden><h6>{{$pendiente = $pendiente+$c->saldo_cita }}</h6></td>

                         </tr>
                        @endforeach
                         <br>
                         <a class="btn btn-dark "
                             href="{{ url('detpaciente' . '/'.$idpaciente) }}"  target="_blank">
                             Imprimir Historial
                        </a>
                     </tbody>


                     <tfoot>
                         <tr>
                             <td colspan="2"><h5 class="text-center font-weight-bold"><span class="badge badge-success">PAGADO</span></h5></td>
                             <td><h5 class="text-center">{{$total}}</h5></td>
                         </tr>
                         <tr>
                             <td colspan="2"><h5 class="text-center font-weight-bold"><span class="badge badge-danger">DEUDA</span></h5></td>
                             <td><h5 class="text-center">{{$pendiente}}</h5></td>
                         </tr>

                         <tr>
                             <td colspan="2"><h5 class="text-center font-weight-bold"><span class="badge badge-primary">TOTAL PACIENTE</span></h5></td>
                             <td><h5 class="text-center">{{$total + $pendiente}}</h5></td>

                         </tr>



                     </tfoot>
                </table>
                <hr class="hr hr-blurry" />

                <div style="border-bottom: 1px solid #cccccc;"></div> <!-- Divisor con borde inferior -->




                <div class="table-responsive">
                    <table class="table mt-1 table-bordered table-striped">
                        <h4 class="card-title text-center"><b>Saldos pendientes en procedimientos</b></h4>
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="text-white table-th text-center">NOMBRE</th>
                                <th class="text-white table-th text-center">SALDO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($saldosprocedimientos as $sp )
                                <tr>
                                    @if ($sp['nombre'] == 'NA')
                                    <td hidden  class="text-center"><h6>{{$sp['nombre']}}</h6></td>
                                    <td hidden class="text-center"><h6>{{$sp['saldo']}}</h6></td>
                                    @else
                                    <td class="text-center"><h6>{{$sp['nombre']}}</h6></td>
                                    <td class="text-center"><h6>{{$sp['saldo']}}</h6></td>
                                    @endif

                                    {{-- <td hidden><h6>{{$sumExtras = $sumExtras+$pe->monto }}</h6></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tfoot class="p-3 mb-2 bg-white text-dark">
                            <tr>
                                <th>
                                    <h4 class="">Aportes:  {{$sumExtras}} </h4>
                                </th>
                            </tr>
                        </tfoot> --}}
                    </table>

                </div>

                {{-- @if ($pendiente < $sumExtras)
                    @php
                        $saldoPendiente = $sumExtras - $pendiente
                    @endphp
                @else
                    @php
                        $saldoPendiente = $pendiente - $sumExtras
                     @endphp
                @endif


                @if ($sumExtras < $pendiente )
                    <h5>Saldo pendiente: {{ $saldoPendiente}}</h5>
                @endif  --}}


            </div>
            @endif



        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark close-btn text-info"
                data-dismiss="modal">
                CERRAR
            </button>


        </div>

    </div>
    </div>
</div>
