document.addEventListener("DOMContentLoaded", () => {
  const video = document.getElementById("video");
  const musica = document.getElementById("musica");

  const msg = document.getElementById("msg");
  const volValue = document.getElementById("volValue");

  const btnPlayPause = document.getElementById("btnPlayPause");
  const btnReiniciar = document.getElementById("btnReiniciar");
  const btnRetrasar = document.getElementById("btnRetrasar");
  const btnAdelantar = document.getElementById("btnAdelantar");
  const btnSilenciar = document.getElementById("btnSilenciar");
  const btnMenosVolumen = document.getElementById("btnMenosVolumen");
  const btnMasVolumen = document.getElementById("btnMasVolumen");

  // ---- Estado inicial (el “audio del vídeo” es musica) ----
  musica.volume = 1.0;
  updateVolumeBadge();
  updatePlayPauseText();
  updateMuteText();

  function setMessage(text, type = "secondary") {
    msg.className = `alert alert-${type} text-center mb-4`;
    msg.textContent = text;
  }

  function clamp(n, min, max) {
    return Math.min(max, Math.max(min, n));
  }

  function updatePlayPauseText() {
    btnPlayPause.textContent = video.paused ? "Play" : "Pause";
  }

  function updateMuteText() {
    btnSilenciar.textContent = musica.muted ? "Escuchar" : "Silenciar";
  }

  function updateVolumeBadge() {
    volValue.textContent = musica.volume.toFixed(1);
  }

  // Pone el audio exactamente en el mismo tiempo que el vídeo (si ya hay metadata)
  function syncAudioToVideo() {
    try {
      musica.currentTime = video.currentTime;
    } catch (_) {
      // Si aún no está listo (metadata), lo ignoramos: se sincroniza al cargar o al siguiente seek/play
    }
  }

  // Reproducir ambos como si fueran uno
  async function playBoth() {
    syncAudioToVideo();

    await video.play(); // si falla, lanza excepción (raro tras click)
    try {
      await musica.play(); // puede fallar si el navegador bloquea audio, pero normalmente con click va bien
    } catch (_) {
      // Si se bloquea, al menos el vídeo se reproduce; el usuario deberá interactuar de nuevo
    }

    updatePlayPauseText();
  }

  function pauseBoth() {
    video.pause();
    musica.pause();
    updatePlayPauseText();
  }

  // Cambiar tiempo en ambos (mantener sincronía)
  function setBothTime(newTime) {
    video.currentTime = newTime;
    // IMPORTANTE: ajustamos el audio tras mover el vídeo
    // (en algunos navegadores, asignar currentTime muy rápido puede fallar si no hay metadata)
    try {
      musica.currentTime = newTime;
    } catch (_) {}
  }

  // ---- Botones ----

  // Play / Pause
  btnPlayPause.addEventListener("click", async () => {
    if (video.paused) {
      await playBoth();
      setMessage("Reproduciendo…", "info");
    } else {
      pauseBoth();
      setMessage("Pausado.", "secondary");
    }
  });

  // Reiniciar: si estaba reproduciendo, sigue; si estaba en pausa, se queda en pausa.
  btnReiniciar.addEventListener("click", async () => {
    const estabaReproduciendo = !video.paused;

    setBothTime(0);

    if (estabaReproduciendo) {
      await playBoth();
      setMessage("Reiniciado y reproduciendo desde el inicio.", "info");
    } else {
      pauseBoth(); // asegura ambos en pausa
      setMessage("Reiniciado al inicio (en pausa).", "secondary");
    }
  });

  // Retrasar 5s (manteniendo sincronía). Si estaba reproduciendo, sigue reproduciendo.
  btnRetrasar.addEventListener("click", async () => {
    const estabaReproduciendo = !video.paused;

    const nueva = clamp(video.currentTime - 5, 0, isFinite(video.duration) ? video.duration : Infinity);
    setBothTime(nueva);

    if (estabaReproduciendo) await playBoth();
    else pauseBoth();

    setMessage("⏪ -5 segundos", "secondary");
  });

  // Adelantar 5s (manteniendo sincronía). Si estaba reproduciendo, sigue reproduciendo.
  btnAdelantar.addEventListener("click", async () => {
    const estabaReproduciendo = !video.paused;

    const maxTime = isFinite(video.duration) ? video.duration : Infinity;
    const nueva = clamp(video.currentTime + 5, 0, maxTime);
    setBothTime(nueva);

    if (estabaReproduciendo) await playBoth();
    else pauseBoth();

    setMessage("⏩ +5 segundos", "secondary");
  });

  // Silenciar / Escuchar (controla la música, pero se comporta “como audio del vídeo”)
  btnSilenciar.addEventListener("click", () => {
    musica.muted = !musica.muted;
    updateMuteText();
    setMessage(musica.muted ? "Audio silenciado." : "Audio activado.", "warning");
  });

  // Volumen - (0.1 hasta 0)
  btnMenosVolumen.addEventListener("click", () => {
    musica.volume = clamp(musica.volume - 0.1, 0, 1);
    updateVolumeBadge();
    setMessage(`Volumen: ${musica.volume.toFixed(1)}`, "secondary");
  });

  // Volumen + (0.1 hasta 1)
  btnMasVolumen.addEventListener("click", () => {
    musica.volume = clamp(musica.volume + 0.1, 0, 1);
    updateVolumeBadge();
    setMessage(`Volumen: ${musica.volume.toFixed(1)}`, "secondary");
  });

  // ---- Eventos del vídeo (como si tuviera audio propio) ----

  // Si el usuario usa los controles nativos del vídeo (barra/teclas), sincronizamos el audio:
  video.addEventListener("play", () => {
    // Si se reproduce por otro medio, seguimos el “modelo vídeo”
    playBoth();
  });

  video.addEventListener("pause", () => {
    pauseBoth();
  });

  video.addEventListener("seeked", () => {
    // Si el usuario arrastra la barra, movemos el audio al mismo punto
    syncAudioToVideo();

    // Si estaba en pausa, se queda en pausa. Si estaba reproduciendo, sigue reproduciendo.
    if (video.paused) musica.pause();
    else musica.play().catch(() => {});
  });

  video.addEventListener("ended", () => {
    musica.pause();
    try { musica.currentTime = 0; } catch (_) {}
    updatePlayPauseText();
    setMessage("Vídeo finalizado.", "secondary");
  });

  // UI siempre coherente con el audio
  musica.addEventListener("volumechange", () => {
    updateMuteText();
    updateVolumeBadge();
  });
});
