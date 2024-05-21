@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Reintentar impresión si ocurre un error</h1>

            <p>Debido a que el plugin funciona con internet, pueden darse errores del servidor por alguna conexión. Por
                eso es que es posible que sea necesario reintentar la impresión</p>
            <strong>Se recomienda detener el plugin (y activarlo después de unas pruebas) para ver cómo se reintenta
                hasta que se logra imprimir</strong>
            <br>
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
                <input class="form-control" placeholder="Escribe el nombre de la impresora" type="text"
                       id="nombreImpresora">
            </div>
            <div class="form-group">
                <button class="btn btn-success" id="btnImprimir">Probar</button>
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
<script src="{{asset('assets/js/ConectorPlugin.js')}}"></script>
<script src="{{asset('assets/js/scriptImpresionV2/reintentar/script.js')}}"></script>

<!-- <script>
    const $estado = document.querySelector("#estado"),
    $nombreImpresora = document.querySelector("#nombreImpresora"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnImprimir = document.querySelector("#btnImprimir");


const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);


$btnImprimir.addEventListener("click", async () => {
    imprimirTicket();
});

/*
* Encerrar comportamiento en una función para volverla a llamar si algo va mal
* */
const imprimirTicket = () => {

    let nombreImpresora = $nombreImpresora.value;
    if (!nombreImpresora) return loguear("Escribe el nombre de la impresora");
    loguear("Intentando imprimir...");
    // Intentar imprimir
    const conector = new ConectorPlugin();
    conector.texto("Hola mundo\n");
    conector.imprimirEn(nombreImpresora)
        .then(respuestaAlImprimir => {
            if (respuestaAlImprimir === true) {
                loguear("Impreso correctamente");
            } else {
                loguear("Error. La respuesta es: " + respuestaAlImprimir);
                loguear("Error. Volviendo a imprimir...");
                // Volvemos a llamar a la función
                imprimirTicket();
            }
        })
        .catch(() => {
            // Error de conexión. Igualmente reintentamos
            loguear("Error. Volviendo a imprimir...");
            // Volvemos a llamar a la función
            imprimirTicket();
        });
};
</script> -->
@endpush

