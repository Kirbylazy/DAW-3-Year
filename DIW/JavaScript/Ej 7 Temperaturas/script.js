const form = document.getElementById("form");
const tipoEl = document.getElementById("tipo");
const tempEl = document.getElementById("temp");
const salida = document.getElementById("salida");
const btnBorrar = document.getElementById("btnBorrar");
const unidadEntrada = document.getElementById("unidadEntrada");

// Funciones de conversión (requisito del ejercicio)
function celsiusAFahrenheit(c) {
  return (c * 9/5) + 32;
}

function fahrenheitACelsius(f) {
  return (f - 32) * 5/9;
}

function setAlert(tipo, html) {
  salida.className = `alert alert-${tipo} mb-0`;
  salida.innerHTML = html;
}

function actualizarUnidad() {
  unidadEntrada.textContent = (tipoEl.value === "C2F") ? "°C" : "°F";
}

tipoEl.addEventListener("change", actualizarUnidad);
actualizarUnidad();

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const valor = Number(tempEl.value);
  if (!Number.isFinite(valor)) {
    setAlert("danger", "Introduce una temperatura válida.");
    return;
  }

  if (tipoEl.value === "C2F") {
    const f = celsiusAFahrenheit(valor);
    setAlert(
      "success",
      `${valor} grados Celsius equivalen a <strong>${f.toFixed(2)}</strong> grados Fahrenheit.`
    );
  } else {
    const c = fahrenheitACelsius(valor);
    setAlert(
      "success",
      `${valor} grados Fahrenheit equivalen a <strong>${c.toFixed(2)}</strong> grados Celsius.`
    );
  }
});

btnBorrar.addEventListener("click", () => {
  tempEl.value = "";
  tipoEl.value = "C2F";
  actualizarUnidad();
  setAlert("info", "Esperando datos…");
  tempEl.focus();
});
