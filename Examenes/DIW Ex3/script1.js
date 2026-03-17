// Contraseña correcta guardada en memoria
const claveCorrecta = "abc123";

// Contador de intentos fallidos
let intentos = 0;

// Número máximo de intentos permitidos
const maxIntentos = 3;

function comprobarClave() {
  // Obtenemos el campo de contraseña y el div de mensajes del HTML
  const inputClave = document.getElementById("inputClave");
  const mensaje = document.getElementById("mensaje");

  // Leemos el valor introducido por el usuario
  const clave = inputClave.value;

  // Si ya se agotaron los intentos, no hacemos nada
  if (intentos >= maxIntentos) return;

  if (clave === claveCorrecta) {
    // Contraseña correcta: mostramos mensaje de éxito y bloqueamos el formulario
    mensaje.innerHTML = '<div class="alert alert-success">✅ ¡Correcto! Puedes empezar a disfrutar el software.</div>';
    inputClave.disabled = true;
    document.querySelector("button").disabled = true;
  } else {
    // Contraseña incorrecta: incrementamos el contador de intentos
    intentos++;

    if (intentos >= maxIntentos) {
      // Se han agotado los 3 intentos: clave bloqueada (se muestra la imagen del candado)
      mensaje.innerHTML = '<div class="alert alert-danger"><img src="images/candado.png" alt="Candado" style="height:24px;" class="me-2">Clave bloqueada. Has agotado los 3 intentos.</div>';
      inputClave.disabled = true;
      document.querySelector("button").disabled = true;
    } else {
      // Aún quedan intentos: informamos al usuario de los intentos restantes
      mensaje.innerHTML = `<div class="alert alert-warning">❌ Contraseña incorrecta. Te quedan ${maxIntentos - intentos} intento(s).</div>`;
    }
  }

  // Limpiamos el campo de contraseña tras cada intento
  inputClave.value = "";
}
