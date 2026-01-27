function showLocalMessage(button, text, type) {
  // Buscamos el mensaje DENTRO de la misma sección
  const section = button.closest("section");
  const msg = section.querySelector(".msg-evento");

  msg.className = `alert alert-${type} msg-evento`;
  msg.textContent = text;
  msg.classList.remove("d-none");

  clearTimeout(msg._t);
  msg._t = setTimeout(() => msg.classList.add("d-none"), 3000);
}

function add(id, eventName, text, type) {
  const el = document.getElementById(id);

  el.addEventListener(eventName, () =>
    showLocalMessage(el, text, type)
  );
}

document.addEventListener("DOMContentLoaded", () => {
  add("btnClick", "click", "Evento: click", "primary");
  add("btnDblClick", "dblclick", "Evento: dblclick", "info");
  add("btnMouseDown", "mousedown", "Evento: mousedown", "warning");
  add("btnMouseUp", "mouseup", "Evento: mouseup", "success");
  add("btnMouseEnter", "mouseenter", "Evento: mouseenter", "secondary");
  add("btnMouseLeave", "mouseleave", "Evento: mouseleave", "danger");
});
