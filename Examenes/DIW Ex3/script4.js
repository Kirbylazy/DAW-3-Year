function mostrarDatos() {
  // Obtenemos cada input del formulario usando querySelector con su id
  const inputUsuario = document.querySelector("#inputUsuario");
  const inputNombre = document.querySelector("#inputNombre");
  const inputCorreo = document.querySelector("#inputCorreo");

  // Leemos el valor de cada campo con la propiedad .value
  const usuario = inputUsuario.value;
  const nombre = inputNombre.value;
  const correo = inputCorreo.value;

  // Validamos que se haya rellenado al menos un campo
  if (!usuario && !nombre && !correo) {
    document.getElementById("resultadoFormulario").innerHTML =
      '<div class="alert alert-warning">Por favor, rellena al menos un campo.</div>';
    return;
  }

  // Construimos el HTML con los datos introducidos y los mostramos en pantalla
  const html = `
    <div class="alert alert-info mt-3">
      <p class="fw-bold mb-2">Los datos introducidos son:</p>
      <p class="mb-1"><img src="images/usuario.png" alt="Usuario" style="height:20px;" class="me-2">Usuario: ${usuario}</p>
      <p class="mb-1"><img src="images/nombre.png" alt="Nombre" style="height:20px;" class="me-2">Nombre: ${nombre}</p>
      <p class="mb-0"><img src="images/correo.png" alt="Correo" style="height:20px;" class="me-2">Mail: <a href="mailto:${correo}">${correo}</a></p>
    </div>
  `;

  // Insertamos el resultado en el div correspondiente
  document.getElementById("resultadoFormulario").innerHTML = html;
}
