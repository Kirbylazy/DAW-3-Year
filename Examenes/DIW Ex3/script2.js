function mostrarTabla() {
  // Obtenemos el input del número y el div donde mostrar el resultado
  const inputNumero = document.getElementById("inputNumero");
  const resultado = document.getElementById("resultado");

  // Convertimos el valor del input a número entero
  const numero = parseInt(inputNumero.value);

  // Validamos que sea un número válido
  if (isNaN(numero)) {
    resultado.innerHTML = '<div class="alert alert-warning">Por favor, introduce un número válido.</div>';
    return;
  }

  // Construimos la tabla de multiplicar del 1 al 10
  let html = '<div class="p-3 bg-white border rounded">';
  for (let i = 1; i <= 10; i++) {
    // Cada línea: número x i = resultado
    html += `<p class="mb-1">${numero} x ${i} = ${numero * i}</p>`;
  }
  html += "</div>";

  // Insertamos la tabla generada en el div de resultado
  resultado.innerHTML = html;
}
