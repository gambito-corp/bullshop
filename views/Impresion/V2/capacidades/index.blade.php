@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Capacidades del plugin</h1>
            <p>Demostrar varias cosas que puede hacer este conector de impresoras térmicas con JavaScript</p>
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
                <select class="form-control" id="listaDeImpresoras"></select>
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
<script src="{{asset('assets/js/scriptImpresionV2/capacidades/script.js')}}"></script>
<!-- <script>
    const $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnImprimir = document.querySelector("#btnImprimir");

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

const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);


$btnImprimir.addEventListener("click", async () => {
    let nombreImpresora = $listaDeImpresoras.value;
    if (!nombreImpresora) return loguear("Selecciona una impresora");
    const conector = new ConectorPlugin()
        .texto("Texto de la impresora. Un feed de 3:\n")
        .feed(3)
        .establecerEnfatizado(1)
        .texto("Texto con emphasize en 1\n")
        .establecerEnfatizado(0)
        .texto("Texto con emphasize en 0\n")
        .establecerFuente(ConectorPlugin.Constantes.FuenteA)
        .texto("Fuente A\n")
        .establecerFuente(ConectorPlugin.Constantes.FuenteB)
        .texto("Fuente B\n")
        .establecerFuente(ConectorPlugin.Constantes.FuenteC)
        .texto("Fuente C\n")
        .establecerJustificacion(ConectorPlugin.Constantes.AlineacionCentro)
        .texto("Alineado al centro\n")
        .establecerJustificacion(ConectorPlugin.Constantes.AlineacionIzquierda)
        .texto("Alineado a la izquierda\n")
        .establecerJustificacion(ConectorPlugin.Constantes.AlineacionDerecha)
        .texto("Alineado a la derecha\n")
        .establecerTamanioFuente(1, 1)
        .establecerJustificacion(ConectorPlugin.Constantes.AlineacionIzquierda); // <- Aquí dejamos de encadenar los métodos, puedes encadenarlos o llamar a la misma operación en cada paso
    // Nota: El tamaño máximo es 8,8 pero no lo pongo porque consume demasiado papel. Para la demostración solo pongo hasta el 3
    for (let i = 1; i <= 3; i++) {
        conector.establecerTamanioFuente(i, i)
            .texto(`Texto con size ${i},${i}\n`);
    }
    conector
        .feed(1)
        .establecerTamanioFuente(1, 1)
        .texto("Un QR nativo (a veces no funciona):\n")
        .qr("Soy un código QR | https://parzibyte.me/blog")
        .feed(1)
        .textoConAcentos("Un código de barras:\n")
        .codigoDeBarras("123", ConectorPlugin.Constantes.AccionBarcode39)
        .feed(1)
        .texto("Un QR como imagen en el centro (funciona la mayoría de veces):\n")
        .establecerJustificacion(ConectorPlugin.Constantes.AlineacionCentro)
        .qrComoImagen("Parzibyte")
        .establecerTamanioFuente(1, 1)
        .texto("¿Cuál es el avatar de Parzibyte en GitHub?\n")
        .imagenDesdeUrl("https://github.com/parzibyte.png")
        .abrirCajon() // Abrir cajón de dinero. Opcional
        .cortar() // Cortar
    // impresora.cutPartial(); // Cortar parcialmente (opcional)
    // Recomiendo dejar un feed de 4 al final de toda impresión
    conector.feed(4)
    const respuestaAlImprimir = await conector.imprimirEn(nombreImpresora);
    if (respuestaAlImprimir === true) {
        loguear("Impreso correctamente");
    } else {
        loguear("Error. La respuesta es: " + respuestaAlImprimir);
    }
});

obtenerListaDeImpresoras();
</script> -->
@endpush

