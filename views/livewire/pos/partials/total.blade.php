<div class="row">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting">
                <h5 class="text-center mb-3">RESUMEN DE VENTA</h5>

                <div class="connect-sorting-content">
                    <div class="card simple-title-task ui-sortable-handle">
                        <div class="card-body">
                            <div class="task-header">
                                <div>
                                    <h2>TOTAL: {{env('MONEDA', 'S/. ')}}{{ number_format($total, 2) }}</h2>
                                    <div class="form-group">
                                        {{-- <input type="text" data-type='currency' value="{{env('MONEDA', 'S/. ')}}{{ number_format($total, 2) }}" wire:model.lazy="total" class="form-control" id="hiddenTotal"> --}}
                                        
                                        <div class="input-group mb-3 mt-3">
                                            <input type="text" class="form-control" placeholder="Documento" aria-label="" aria-describedby="basic-addon1" value="" wire:model.lazy="dni">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" wire:click.prevent="guardarCliente()">
                                                    Validar
                                                </button>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control mt-2" id="inline-form-razonSocial"
                                                placeholder="Razon Social / Nombre"  value="" wire:model.lazy="nombre">
                                        
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mt-3">Articulos: {{ $itemsQuantity }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
