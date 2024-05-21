@extends('layouts.theme.app')
@section('content')
<main role="main" class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Obtener impresoras remotas</h1>
                    <p>A partir de la IP de otra PC que ejecuta el plugin de impresión, obtener la lista de impresoras</p>
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
                        <input id="ip" type="text" class="form-control"
                            placeholder="IP de la computadora">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="btnObtenerImpresoras">Obtener impresoras</button>
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
<script src="{{asset('assets/js/scriptImpresionV1/obtener-impresoras-remotas/script.js')}}"></script>
<!-- <script>
    const RUTA_API = "http://localhost:8000";
const $estado = document.querySelector("#estado"),
    $nombreImpresora = document.querySelector("#nombre"),
    $ipImpresora = document.querySelector("#ip"),
    $mensaje = document.querySelector("#mensaje"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnObtenerImpresoras = document.querySelector("#btnObtenerImpresoras");



const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);


$btnObtenerImpresoras.addEventListener("click", () => {

    let ip = $ipImpresora.value;
    if (!ip) return;
    Impresora.getImpresorasRemotas(ip)
        .then(impresoras => {
            impresoras.forEach(impresora => {
                loguear(`Encontré una impresora: ${impresora}`);
            });
        });
});
</script> -->
@endpush
        
