const form = document.getElementById("formPrimos");
const n1El = document.getElementById("n1");
const n2El = document.getElementById("n2");
const salida = document.getElementById("salida");
const btnLimpiar = document.getElementById("btnLimpiar");

function esEntero(n) {
  return Number.isFinite(n) && Number.isInteger(n);
}

function esPrimo(n) {
  if (n < 2) return false;
  if (n === 2) return true;
  if (n % 2 === 0) return false;

  // Comprobación hasta sqrt(n)
  const limite = Math.floor(Math.sqrt(n));
  for (let i = 3; i <= limite; i += 2) {
    if (n % i === 0) return false;
  }
  return true;
}

function primosEnRango(a, b) {
  let min = Math.min(a, b);
  let max = Math.max(a, b);

  const primos = [];
  for (let n = min; n <= max; n++) {
    if (esPrimo(n)) primos.push(n);
  }
  return { min, max, primos };
}

function setAlert(tipo, html) {
  salida.className = `alert alert-${tipo} mb-0`;
  salida.innerHTML = html;
}

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const n1 = Number(n1El.value);
  const n2 = Number(n2El.value);

  if (!esEntero(n1) || !esEntero(n2)) {
    setAlert("danger", "Por favor, introduce <strong>dos números enteros</strong> (sin decimales).");
    return;
  }

  const { min, max, primos } = primosEnRango(n1, n2);

  if (primos.length === 0) {
    setAlert("warning", `No hay números primos entre <strong>${min}</strong> y <strong>${max}</strong>.`);
    return;
  }

  setAlert(
    "success",
    `Los números primos entre <strong>${min}</strong> y <strong>${max}</strong> son:<br>
     <strong>${primos.join(", ")}</strong>`
  );
});

btnLimpiar.addEventListener("click", () => {
  n1El.value = "";
  n2El.value = "";
  setAlert("info", "Esperando datos…");
  n1El.focus();
});
