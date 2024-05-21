<div class="row mt-3">
    <div class="col-sm-12">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">DENOMINACIONES</h5>
            <div class="container">
                <div class="row">
                    <div class="col-sm mt-2">
                        <div class="input-group">
                            <input type="text" 
                                class="form-control"
                                value=""
                                wire:model.lazy="montoMedio"
                                aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                @if($montoMedio > 0)
                                <button 
                                    class="btn btn-outline-secondary dropdown-toggle"
                                    type="button" 
                                    data-toggle="dropdown" 
                                    aria-haspopup="true"
                                     aria-expanded="false">
                                        Medio de Pago
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" type="button" 
                                    wire:click.prevent="ACash('Yape', {{ $montoMedio}})">
                                        Yape
                                    </button>
                                    <button class="dropdown-item" type="button" 
                                    wire:click.prevent="ACash('Plim', {{ $montoMedio}})">
                                        Plim
                                    </button>
                                    <button class="dropdown-item" type="button" 
                                    wire:click.prevent="ACash('Transferencia', {{ $montoMedio}})">
                                        Transferencia
                                    </button>
                                    <button class="dropdown-item" type="button" 
                                    wire:click.prevent="ACash('Tarjeta', {{ $montoMedio}})">
                                        Tarjeta
                                    </button>
                                    <button class="dropdown-item" type="button" 
                                    wire:click.prevent="ACash('Efectivo', {{ $montoMedio}})">
                                        Efectivo
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>

            <div class="connect-sorting-content mt-4">
                <div class="card-simple-title-task ui-sortable-handle">
                    <div class="card-body">
                        <h4 class="text-muted">Cambio: {{env('MONEDA', 'S/. ')}}{{ number_format($change, 2) }}</h4>
                        <div class="input-group input-group-md mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp hideonsm"
                                    style="background: #3b3f5c; color:white">EFECTIVO F8
                                </span>
                            </div>

                            <input type="number" id="cash" wire:model="efectivo" wire:keydown.enter="saveSale"
                                class="form-control text-center" value="{{ $efectivo }}">
                            <div class="input-group-append">
                                <span wire:click="clearEfecty" class="input-group-text"
                                    style="background: #3b3f5c; color:white">
                                    <i class="fas fa-backspace fa-2x"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="row justify-content-between mt-5">
                            <div class="col sm-12 col-md-12 col-lg-6">
                                @if ($total > 0)

                                    <button onclick="Confirm('','clearCart','¿Seguro De Eliminar El Carrito?')"
                                        class="btn btn-dark mtmobile">
                                        CANCELAR F4
                                    </button>
                                @endif
                            </div>
                            <div class="col sm-12 col-md-12 col-lg-6">
                                @if ($efectivo >= $total && $total > 0)
                                    <button wire:click.prevent="saveSale({{$cart}})" class="btn btn-dark btn-md btn-block">
                                        GUARDAR F9
                                    </button>
                                @endif
                                
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
