@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Imprimir ticket de venta desde JavaScript usando plugin</h1>
            <p>Ejemplo de impresión de un ticket de venta</p>
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
        <!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <select class="form-control" id="listaDeImpresoras"></select>
            </div>
            <h2>Ticket de prueba</h2>
            <button class="btn btn-success" id="btnImprimir">Imprimir ticket</button>
        </div>
        <div class="col-12 col-lg-6">
            <h2>Log</h2>
            <button class="btn btn-warning btn-sm" id="btnLimpiarLog">Limpiar log</button>
            <pre id="estado"></pre>
        </div>
    </div>
</main>

@endsection
@push('script')
<script src="{{asset('assets/js/ConectorPlugin.js')}}"></script>
<script src="{{asset('assets/js/scriptImpresionV2/ticket/script.js')}}"></script>
<!-- <script>
    const $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnImprimir = document.querySelector("#btnImprimir");


const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);


const obtenerListaDeImpresoras = () => {
    loguear("Cargando lista...");
    ConectorPlugin.obtenerImpresoras()
        .then(listaDeImpresoras => {
            loguear("Lista cargada");
            listaDeImpresoras.forEach(nombreImpresora => {
                const option = document.createElement('option');
                option.value = option.text = nombreImpresora;
                $listaDeImpresoras.appendChild(option);
            })
        })
        .catch(() => {
            loguear("Error obteniendo impresoras. Asegúrese de que el plugin se está ejecutando");
        });
}


$btnImprimir.addEventListener("click", () => {
    let nombreImpresora = $listaDeImpresoras.value;
    if (!nombreImpresora) return loguear("Selecciona una impresora");
    let conector = new ConectorPlugin();
    conector.establecerTamanioFuente(1, 1);
    conector.establecerEnfatizado(0);
    conector.establecerJustificacion(ConectorPlugin.Constantes.AlineacionCentro);
    conector.imagenDesdeUrl("https://github.com/parzibyte.png");
    conector.feed(1);
    conector.texto("Parzibyte's blog\n");
    conector.texto("Blog de un programador\n");
    conector.texto("Telefono: 123456789\n");
    conector.texto("Fecha/Hora: 2021-02-08 16:57:55\n");
    conector.texto("--------------------------------\n");
    conector.texto("Venta de plugin para impresora\n");
    conector.establecerJustificacion(ConectorPlugin.Constantes.AlineacionDerecha);
    conector.texto("25 USD\n");
    conector.texto("--------------------------------\n");
    conector.texto("TOTAL: 25 USD\n");
    conector.texto("--------------------------------\n");
    conector.establecerJustificacion(ConectorPlugin.Constantes.AlineacionCentro);
    conector.texto("***Gracias por su compra***");
    conector.feed(4);
    conector.cortar();
    conector.cortarParcialmente();
    conector.imprimirEn(nombreImpresora)
        .then(respuestaAlImprimir => {
            if (respuestaAlImprimir === true) {
                loguear("Impreso correctamente");
            } else {
                loguear("Error. La respuesta es: " + respuestaAlImprimir);
            }
        });
});

// En el init, obtenemos la lista
obtenerListaDeImpresoras();

</script> -->
@endpush
