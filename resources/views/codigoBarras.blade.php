@extends('layouts.theme.app')
@section('content')
<script src="https://parzibyte.github.io/plugin-ticket-js/Impresora.js"></script>

        <div class="py-2">
            <div class="select">
                <select name="listaDeImpresoras" id="listaDeImpresoras">

                </select>
            </div>
            <button id="btnImprimir" class="btn btn-success">Imprimir Ticket</button>
        </div>


    <script>
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $btnImprimir = document.querySelector("#btnImprimir");


        const obtenerListaDeImpresoras = () => {
            console.log("Cargando lista...");
            Impresora.getImpresoras()
                .then(listaDeImpresoras => {
                    console.log("Lista cargada");
                    listaDeImpresoras.forEach(nombreImpresora => {
                        const option = document.createElement('option');
                        option.value = option.text = nombreImpresora;
                        $listaDeImpresoras.appendChild(option);
                    })
                });
        }

$btnImprimir.addEventListener("click", () => {
    console.log(arr);
            let impresora = new Impresora();
            impresora.feed(3);
            impresora.barcode("DUNKJL-11", 350, "barcode128");
            impresora.feed(3);
            impresora.cut();
            impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial
            impresora.cash();
            impresora.imprimirEnImpresora($listaDeImpresoras.value);
        });
        // En el init, obtenemos la lista
        obtenerListaDeImpresoras();
    </script>
   @endsection