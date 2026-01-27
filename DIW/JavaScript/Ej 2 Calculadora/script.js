console.log("script.js cargado ✅");

document.addEventListener("DOMContentLoaded", () => {

  // 1. Obtener el botón
  const botonCalcular = document.getElementById("btnCalcular");

  // 2. Cuando el usuario haga click en el botón
  botonCalcular.addEventListener("click", () => {

    // 3. Leer los valores de los inputs (son texto)
    const alojamiento = document.getElementById("alojamiento").value;
    const alimentacion = document.getElementById("alimentacion").value;
    const entretenimiento = document.getElementById("entretenimiento").value;

    // 4. Convertir los valores a número
    // Si el campo está vacío, se convierte en 0
    const gastoAlojamiento = Number(alojamiento) || 0;
    const gastoAlimentacion = Number(alimentacion) || 0;
    const gastoEntretenimiento = Number(entretenimiento) || 0;

    // 5. Calcular el coste total
    const total =
      gastoAlojamiento +
      gastoAlimentacion +
      gastoEntretenimiento;

    // 6. Buscar el mensaje dentro de la misma sección
    const section = botonCalcular.closest("section");
    const mensaje = section.querySelector(".msg-evento");

    // 7. Mostrar el mensaje
    mensaje.className = "alert alert-secondary msg-evento";
    mensaje.textContent = `El coste total del viaje es ${total} €`;
    mensaje.classList.remove("d-none");
  });

});
