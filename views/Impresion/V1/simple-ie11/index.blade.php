@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Demostrar capacidades de plugin de impresión</h1>
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
                <h2>Capacidades</h2>
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
<script src="{{asset('assets/js/scriptImpresionV1/simple-ie11/script.js')}}"></script>
<!-- <script>
    
"use strict";

var RUTA_API = "http://localhost:8000";
var $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnRefrescarLista = document.querySelector("#btnRefrescarLista"),
    $btnEstablecerImpresora = document.querySelector("#btnEstablecerImpresora"),
    $texto = document.querySelector("#texto"),
    $impresoraSeleccionada = document.querySelector("#impresoraSeleccionada"),
    $btnImprimir = document.querySelector("#btnImprimir");

var loguear = function loguear(texto) {
  return $estado.textContent += new Date().toLocaleString() + " " + texto + "\n";
};

var limpiarLog = function limpiarLog() {
  return $estado.textContent = "";
};

$btnLimpiarLog.addEventListener("click", limpiarLog);

var limpiarLista = function limpiarLista() {
  for (var i = $listaDeImpresoras.options.length; i >= 0; i--) {
    $listaDeImpresoras.remove(i);
  }
};

var obtenerListaDeImpresoras = function obtenerListaDeImpresoras() {
  loguear("Cargando lista...");
  Impresora.getImpresoras(function (listaDeImpresoras) {
    refrescarNombreDeImpresoraSeleccionada();
    loguear("Lista cargada");
    limpiarLista();
    listaDeImpresoras.forEach(function (nombreImpresora) {
      var option = document.createElement('option');
      option.value = option.text = nombreImpresora;
      $listaDeImpresoras.appendChild(option);
    });
  });
};

var establecerImpresoraComoPredeterminada = function establecerImpresoraComoPredeterminada(nombreImpresora) {
  loguear("Estableciendo impresora...");
  Impresora.setImpresora(nombreImpresora, function (respuesta) {
    refrescarNombreDeImpresoraSeleccionada();

    if (respuesta) {
      loguear("Impresora ".concat(nombreImpresora, " establecida correctamente"));
    } else {
      loguear("No se pudo establecer la impresora con el nombre ".concat(nombreImpresora));
    }
  });
};

var refrescarNombreDeImpresoraSeleccionada = function refrescarNombreDeImpresoraSeleccionada() {
  Impresora.getImpresora(function (nombreImpresora) {
    $impresoraSeleccionada.textContent = nombreImpresora;
  });
};

$btnRefrescarLista.addEventListener("click", obtenerListaDeImpresoras);
$btnEstablecerImpresora.addEventListener("click", function () {
  var indice = $listaDeImpresoras.selectedIndex;
  if (indice === -1) return loguear("No hay ninguna impresora seleccionada");
  var opcionSeleccionada = $listaDeImpresoras.options[indice];
  establecerImpresoraComoPredeterminada(opcionSeleccionada.value);
});
$btnImprimir.addEventListener("click", function () {
  var impresora = new Impresora(RUTA_API);
  impresora.setFontSize(1, 1);
  impresora.write("Fuente 1,1\n");
  impresora.setFontSize(1, 2);
  impresora.write("Fuente 1,2\n");
  impresora.setFontSize(2, 2);
  impresora.write("Fuente 2,2\n");
  impresora.setFontSize(2, 1);
  impresora.write("Fuente 2,1\n");
  impresora.setFontSize(1, 1);
  impresora.setEmphasize(1);
  impresora.write("Emphasize 1\n");
  impresora.setEmphasize(0);
  impresora.write("Emphasize 0\n");
  impresora.setAlign("center");
  impresora.write("Centrado\n");
  impresora.setAlign("left");
  impresora.write("Izquierda\n");
  impresora.setAlign("right");
  impresora.write("Derecha\n");
  impresora.setFont("A");
  impresora.write("Fuente A\n");
  impresora.setFont("B");
  impresora.write("Fuente B\n");
  impresora.feed(2);
  impresora.write("Separado por 2\n");
  impresora.cut();
  impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial

  impresora.end(function (valor) {
    loguear("Al imprimir: " + valor);
  });
}); // En el init, obtenemos la lista

obtenerListaDeImpresoras(); // Y también la impresora seleccionada

refrescarNombreDeImpresoraSeleccionada();
</script> -->
@endpush
    
