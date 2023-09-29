<div wire:ignore.self class="modal fade" id="theModalCitasPacientes" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-white">
              <b>AGENDAR</b>
          </h5>

        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-12 col-md-12" style="display: none">
                    <div class="form-group">
                        <label >PACIENTE</label>
                        <input type="number" wire:model="selected_id"  class="form-control">
                        @error('selected_id  ') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div wire:ignore class="mt-2 col-sm-6">
                    <h6>Fecha Inicio</h6>
                    <div class="form-group">
                        <input type="text" wire:model='fecha_ini'
                        class="form-control flatpickr"
                        placeholder="Click para elegir">
                    </div>
                </div>

                <div wire:ignore class="mt-2 col-sm-6">
                    <h6>Fecha Final</h6>
                    <div class="form-group">
                        <input type="text" wire:model='fecha_fin'
                        class="form-control flatpickr"
                        placeholder="Click para elegir">
                    </div>
                </div>

                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label >Descripción</label>
                        <input type="text" wire:model.lazy="descripcion" class="form-control" >
                        @error('descripcion') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>



                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label >Medico</label>
                        <select wire:model.lazy="medico_id" class="form-control">
                            <option value="Elegir" selected>Elegir</option>
                            @foreach ($medicos as $m )
                            <option value="{{ $m->id }}" >{{ $m->nombre }}</option>
                            @endforeach
                        </select>
                        @error('medico_id') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label >Receta</label>
                        <textarea wire:model.lazy='receta' class="form-control"  rows="3"></textarea>

                    </div>
                </div>


                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <form >
                            <div class="form-group">
                                <select wire:model="tratamiento_id" wire:change="updateValores" class="form-control">
                                    <option value="">Selecciona un tratamiento</option>
                                    @foreach ($tratamientos as $tratamiento)
                                        <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre }} - Costo: ${{ $tratamiento->precio }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                    @error('tratamiento_id') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label >VALOR PAGADO</label>
                            <input type="number" wire:model="totalcanceladocita" wire:change="updateValores" class="form-control">
                            @error('totalcanceladocita') <span class="text-danger er">{{ $message }}</span> @enderror
                        </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label >SALDO CITA</label>
                        <input type="text" wire:model.lazy="saldo_cita" class="form-control" readonly>
                        @error('saldo_cita') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label >Estado Cita</label>
                        <select wire:model.lazy="estado" class="form-control">
                            <option value="Elegir" selected>Elegir</option>
                            @foreach ($estados as $e)
                            <option value="{{ $e->id }}" >{{ $e->nombre }}</option>
                            @endforeach
                        </select>
                        @error('estado') <span class="text-danger er">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

        </div>
<div class="modal-footer">
    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info"
        data-dismiss="modal">
        CERRAR
    </button>


        <button type="button" wire:click.prevent="AgendarCita()" class="btn btn-dark close-modal">
            GUARDAR
        </button>


</div>
</div>
</div>
</div>





