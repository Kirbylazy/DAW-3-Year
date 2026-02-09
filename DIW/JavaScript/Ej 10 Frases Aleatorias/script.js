document.addEventListener("DOMContentLoaded", () => {

  // Array de frases
  const frasesFrikisInformatica = [
    "Algoritmo: frase utilizada por los programadores cuando no quieren explicar lo que han hecho.",
    "La programación es como un rompecabezas: ensamblas piezas de código para formar una imagen completa.",
    "Hay 10 tipos de personas: las que entienden binario y las que no.",
    "Primero resuelve el problema. Después, escribe el código."
  ];

  // Array de colores
  const colores = [
    "#ff0000", "#00ff00", "#0000ff", "#ff00ff", "#00ffff",
    "#ff8000", "#8000ff", "#00ff80", "#ff0080", "#80ff00"
  ];

  const boton = document.getElementById("texto-informatica");
  const fraseBox = document.getElementById("fraseBox");

  boton.addEventListener("click", () => {

    // Elegir frase aleatoria
    const indiceFrase = Math.floor(Math.random() * frasesFrikisInformatica.length);
    fraseBox.textContent = frasesFrikisInformatica[indiceFrase];

    // Elegir color aleatorio
    const indiceColor = Math.floor(Math.random() * colores.length);
    const color = colores[indiceColor];

    // Aplicar colores
    fraseBox.style.color = color;
    boton.style.backgroundColor = color;
    boton.style.borderColor = color;

  });

});
