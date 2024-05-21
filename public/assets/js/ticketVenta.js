const $estado = document.querySelector("#estado"),
    $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
    $btnLimpiarLog = document.querySelector("#btnLimpiarLog"),
    $btnImprimir = document.querySelector("#btnImprimir");



const loguear = texto => $estado.textContent += (new Date()).toLocaleString() + " " + texto + "\n";
const limpiarLog = () => $estado.textContent = "";

$btnLimpiarLog.addEventListener("click", limpiarLog);


$btnImprimir.addEventListener("click", () => {
    let nombreImpresora = "XP80CNeg";
    if (!nombreImpresora) return loguear("Selecciona una impresora");
    let conector = new ConectorPlugin();
    conector.establecerTamanioFuente(1, 1);
    conector.establecerEnfatizado(0);
    conector.establecerJustificacion(ConectorPlugin.Constantes.AlineacionCentro);
    conector.imagenDesdeUrl("https://bullshop.com");
    conector.feed(1);
    conector.texto("La Mejor Tienda\n");
    conector.texto("BULLSHOP S.A.C.\n");
    conector.texto("DIRECCION DE PRUEBA\n");
    conector.texto("Telefono: 123456789\n");
    conector.texto("Fecha/Hora: 2021-02-08 16:57:55\n");
    conector.texto("--------------------------------\n");
    conector.texto("(bucle de productos))\n");
    conector.establecerJustificacion(ConectorPlugin.Constantes.AlineacionDerecha);
    conector.texto("S/. 25\n");
    conector.texto("(bucle de productos))\n");
    conector.establecerJustificacion(ConectorPlugin.Constantes.AlineacionDerecha);
    conector.texto("S/. 25\n");
    conector.texto("--------------------------------\n");
    conector.texto("SUB-TOTAL: S/. 25\n");
    conector.texto("DESCUENTO: S/. -5\n");
    conector.texto("TOTAL: S/. 20\n");
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

obtenerListaDeImpresoras();