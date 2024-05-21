@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Códigos QR en thermal printer</h1>
            <p>En este ejemplo se muestra cómo imprimir un código QR en una ticketera</p>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Impresion Version 1
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('v1.1')}}">Ejemplo 'v1.1'</a>
                    <a class="dropdown-item" href="{{route('v1.2')}}">Ejemplo 'v1.2'</a>
                    <a class="dropdown-item" href="{{route('v1.3')}}">Ejemplo 'v1.3'</a>
                    <a class="dropdown-item" href="{{route('v1.4')}}">Ejemplo 'v1.4'</a>
                    <a class="dropdown-item" href="{{route('v1.5')}}">Ejemplo 'v1.5'</a>
                    <a class="dropdown-item" href="{{route('v1.6')}}">Ejemplo 'v1.6'</a>
                    <a class="dropdown-item" href="{{route('v1.7')}}">Ejemplo 'v1.7'</a>
                    <a class="dropdown-item" href="{{route('v1.8')}}">Ejemplo 'v1.8'</a>
                    <a class="dropdown-item" href="{{route('v1.9')}}">Ejemplo 'v1.9'</a>
                    <a class="dropdown-item" href="{{route('v1.10')}}">Ejemplo 'v1.10'</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Impresion Version 2
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('v2.1')}}">Ejemplo 'v2.1'</a>
                    <a class="dropdown-item" href="{{route('v2.2')}}">Ejemplo 'v2.2'</a>
                    <a class="dropdown-item" href="{{route('v2.3')}}">Ejemplo 'v2.3'</a>
                    <a class="dropdown-item" href="{{route('v2.4')}}">Ejemplo 'v2.4'</a>
                    <a class="dropdown-item" href="{{route('v2.5')}}">Ejemplo 'v2.5'</a>
                    <a class="dropdown-item" href="{{route('v2.6')}}">Ejemplo 'v2.6'</a>
                    <a class="dropdown-item" href="{{route('v2.7')}}">Ejemplo 'v2.7'</a>
                </div>
            </div>
            <div class="alert alert-danger">Recuerda que el plugin debe estar ejecutándose en segundo plano</div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="listaDeImpresoras">Selecciona tu impresora</label>
                <select class="form-control" id="listaDeImpresoras"></select>
            </div>
            <div class="form-group">
                <label for="codigo">Contenido del código QR</label>
                <textarea placeholder="Escribe el contenido del código QR" id="codigo" cols="30"
                          rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success" id="btnImprimir">Imprimir
                    en impresora seleccionada
                </button>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <h2>Log</h2>
            <button class="btn btn-warning btn-sm" id="btnLimpiarLog">Limpiar
                log
            </button>
            <pre id="estado"></pre>
        </div>
    </div>
</main>

@endsection
@push('script')
<script src="{{asset('assets/js/Impresora.js')}}"></script>
<script src="{{asset('assets/js/Impresora_ie11.js')}}"></script>
<script src="{{asset('assets/js/scriptImpresionV1/qr/script.js')}}"></script>
<!-- <script>
    const $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $codigo = document.querySelector("#codigo"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnImprimir = document.querySelector("#btnImprimir");
const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);
const limpiarLista = () => {
    for (let i = $listaDeImpresoras.options.length; i >= 0; i--) {
        $listaDeImpresoras.remove(i);
    }
};
const obtenerListaDeImpresoras = () => {
    loguear("Cargando lista...");
    Impresora.getImpresoras()
        .then(listaDeImpresoras => {
            loguear("Lista cargada");
            limpiarLista();
            listaDeImpresoras.forEach(nombreImpresora => {
                const option = document.createElement('option');
                option.value = option.text = nombreImpresora;
                $listaDeImpresoras.appendChild(option);
            })
        });
};
obtenerListaDeImpresoras();
/*
* La magia sucede a continuación
* */
$btnImprimir.addEventListener("click", () => {
    // Recuperar el QR
    let contenido = $codigo.value;
    // Validar
    if (!contenido) {
        return alert("Escribe el contenido del QR");
    }
    // Ahora la impresora
    let impresoraSeleccionada = $listaDeImpresoras.options[$listaDeImpresoras.selectedIndex].value;
    if (!impresoraSeleccionada) {
        return alert("Selecciona una impresora")
    }
    // Si está bien se ejecuta esto...
    let impresora = new Impresora();
    impresora.qr(contenido);
    // Dos saltos de línea
    impresora.feed(2);
    // Terminar en la impresora seleccionada
    loguear("Imprimiendo...");
    impresora.imprimirEnImpresora(impresoraSeleccionada)
        .then(respuesta => {
            loguear("Al imprimir el código QR tenemos: " + respuesta);
        })
});
</script> -->
@endpush
