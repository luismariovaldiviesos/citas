@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label >Paciente</label>
            <div class="form-group">
                <input type="text" wire:model="paciente" class="form-control" disabled >
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >PRECIO TRATAMIENTO</label>
            <input type="number" wire:model="precio_tratamiento" class="form-control" readonly >
            @error('precio_tratamiento') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >VALOR PAGADO</label>
            <input type="number" wire:model="total_pagado" class="form-control" readonly >
            @error('total_pagado') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >SALDO CITA</label>
            <input type="text" wire:model.lazy="saldo_pendiente" class="form-control" readonly>
            @error('saldo_pendiente') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >VALOR A PAGAR</label>
            <input type="text" wire:model.lazy="nuevo_pago" class="form-control" >
            @error('nuevo_pago') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >OBSERVACIONES</label>
            <textarea wire:model.lazy='observaciones' class="form-control"  rows="3"></textarea>
            @error('observaciones') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>



</div>

@include('common.modalFooter')





