const form = document.getElementById("form");
const importeEl = document.getElementById("importe");
const porcentajeEl = document.getElementById("porcentaje");
const salida = document.getElementById("salida");

function eur(n){
  return new Intl.NumberFormat("es-ES", { style: "currency", currency: "EUR" }).format(n);
}

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const importe = Number(importeEl.value);
  const descuento = Number(porcentajeEl.value);
  const ahorro = importe * (descuento / 100);
  const final = importe - ahorro;

  salida.innerHTML = `
    <div class="alert alert-success mb-0">
      <div><strong>Importe inicial:</strong> ${eur(importe)}</div>
      <div><strong>Descuento:</strong> ${descuento.toFixed(2)}%</div>
      <div><strong>Ahorro:</strong> ${eur(ahorro)}</div>
      <hr class="my-2">
      <div class="fs-5"><strong>Total final:</strong> ${eur(final)}</div>
    </div>
  `;
});
