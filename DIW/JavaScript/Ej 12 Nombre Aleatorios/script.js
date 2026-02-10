document.addEventListener("DOMContentLoaded", () => {
  const nameInput = document.getElementById("nameInput");
  const addBtn = document.getElementById("addBtn");
  const pickBtn = document.getElementById("pickBtn");
  const namesList = document.getElementById("namesList");
  const msg = document.getElementById("msg");

  // Lista en memoria (requisito del ejercicio)
  let nombres = [];
  let selectedIndex = null;

  function setMessage(text, type = "secondary") {
    msg.className = `alert alert-${type} text-center mb-3`;
    msg.textContent = text;
  }

  // Función para renderizar el <ul> desde la lista en memoria
  function renderNames() {
    namesList.innerHTML = "";

    nombres.forEach((nombre, i) => {
      const li = document.createElement("li");
      li.className = "name-item";

      // Resaltado del seleccionado
      if (i === selectedIndex) li.classList.add("selected");

      li.textContent = nombre;
      namesList.appendChild(li);
    });
  }

  // Botón Agregar
  function addName() {
    const value = nameInput.value.trim();

    if (value === "") {
      setMessage("Escribe un nombre antes de agregar.", "warning");
      return;
    }

    nombres.push(value);
    selectedIndex = null; // al añadir, quitamos selección previa
    renderNames();

    nameInput.value = "";
    nameInput.focus();
    setMessage(`Nombre agregado: ${value}`, "success");
  }

  // Botón Seleccionar aleatoriamente
  function pickRandom() {
    if (nombres.length === 0) {
      setMessage("No hay nombres en la lista. Agrega alguno primero.", "danger");
      return;
    }

    selectedIndex = Math.floor(Math.random() * nombres.length);
    renderNames();

    const elegido = nombres[selectedIndex];
    setMessage(`Se ha elegido: ${elegido}`, "info");
  }

  addBtn.addEventListener("click", addName);
  pickBtn.addEventListener("click", pickRandom);

  // (Extra útil DIW) Enter para añadir
  nameInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") addName();
  });
});
