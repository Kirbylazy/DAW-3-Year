<div class="d-flex flex-column gap-2" style="position:sticky; top:80px; min-width:150px">
    <p class="text-muted small fw-bold mb-1 text-uppercase px-1">Panel árbitro</p>
    <a href="{{ route('arbitro.panel') }}"
       class="btn text-start {{ request()->routeIs('arbitro.panel') ? 'btn-dark' : 'btn-outline-dark' }}">
        Árbitro
    </a>
    <a href="{{ route('arbitro.panel.entrenador') }}"
       class="btn text-start {{ request()->routeIs('arbitro.panel.entrenador') ? 'btn-dark' : 'btn-outline-dark' }}">
        Entrenador
    </a>
    <a href="{{ route('arbitro.panel.deportista') }}"
       class="btn text-start {{ request()->routeIs('arbitro.panel.deportista') ? 'btn-dark' : 'btn-outline-dark' }}">
        Deportista
    </a>
</div>
