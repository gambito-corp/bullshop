@extends('layouts.theme.app')
@section('content')
<script src="https://parzibyte.github.io/plugin-ticket-js/Impresora.js"></script>
@php
$time = \Carbon\Carbon::parse( $ticket->created_at )->toDayDateTimeString();
@endphp
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
        const arr = <?php echo json_encode($recibo); ?>;
        const precio = <?php echo json_encode($ticket); ?>;
        const nombre = "Vendedor: " + <?php echo json_encode(Auth::user()->name); ?>;
        const time = "Fecha de Venta: " + <?php echo json_encode($time); ?>;
        const moneda = <?php echo json_encode(env('MONEDA', 'S/. ')); ?>;




$btnImprimir.addEventListener("click", () => {
    console.log(arr);
            let impresora = new Impresora();
            impresora.setFontSize(1, 1);
            impresora.setEmphasize(0);
            impresora.setAlign("center");
            impresora.write("bullshop\n");
            impresora.write("bullshop place\n");
            impresora.write("Jr. Ica 820\n");
            impresora.write("Telefono: 938706453\n");
            impresora.write("bullshop.oficial@gmail.com\n");
            impresora.write("R.U.C. 10726343697\n");
            impresora.setEmphasize("1");
            impresora.setAlign("left");

            impresora.write(nombre);
            impresora.write(" \n");
            impresora.write(time);
            impresora.write(" \n");
            impresora.write("--------------------------------\n");
            arr.forEach(function(p){
                impresora.setAlign("left");
                impresora.write(parseInt(p.quantity) + ' - ' + p.producto.name + '  -  ');
                impresora.setAlign("right");
                impresora.write(p.price + moneda);
                impresora.write("\n");
            });
            impresora.write("--------------------------------\n");
            impresora.write("SUBTOTAL: " + precio.final + moneda);
            impresora.write("\n");
            impresora.write("DESCUENTO: " + precio.descuento + moneda);
            impresora.write("\n");
            impresora.write("TOTAL: " + precio.total + moneda);
            impresora.write("\n");
            impresora.write("PAGADO: " + precio.cash + moneda);
            impresora.write("\n");
            impresora.write("CAMBIO: " + precio.change + moneda);
            impresora.write("\n");
            impresora.write("--------------------------------\n");
            impresora.setAlign("center");
            impresora.write("***Gracias por su compra***");
            impresora.feed(1);
            impresora.barcode("123456", 80, "barcode128");
            impresora.cut();
            impresora.cutPartial(); // Pongo este y también cut porque en ocasiones no funciona con cut, solo con cutPartial
            impresora.cash();
            impresora.imprimirEnImpresora($listaDeImpresoras.value);
        });
        // En el init, obtenemos la lista
        obtenerListaDeImpresoras();
    </script>
   @endsection
