<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg"  role="document">
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
                            <th class="table-th text-white text-center">CITA</th>
                            <th class="table-th text-white text-center">VALOR</th>
                            <th class="table-th text-white text-center">ESTADO</th>
                            <th class="table-th text-white text-center">MEDICO</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($citas as $c )
                         <tr>
                             <td class="text-center"><h6>{{\Carbon\Carbon::parse($c->fecha_ini)->isoFormat('LL')}}</h6></td>
                             <td><h6>{{$c->tratamiento->nombre}}</h6></td>
                             <td><h6>{{$c->estado->nombre}}</h6></td>
                             <td><h6>{{$c->tratamiento->precio}}</h6></td>
                             <td><h6>{{$c->pago->nombre}}</h6></td>
                             <td><h6>{{$c->medico->nombre}}</h6></td>
                             @if ($c->pago->nombre == 'PAGADO')
                                 <td hidden><h6>{{$total = $total+$c->tratamiento->precio }}</h6></td>
                             @elseif ($c->pago->nombre == 'PENDIENTE')
                                 <td hidden><h6>{{$pendiente = $pendiente+$c->tratamiento->precio }}</h6></td>
                             @endif
                         </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                         <tr>
                             <td colspan="2"><h5 class="text-center font-weight-bold"><span class="badge badge-success">CANCELADO:</span></h5></td>
                             <td><h5 class="text-center">{{$total}}</h5></td>

                         </tr>
                         <tr>
                             <td colspan="2"><h5 class="text-center font-weight-bold"><span class="badge badge-danger">PENDIENTE:</span></h5></td>
                             <td><h5 class="text-center">{{$pendiente}}</h5></td>

                         </tr>

                         <tr>
                             <td colspan="2"><h5 class="text-center font-weight-bold"><span class="badge badge-primary">TOTAL PACIENTE:</span></h5></td>
                             <td><h5 class="text-center">{{$total + $pendiente}}</h5></td>

                         </tr>
                     </tfoot>



                </table>

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
