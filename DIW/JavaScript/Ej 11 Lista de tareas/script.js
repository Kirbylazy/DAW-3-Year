document.addEventListener("DOMContentLoaded", () => {

  const inputTask = document.getElementById("newTask");
  const addTaskBtn = document.getElementById("addTaskBtn");
  const taskList = document.getElementById("taskList");

  function addTask() {
    const taskText = inputTask.value.trim();

    // Verificar que no esté vacío
    if (taskText === "") return;

    // Crear elemento li
    const li = document.createElement("li");
    li.className = "task-item";
    li.textContent = taskText;

    // Crear botón eliminar
    const deleteBtn = document.createElement("button");
    deleteBtn.textContent = "X";
    deleteBtn.className = "btn btn-danger btn-sm deleteBtn";

    // Evento eliminar
    deleteBtn.addEventListener("click", () => {
      li.remove();
    });

    // Agregar botón al li
    li.appendChild(deleteBtn);

    // Agregar li a la lista
    taskList.appendChild(li);

    // Limpiar input
    inputTask.value = "";
    inputTask.focus();
  }

  // Evento del botón
  addTaskBtn.addEventListener("click", addTask);

});
