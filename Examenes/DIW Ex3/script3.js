// Función que calcula el importe final aplicando descuentos según importe y medio de pago
// Parámetros:
//   importe   - precio original del producto en euros
//   medioPago - C (crédito), E (efectivo), D (débito)
function facturacion(importe, medioPago) {
  // Porcentaje de descuento, por defecto sin descuento
  let descuento = 0;

  if (importe >= 200 && importe <= 400) {
    // Importe entre 200€ y 400€: descuento según medio de pago
    if (medioPago === "E") {
      descuento = 0.30; // Efectivo: 30% de descuento
    } else if (medioPago === "D") {
      descuento = 0.20; // Débito: 20% de descuento
    } else if (medioPago === "C") {
      descuento = 0.10; // Crédito: 10% de descuento
    }
  } else if (importe > 400) {
    // Importe mayor a 400€: siempre 40% de descuento sin importar el medio de pago
    descuento = 0.40;
  }
  // Si el importe es menor a 200€, descuento = 0 (sin descuento)

  // Devolvemos el importe con el descuento aplicado
  return importe - importe * descuento;
}

// Función que recoge los datos del formulario y muestra el resultado en pantalla
function calcularFactura() {
  // Obtenemos el importe introducido y lo convertimos a número decimal
  const importe = parseFloat(document.getElementById("inputImporte").value);

  // Obtenemos el medio de pago seleccionado en el select
  const medioPago = document.getElementById("selectPago").value;

  const resultadoDiv = document.getElementById("resultadoFactura");

  // Validamos que el importe sea un número positivo
  if (isNaN(importe) || importe < 0) {
    resultadoDiv.innerHTML = '<div class="alert alert-warning">Por favor, introduce un importe válido.</div>';
    return;
  }

  // Llamamos a la función facturacion() para obtener el importe final
  const importeFinal = facturacion(importe, medioPago);

  // Calculamos el valor del descuento en euros y su porcentaje
  const descuento = importe - importeFinal;
  const porcentaje = ((descuento / importe) * 100).toFixed(0);

  // Construimos el HTML del resultado
  let html = '<div class="alert alert-info mt-2">';
  html += `<p class="mb-1"><strong>Importe original:</strong> ${importe.toFixed(2)} €</p>`;
  if (descuento > 0) {
    // Si hay descuento, mostramos el porcentaje y el ahorro en euros
    html += `<p class="mb-1"><strong>Descuento aplicado:</strong> ${porcentaje}% (−${descuento.toFixed(2)} €)</p>`;
  } else {
    // Sin descuento (importe < 200€)
    html += `<p class="mb-1"><strong>Descuento aplicado:</strong> Sin descuento</p>`;
  }
  html += `<p class="mb-0 fw-bold">Importe final a abonar: ${importeFinal.toFixed(2)} €</p>`;
  html += "</div>";

  // Insertamos el resultado en el div correspondiente
  resultadoDiv.innerHTML = html;
}
