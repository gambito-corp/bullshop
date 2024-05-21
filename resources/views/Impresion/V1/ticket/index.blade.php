@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Imprimir ticket de venta desde JavaScript usando plugin</h1>
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

                <h2>Ajustes de impresora</h2>
                <strong>Nombre de impresora seleccionada: </strong>
                <p id="impresoraSeleccionada"></p>
                <div class="form-group">
                    <select class="form-control" id="listaDeImpresoras"></select>
                </div>
                <button class="btn btn-primary btn-sm" id="btnRefrescarLista">Refrescar lista</button>
                <button class="btn btn-primary btn-sm" id="btnEstablecerImpresora">Establecer como predeterminada</button>
                <h2>Ticket de prueba</h2>
                <p>Utiliza el siguiente botón para imprimir un recibo de prueba en la impresora predeterminada:</p>
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
<script src="{{asset('assets/js/Impresora.js')}}"></script>
<script src="{{asset('assets/js/Impresora_ie11.js')}}"></script>
<script src="{{asset('assets/js/scriptImpresionV1/ticket/script.js')}}"></script>
<!-- <script>
    const RUTA_API = "http://localhost:8000"
const $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnRefrescarLista = document.querySelector("#btnRefrescarLista"),
    $btnEstablecerImpresora = document.querySelector("#btnEstablecerImpresora"),
    $texto = document.querySelector("#texto"),
    $impresoraSeleccionada = document.querySelector("#impresoraSeleccionada"),
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
            refrescarNombreDeImpresoraSeleccionada();
            loguear("Lista cargada");
            limpiarLista();
            listaDeImpresoras.forEach(nombreImpresora => {
                const option = document.createElement('option');
                option.value = option.text = nombreImpresora;
                $listaDeImpresoras.appendChild(option);
            })
        });
}

const establecerImpresoraComoPredeterminada = nombreImpresora => {
    loguear("Estableciendo impresora...");
    Impresora.setImpresora(nombreImpresora)
        .then(respuesta => {
            refrescarNombreDeImpresoraSeleccionada();
            if (respuesta) {
                loguear(`Impresora ${nombreImpresora} establecida correctamente`);
            } else {
                loguear(`No se pudo establecer la impresora con el nombre ${nombreImpresora}`);
            }
        });
};

const refrescarNombreDeImpresoraSeleccionada = () => {
    Impresora.getImpresora()
        .then(nombreImpresora => {
            $impresoraSeleccionada.textContent = nombreImpresora;
        });
}


$btnRefrescarLista.addEventListener("click", obtenerListaDeImpresoras);
$btnEstablecerImpresora.addEventListener("click", () => {
    const indice = $listaDeImpresoras.selectedIndex;
    if (indice === -1) return loguear("No hay ninguna impresora seleccionada")
    const opcionSeleccionada = $listaDeImpresoras.options[indice];
    establecerImpresoraComoPredeterminada(opcionSeleccionada.value);
});

$btnImprimir.addEventListener("click", () => {
    let impresora = new Impresora(RUTA_API);
    impresora.setFontSize(1, 1);
    impresora.setEmphasize(0);
    impresora.setAlign("center");
    impresora.write("Parzibyte's blog\n");
    impresora.write("Blog de un programador\n");
    impresora.write("Telefono: 123456789\n");
    impresora.write("Fecha/Hora: 2019-08-01 13:21:22\n");
    impresora.write("--------------------------------\n");
    impresora.write("Venta de plugin para impresora\n");
    impresora.setAlign("right");
    impresora.write("25 USD\n");
    impresora.write("--------------------------------\n");
    impresora.write("TOTAL: 25 USD\n");
    impresora.write("--------------------------------\n");
    impresora.setAlign("center");
    impresora.write("***Gracias por su compra***");
    impresora.cut();
    impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial
    impresora.end()
        .then(valor => {
            loguear("Al imprimir: " + valor);
        })
});

// En el init, obtenemos la lista
obtenerListaDeImpresoras();
// Y también la impresora seleccionada
refrescarNombreDeImpresoraSeleccionada();
</script> -->
@endpush
    
