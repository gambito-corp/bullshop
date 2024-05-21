<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle">
            <div class="card-body">
                @if ($total > 0)
                    <div class="table-responsive tblscroll" style="max-height: 650px; overflow:hidden">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #3b3f5c">
                                <tr>
                                    <th width="10%"></th>
                                    <th class="table-th text-left text-white">DESCRIPCIÓN</th>
                                    <th class="table-th text-center text-white">PRECIO</th>
                                    <th width="13%" class="table-th text-center text-white">CANT</th>
                                    <th class="table-th text-center text-white">IMPORTE</th>
                                    <th class="table-th text-center text-white">ACTIONS</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                
                                    <tr>
                                        <td class="text-center table-th">
                                            @if(count($item->attributes) > 0)
                                                <span>
                                                    <img src="{{ $item->attributes[0] }}"
                                                        alt="imagen de producto" height="90" width="90" class="rounded">
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <h6>{{ $item->name }}</h6>
                                        </td>
                                        <td class="text-center">
                                        @if($loop->iteration == 1)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado1 > 0)? $resultado1 : $item->price, 2)}}
                                        @elseif($loop->iteration == 2)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado2 > 0)? $resultado2 : $item->price, 2) }}
                                        @elseif($loop->iteration == 3)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado3 > 0)? $resultado3 : $item->price, 2) }}
                                        @elseif($loop->iteration == 4)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado4 > 0)? $resultado4 : $item->price, 2) }}
                                        @elseif($loop->iteration == 5)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado5 > 0)? $resultado5 : $item->price, 2) }}
                                        @elseif($loop->iteration == 6)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado6 > 0)? $resultado6 : $item->price, 2) }}
                                        @elseif($loop->iteration == 7)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado7 > 0)? $resultado7 : $item->price, 2) }}
                                        @elseif($loop->iteration == 8)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado8 > 0)? $resultado8 : $item->price, 2) }}
                                        @elseif($loop->iteration == 9)
                                            {{env('MONEDA', 'S/. ')}} {{ number_format(($resultado9 > 0)? $resultado9 : $item->price, 2) }}
                                        @else
                                            {{env('MONEDA', 'S/. ')}} {{ number_format($item->price, 2) }}
                                        @endif
                                            
                                        </td>
                                        <td>
                                            <input type="number" id="r{{ $item->id }}"
                                                wire:change="updateQty({{ $item->id }}, {{env('MONEDA', 'S/. ')}}('#r' +{{ $item->id }}).val() )"
                                                style="font-size: 1rem!important" class="form-control text-center"
                                                value="{{ $item->quantity }}">
                                        </td>
                                        <td class="text-center">
                                            <!-- <h6>
                                                {{env('MONEDA', 'S/. ')}}{{ number_format($item->price * $item->quantity, 2) }}
                                            </h6> -->
                                            <!-- <div class="input-group mb-3 mt-3"> -->
                                            @if($loop->iteration == 1)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto1}}" 
                                            wire:model="producto1"
                                            wire:keydown.enter="Descuento1({{$item}})">
                                            @elseif($loop->iteration == 2)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto2}}" 
                                            wire:model="producto2"
                                            wire:keydown.enter="Descuento2({{$item}})">
                                            @elseif($loop->iteration == 3)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto3}}" 
                                            wire:model="producto3"
                                            wire:keydown.enter="Descuento3({{$item}})">
                                            @elseif($loop->iteration == 4)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto4}}" 
                                            wire:model="producto4"
                                            wire:keydown.enter="Descuento4({{$item}})">
                                            @elseif($loop->iteration == 5)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto5}}" 
                                            wire:model="producto5"
                                            wire:keydown.enter="Descuento5({{$item}})">
                                            @elseif($loop->iteration == 6)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto6}}" 
                                            wire:model="producto6"
                                            wire:keydown.enter="Descuento6({{$item}})">
                                            @elseif($loop->iteration == 7)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto7}}" 
                                            wire:model="producto7"
                                            wire:keydown.enter="Descuento7({{$item}})">
                                            @elseif($loop->iteration == 8)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto8}}" 
                                            wire:model="producto8"
                                            wire:keydown.enter="Descuento8({{$item}})">
                                            @elseif($loop->iteration == 9)
                                            <input 
                                            name="descuento"
                                            type="text" 
                                            class="form-control" 
                                            çaria-label="" 
                                            aria-describedby="basic-addon1" 
                                            value="{{$producto9}}" 
                                            wire:model="producto9"
                                            wire:keydown.enter="Descuento9({{$item}})">
                                            @else
                                            @endif
                                            
                                            
                                            <!-- <div class="input-group-append">
                                                <button 
                                                class="btn btn-outline-secondary btn-sm" 
                                                type="button" 
                                                wire:click.prevent="Descuento()">
                                                    ok
                                                </button>
                                            </div>
                                        </div> -->

                                        </td>
                                        <td class="text-center">
                                            <button
                                                onclick="Confirm('{{$item->id}}','removeItem', '¿Confirmas Eliminar el Registro?')"

                                                class="btn btn-dark mbmobile">
                                                <i class="fas fa-trash-alt"> </i>
                                            </button>

                                            <button wire:click.prevent="decreaseQty({{ $item->id }})"
                                                class="btn btn-dark-mbmobile">
                                                <i class="fas fa-minus"> </i>
                                            </button>

                                            <button wire:click.prevent="increaseQty({{ $item->id }})"
                                                class="btn btn-dark-mbmobile">
                                                <i class="fas fa-plus"> </i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5 class="text-center text-muted">Agrega Productos a la Venta</h5>
                @endif

                <div wire:loading.inline wire:target="saveSale">
                    <h4 class="text-danger text-center">Guardando Venta...</h4>
                </div>

            </div>

        </div>
    </div>
</div>
