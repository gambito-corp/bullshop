<div class="row sales layout-top-spacing">


    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <!--Encabezado-->
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="{{Route('sembrarC')}}" class="tabmenu bg-dark">Actualizar Categorias</a>
                        <a href="{{Route('sembrarP')}}" class="tabmenu bg-dark">Actualizar Stock</a>
                        <a href="{{Route('WR')}}" class="tabmenu bg-dark">Ejecutar Worker</a>
                    </li>
                    <li>
                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="ID en Wordpress press enter" aria-label="" aria-describedby="basic-addon1" value="" wire:model.lazy="Forzar">
                            <div class="input-group-append">
                                @if($this->Forzar != null)
                                <button class="btn btn-outline-secondary" type="button" wire:click.prevent="ForzarActualizado()">
                                    Forzar Actualizado
                                </button>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul> 
            </div>
            @can('Product_Search')
                @include('common.searchbox')
            @endcan
            <!--Contenido de la targeta (cardbody)-->
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background:#3b3f5c">

                            <tr>
                                {{-- name
                                description
                                price
                                stock_quantity
                                marca
                                image --}}
                                <th class="table-th text-white text-center">ID - WP</th>
                                <th class="table-th text-white text-center">Código de Barras</th>
                                <th class="table-th text-white text-center">Nombre</th>
                                <th class="table-th text-white text-center">Precio de Costo</th>
                                <th class="table-th text-white text-center">Categoria</th>
                                <th class="table-th text-white text-center">Precio</th>
                                <th class="table-th text-white text-center">Stock</th>
                                <th class="table-th text-white text-center">Marca</th>
                                <th class="table-th text-white text-center">Imagen</th>
                                <th class="table-th text-white text-center">ACCIÓN</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($data as $product)                                
                            <tr>
                                <td class="text-center">
                                    <h6>{{ $product->wp_id }}</h6>
                                </td>
                                <td class=" text-center">
                                    <h6>{{ $product->barcode }}</h6>
                                    </td>
                                    
                                    <td>
                                        <h6 class="text-left">{{ $product->name }}</h6>
                                    </td>
                                    @can('User_Create')
                                        @if ($product->costo == 0)
                                            <td class="tex-center">
                                                {{-- <div x-data="{ show: false }">
                                                    <button 
                                                        class="btn btn-outline-secondary" 
                                                        type="button" 
                                                        x-on:click="show = !show" 
                                                        x-text="!show ? 'Agregar Costo' : 'Aceptar Costo'"
                                                    >
                                                        
                                                    </button> 

                                                    <input 
                                                        x-show="show"
                                                        name="Costo"
                                                        type="text" 
                                                        class="form-control" 
                                                        aria-label="" 
                                                        aria-describedby="basic-addon1" 
                                                        Value=""
                                                        wire:model.lazy="" 
                                                        wire:keydown.enter="asignarCosto({{$product}})"
                                                    >
                                                </div> --}}
                                                <h6>{{env('MONEDA', 'S/.') . $product->costo }}</h6>
                                            </td>
                                        @else
                                            <td class="tex-center">
                                                {{-- <div x-data="{ show: false }">
                                                    <button 
                                                        class="btn btn-outline-secondary" 
                                                        type="button" 
                                                        x-on:click="show = !show" 
                                                        x-text="!show ? 'Agregar Costo' : 'Aceptar Costo'"
                                                    >
                                                        
                                                    </button> 

                                                    <input 
                                                        x-show="show"
                                                        name="Costo"
                                                        type="text" 
                                                        class="form-control" 
                                                        aria-label="" 
                                                        aria-describedby="basic-addon1" 
                                                        Value=""
                                                        wire:model.lazy="" 
                                                        wire:keydown.enter="asignarCosto({{$product}})"
                                                    >
                                                </div>
                                            --}}
                                                <h6>{{env('MONEDA', 'S/.') . $product->costo }}</h6>
                                            </td>
                                        @endif
                                    @else
                                    <td>0</td>
                                    @endcan

                                    <td class="text-center">
                                        <h6>{{ $product->category }}</h6>
                                    </td>

                                    <td class="text-center">
                                        <h6>{{env('MONEDA', 'S/. ') . $product->price }}</h6>
                                    </td>
                                    
                                    <td class="text-center">
                                        <h6>{{ $product->stock }}</h6>
                                    </td>
                                    
                                    <td class="text-center">
                                        <h6>{{ $product->marca }}</h6>
                                    </td>
                                    
                                    <td class="text-center">
                                        <span>
                                            <img src="{{$product->Imagen}}"
                                                height="70" width="80" class="rounded" alt="imagen de ejemplo"
                                                class="rounded">
                                        </span>
                                    </td>
                                    
                                    <td class="text-center">
                                        {{-- @can('Product_Update')
                                            <a href="javascript:void(0)" wire:click.prevent="Edit({{ $product->id }})"
                                                class="btn btn-dark mtmobile" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('Product_Destroy')
                                            <a href="javascript:void(0)" class="btn btn-dark" title="Delete"
                                                onclick="confirm('{{ $product->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endcan --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if($product->stock > 0)
                                                    <button wire:click.prevent="ScanCode('{{ $product->barcode }}')"
                                                        class="btn btn-dark">
                                                        <i class="fas fa-shopping-cart"> </i>
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <a 
                                                    href="{{route('imagen', ['id'=>$product->barcode])}}"
                                                    class="btn btn-dark" alt="Imprimir Codigo de Barras">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('livewire.products.form')
    @include('livewire.products.impresion')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('CB', Msg => {
            $('#cb').modal('show')
            noty(Msg)
        });
    //     window.livewire.on('product-delete', Msg => {
    //         noty(Msg)
    //     });
    //     window.livewire.on('product-added', Msg => {
    //         $('#theModal').modal('hide')
    //         noty(Msg)
    //     });
    //     window.livewire.on('product-updated', Msg => {
    //         $('#theModal').modal('hide')
    //         noty(Msg)
    //     });
    //     window.livewire.on('modal-show', Msg => {
    //         $('#theModal').modal('show')
    //     });
    //     window.livewire.on('modal-hide', Msg => {
    //         $('#theModal').modal('hide')
    //     });
    //     window.livewire.on('hidden.bs.modal', Msg => {
    //         $('.er').css('display', 'none')
    //     });

    });



    // function confirm(id) {
    //     swal({
    //         title: 'CONFIRMAR',
    //         text: '¿CONFIRMAS QUE DESEAS ELIMINAR EL REGISTRO?',
    //         type: 'warning',
    //         showCancelButton: true,
    //         cancelButtonText: 'Cerrar',
    //         cancelButtonColor: '#fff',
    //         confirmButtonText: 'Aceptar',
    //         confirmButtonColor: '#3B3F5C',
    //     }).then(function(result) {
    //         if (result.value) {
    //             window.livewire.emit('deleteRow', id)
    //             Swal.fire(
    //                 'Borrado',
    //                 'El Registro ha sido Borrado.',
    //                 'success'
    //             )
    //         }
    //     })
    // }
</script>