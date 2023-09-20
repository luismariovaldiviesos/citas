<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg"  role="document">
      <div class="modal-content">
            <div class="modal-header bg-dark">
            <h5 class="text-white modal-title">
                <b>historial de liquidaciones  </b>
            </h5>
            <h6 class="text-center text warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                        <table class="table mt-1 table-bordered table-striped">
                            <thead class="text-white" style="background: #3B3F5C">
                                <tr>
                                    <th class="text-white table-th text-center">DESCRIPCION DEL PAGO</th>
                                    <th class="text-white table-th text-center">FECHA DEL PAGO</th>
                                    <th class="text-white table-th text-center">MONTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liquidaciones as $l )
                            <tr>

                                <td class="text-center"><h6>{{($l->observaciones)}}</h6></td>
                                <td class="text-center"><h6>{{\Carbon\Carbon::parse($l->created_at)->isoFormat('LL')}}</h6></td>
                                <td class="text-center"><h6>{{($l->monto_liquidado)}}</h6></td>
                                {{-- <td><h6>{{$c->estado->nombre}}</h6></td>
                                <td><h6>{{$c->tratamiento->precio}}</h6></td>
                                <td><h6>{{$c->estado_pago}}</h6></td>
                                <td><h6>{{$c->medico->nombre}}</h6></td>
                                <td hidden><h6>{{$idpaciente = $c->paciente->id }}</h6></td> --}}

                            </tr>
                            @endforeach
                            </tbody>
                            {{-- <tfoot class="p-3 mb-2 bg-white text-dark">
                                <tr>
                                    <th>
                                        <h4 class="">Aportes:  {{}} </h4>
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
                    @endif --}}

                    {{--
                    @if ($sumExtras < $pendiente )
                        <h5>Saldo pendiente: {{ $saldoPendiente}}</h5>
                    @else ()
                    <h5>Saldo a favor: {{ $saldoPendiente}}</h5>
                    @endif --}}









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
