// Función pedida en el enunciado: alterna la visibilidad del #box
function toggleBox() {
  const box = document.getElementById("box");
  const btn = document.getElementById("toggleBtn");

  // Si está oculto, lo mostramos; si está visible, lo ocultamos.
  if (box.style.display === "none") {
    box.style.display = "block";
    btn.textContent = "Ocultar Caja";
  } else {
    box.style.display = "none";
    btn.textContent = "Mostrar Caja";
  }
}

// Evento: al hacer clic en el botón, llama a toggleBox
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("toggleBtn");
  btn.addEventListener("click", toggleBox);
});
