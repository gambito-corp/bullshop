@include('common.modalHead')
<script src="https://parzibyte.github.io/plugin-ticket-js/Impresora.js"></script>
        <div class="py-2">
            <div class="select">
                <select name="listaDeImpresoras" id="listaDeImpresoras"></select>
            </div>
            <button id="btnImprimir" class="button is-success">Imprimir</button>
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
            impresora.write("Fecha 2019-08-01 13:21:22\n");
            impresora.write("vendedor : (Nombre del Vendedor)\n");
            impresora.write("--------------------------------\n");

            impresora.write("VENTA DE (PRODUCTO HACER BUCLE)\n");
            impresora.setAlign("right");
            impresora.write("25 USD\n");
            impresora.write("VENTA DE (PRODUCTO HACER BUCLE)\n");
            impresora.setAlign("right");
            impresora.write("25 USD\n");
            impresora.write("VENTA DE (PRODUCTO HACER BUCLE)\n");
            impresora.setAlign("right");
            impresora.write("25 USD\n");
            impresora.write("VENTA DE (PRODUCTO HACER BUCLE)\n");
            impresora.setAlign("right");
            impresora.write("25 USD\n");
            impresora.write("--------------------------------\n");
            impresora.write("SUBTOTAL: 100 USD\n");
            impresora.write("DESCUENTO: 5 USD\n");
            impresora.write("TOTAL: 95 USD\n");
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
  </div>
    <div class="modal-footer">
        <button  type="button"  class="btn btn-dark close-btn text-info" data-dismiss="modal">CERRAR SIN VENDER</button>
        <button  type="button" wire:click.prevent="saveSale()" class="btn btn-dark close-modal" >VENDER SIN IMPRIMIR</button>
      </div>
    </div>
  </div>
</div>