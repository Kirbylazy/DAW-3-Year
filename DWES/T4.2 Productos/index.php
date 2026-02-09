<?php
require_once('funciones.php');
session_start();

/* ===========================
   CONTROLADOR (POST actions)
   =========================== */

if (isset($_POST['seed'])) {
    insertarProductosDePrueba();
    header("Location: index.php");
    exit();
}

if (isset($_POST['crear'])) {
    crearProducto($_POST['nombre'], $_POST['descripcion'], $_POST['precio']);
    header("Location: index.php");
    exit();
}

if (isset($_POST['borrar']) && isset($_POST['id'])) {
    eliminarProducto($_POST['id']);
    header("Location: index.php");
    exit();
}

if (isset($_POST['editar']) && isset($_POST['id'])) {
    $_SESSION['producto'] = obtenerProductoPorId($_POST['id']);
}

if (isset($_POST['actualizar'])) {
    $id = $_SESSION['producto']['id'];

    actualizarProducto(
        $id,
        $_POST['nombre'],
        $_POST['descripcion'],
        $_POST['precio']
    );

    unset($_SESSION['producto']);
    header("Location: index.php");
    exit();
}

if (isset($_POST['cancelar'])) {
    unset($_SESSION['producto']);
    header("Location: index.php");
    exit();
}

/* ===========================
   DATOS PARA LA VISTA
   =========================== */

$productos = obtenerProductos();
$productoEditar = $_SESSION['producto'] ?? null;

function euro($n) {
    return number_format((float)$n, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Productos</title>

    <!-- Bootswatch Quartz (Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/quartz/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient border-bottom">
    <div class="container">
        <span class="navbar-brand fw-semibold">
            <i class="bi bi-box-seam me-2"></i>Gestión de Productos
        </span>
        <span class="navbar-text small opacity-75">
            CRUD con PHP + Bootstrap Quartz
        </span>
    </div>
</nav>

<main class="container py-4">

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-4">
        <div>
            <h1 class="h3 mb-1">Panel de productos</h1>
            <div class="text-body-secondary small">
                Total: <span class="badge rounded-pill text-bg-info"><?= count($productos) ?></span>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a class="btn btn-outline-light" href="index.php">
                <i class="bi bi-arrow-clockwise me-1"></i>Recargar
            </a>
        </div>
    </div>

    <!-- =======================
         FORMULARIO DE EDICIÓN
         ======================= -->
    <?php if ($productoEditar): ?>
        <div class="card border-info shadow-sm mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i>Editar producto
                </div>
                <span class="badge text-bg-info">ID #<?= (int)$productoEditar['id'] ?></span>
            </div>
            <div class="card-body">
                <form method="post" class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nombre</label>
                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            value="<?= htmlspecialchars($productoEditar['nombre']) ?>"
                            required
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Precio (€)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                            <input
                                type="number"
                                step="0.01"
                                name="precio"
                                class="form-control"
                                value="<?= htmlspecialchars((string)$productoEditar['precio']) ?>"
                                required
                            >
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descripción</label>
                        <textarea
                            name="descripcion"
                            class="form-control"
                            rows="3"
                            placeholder="Descripción del producto..."
                        ><?= htmlspecialchars($productoEditar['descripcion']) ?></textarea>
                    </div>

                    <div class="col-12 d-flex flex-wrap gap-2">
                        <button type="submit" name="actualizar" class="btn btn-info">
                            <i class="bi bi-check2-circle me-1"></i>Actualizar
                        </button>
                        <button type="submit" name="cancelar" class="btn btn-outline-light">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- =======================
         FORMULARIO DE CREACIÓN
         ======================= -->
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold">
            <i class="bi bi-plus-circle me-2"></i>Añadir producto
        </div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej: Tornillo M8" required>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Precio (€)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                        <input type="number" step="0.01" name="precio" class="form-control" placeholder="Ej: 9.99" required>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Detalles del producto..."></textarea>
                </div>

                <div class="col-12 d-flex flex-wrap gap-2">
                    <button type="submit" name="crear" class="btn btn-success">
                        <i class="bi bi-plus-lg me-1"></i>Añadir
                    </button>

                    <button type="submit" name="seed" class="btn btn-warning">
                        <i class="bi bi-database-add me-1"></i>Cargar 10 de prueba
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- =======================
         LISTADO
         ======================= -->
    <div class="card shadow-sm">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="fw-semibold">
                <i class="bi bi-list-ul me-2"></i>Lista de productos
            </div>
            <div class="text-body-secondary small">
                Última actualización: <?= date('Y-m-d H:i') ?>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">ID</th>
                            <th class="text-nowrap">Nombre</th>
                            <th>Descripción</th>
                            <th class="text-nowrap text-end">Precio</th>
                            <th class="text-nowrap">Creación</th>
                            <th class="text-nowrap text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($productos)): ?>
                        <tr>
                            <td colspan="6" class="p-4 text-center text-body-secondary">
                                <i class="bi bi-inbox me-1"></i>No hay productos todavía.
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td class="text-body-secondary">#<?= (int)$p['id'] ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($p['nombre']) ?></td>
                            <td class="text-body-secondary">
                                <?= nl2br(htmlspecialchars($p['descripcion'] ?? '')) ?>
                            </td>
                            <td class="text-end">
                                <span class="badge rounded-pill text-bg-primary">
                                    <?= euro($p['precio']) ?> €
                                </span>
                            </td>
                            <td class="text-nowrap text-body-secondary">
                                <?= htmlspecialchars($p['fecha_creacion']) ?>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-2">
                                    <!-- Editar -->
                                    <form method="post" class="m-0">
                                        <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                                        <button type="submit" name="editar" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil me-1"></i>Editar
                                        </button>
                                    </form>

                                    <!-- Borrar (abre modal) -->
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        data-id="<?= (int)$p['id'] ?>"
                                        data-nombre="<?= htmlspecialchars($p['nombre'], ENT_QUOTES) ?>"
                                    >
                                        <i class="bi bi-trash3 me-1"></i>Borrar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>

<footer class="border-top py-3">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="text-body-secondary small">
            <?= date('Y-m-d') ?> · CRUD Productos
        </div>
        <div class="text-body-secondary small">
            Quartz theme · Bootstrap 5
        </div>
    </div>
</footer>

<!-- Modal Confirmación Borrado -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
            <i class="bi bi-exclamation-triangle me-2"></i>Confirmar borrado
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres borrar el producto <span class="fw-semibold" id="deleteProductName">---</span>?
        <div class="text-body-secondary small mt-2">Esta acción no se puede deshacer.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
            Cancelar
        </button>

        <form method="post" class="m-0">
            <input type="hidden" name="id" id="deleteProductId" value="">
            <button type="submit" name="borrar" class="btn btn-danger">
                <i class="bi bi-trash3 me-1"></i>Borrar
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (necesario para el modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Rellena el modal con el ID y nombre del producto seleccionado
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', event => {
        const btn = event.relatedTarget;
        const id = btn.getAttribute('data-id');
        const nombre = btn.getAttribute('data-nombre');

        document.getElementById('deleteProductId').value = id;
        document.getElementById('deleteProductName').textContent = nombre;
    });
</script>

</body>
</html>
