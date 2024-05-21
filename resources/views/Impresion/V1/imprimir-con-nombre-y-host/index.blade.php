@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Imprimir indicando nombre de la impresora y el host en red</h1>
                    <p>En este ejemplo se muestra cómo imprimir indicando el
                        nombre de la impresora al momento de imprimir, en lugar
                        de siempre tomar la impresora predeterminada
                    </p>
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
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <input id="nombre" type="text" class="form-control"
                            placeholder="Nombre de impresora">
                    </div>
                    <div class="form-group">
                        <input id="ip" type="text" class="form-control"
                            placeholder="IP de la impresora">
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Mensaje" id="mensaje" cols="30"
                            rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="btnImprimir">Imprimir
                            en impresora seleccionada</button>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <h2>Log</h2>
                    <button class="btn btn-warning btn-sm" id="btnLimpiarLog">Limpiar
                        log</button>
                    <pre id="estado"></pre>
                </div>
            </div>
        </main>

@endsection
@push('script')
<script src="{{asset('assets/js/Impresora.js')}}"></script>
<script src="{{asset('assets/js/Impresora_ie11.js')}}"></script>
<script src="{{asset('assets/js/scriptImpresionV1/imprimir-con-nombre-y-host/script.js')}}"></script>
<!-- <script>
    const RUTA_API = "http://localhost:8000";
const $estado = document.querySelector("#estado"),
    $nombreImpresora = document.querySelector("#nombre"),
    $ipImpresora = document.querySelector("#ip"),
    $mensaje = document.querySelector("#mensaje"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnImprimir = document.querySelector("#btnImprimir");



const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);


$btnImprimir.addEventListener("click", () => {

    let nombreImpresora = $nombreImpresora.value
    mensaje = $mensaje.value,
    ip = $ipImpresora.value;
    if(!nombreImpresora || !mensaje || !ip) return;

    let impresora = new Impresora(RUTA_API);
    impresora.setFontSize(1, 1);
    impresora.write(`Tratando de imprimir en ${nombreImpresora} con host ${ip}
`);
    console.log(`Tratando de imprimir en ${nombreImpresora} con host ${ip}
`);
    impresora.write(mensaje);
    impresora.cut();
    impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial
    impresora.imprimirEnImpresoraConNombreEIp(nombreImpresora, ip)
        .then(valor => {
            loguear("Al imprimir: " + valor);
        });
});
</script> -->
@endpush
        