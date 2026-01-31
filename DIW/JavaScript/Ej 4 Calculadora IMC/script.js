const alturaInput = document.getElementById("altura");
const pesoInput = document.getElementById("peso");
const resultado = document.getElementById("resultado");
const boton = document.getElementById("btnCalcular");

function categoriaIMC(imc){
  if(imc < 18.5) return "Bajo peso";
  if(imc < 25) return "Normal";
  if(imc < 30) return "Sobrepeso";
}

boton.addEventListener("click", () => {
  const altura = Number(alturaInput.value);
  const peso = Number(pesoInput.value);

  const alturaMetros = altura / 100;
  const imc = peso / (alturaMetros ** 2);

  resultado.innerHTML = `Tu IMC es <strong>${imc.toFixed(1)}</strong> (${categoriaIMC(imc)})`;
});
