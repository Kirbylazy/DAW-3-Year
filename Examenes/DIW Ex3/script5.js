// Función que se ejecuta cada vez que el usuario pulsa el botón "Tirar dados"
function tirarDados() {
  // Esta formula la he tenido que buscar en internet por que javascript 
  // no tiene una forma sencilla de tratar con numeros ni con arrays
  const resultado = Math.floor(Math.random() * 6) + 1;

  // actualizamos el mensaje con el número obtenido
  document.getElementById("mensajeDado").textContent = `¡Ha salido un ${resultado}!`;
}
