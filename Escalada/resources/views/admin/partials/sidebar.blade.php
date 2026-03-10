<div class="d-flex flex-column gap-2" style="position:sticky; top:80px; min-width:150px">
    <p class="text-muted small fw-bold mb-1 text-uppercase px-1">Administración</p>
    <a href="{{ route('admin.pruebas') }}"
       class="btn text-start {{ request()->routeIs('admin.pruebas') ? 'btn-dark' : 'btn-outline-dark' }}">
        Pruebas
    </a>
    <a href="{{ route('admin.copas') }}"
       class="btn text-start {{ request()->routeIs('admin.copas') ? 'btn-dark' : 'btn-outline-dark' }}">
        Copas
    </a>
    <a href="{{ route('admin.usuarios') }}"
       class="btn text-start {{ request()->routeIs('admin.usuarios') ? 'btn-dark' : 'btn-outline-dark' }}">
        Usuarios
    </a>
    <a href="{{ route('admin.rocodromos') }}"
       class="btn text-start {{ request()->routeIs('admin.rocodromos') ? 'btn-dark' : 'btn-outline-dark' }}">
        Rocódromos
    </a>
</div>
