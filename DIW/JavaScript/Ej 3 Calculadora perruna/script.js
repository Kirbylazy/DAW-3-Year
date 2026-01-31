console.log("script.js cargado ✅");

document.addEventListener("DOMContentLoaded", () => {

  // 1. Obtener el botón
  const botonCalcular = document.getElementById("btnCalcular");

  // 2. Cuando el usuario haga click en el botón
  botonCalcular.addEventListener("click", () => {

    // 3. Leer los valores de los inputs (son texto)
    const anos = document.getElementById("anos").value;

    // 4. Convertir los valores a número
    // Si el campo está vacío, se convierte en 0
    const anosH = Number(anos) || 0;

    // 5. Calcular el coste total
    const anosP =
      anosH * 7;

    // 6. Buscar el mensaje dentro de la misma sección
    const section = botonCalcular.closest("section");
    const mensaje = section.querySelector(".msg-evento");

    // 7. Mostrar el mensaje
    mensaje.className = "alert alert-secondary msg-evento";
    mensaje.textContent = `El perro tiene ${anosP} años perrunos`;
    mensaje.classList.remove("d-none");
  });

});
