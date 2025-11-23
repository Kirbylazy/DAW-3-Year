<?php
require_once 'clases.php';

$documentos = [];
$mostrarInforme = false;

if (isset($_POST['generar_informe'])) {
    $documentos = generarDocumentos();
    $mostrarInforme = true;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema Gestor de documentos</title>
</head>

<body>

    <section>
        <h1>Sistema de Gestión Documental (3 Documentos)</h1>

        <form method="POST" action="index.php">
            <button type="submit" name="generar_informe"> Generar y mostrar documentos</button>
        </form>

        <?php if ($mostrarInforme): ?>

            <h3>Detalle de los Documentos Creados (Total: <?php echo Documento::getConteo(); ?>)</h3>

            <?php
            // Bucle para iterar y mostrar cada documento creado
            foreach ($documentos as $key => $doc):
            ?>
                <hr>

                <?php if ($doc instanceof Contrato): ?>
                    <!-- Título específico para Contratos -->
                    <h2>Contrato</h2>
                    <p><strong>Clase y Herencia:</strong> <?php echo get_class($doc); ?></p>
                    <p><strong>Detalles Base:</strong> <?php echo $doc; ?> </p>
                    <p><strong>Acción:</strong> <?php echo $doc->imprimir(); ?></p>

                <?php elseif ($doc instanceof Informe): ?>
                    <!-- Título específico para Informes -->
                    <h2>Informe Técnico</h2>

                    <p><strong>Clase y Herencia:</strong> <?php echo get_class($doc); ?></p>
                    <p><strong>Detalles Base:</strong> <?php echo $doc; ?></p>
                    <p><strong>Acción:</strong> <?php echo $doc->imprimir(); ?></p>

                    <h5>Variables Dinámicas:</h5>

                    <?php
                    // Muestra los eventos dinámicos creados con __set
                    foreach ($doc->getEventosDinamicos() as $key => $value): ?>
                        <strong><?php echo $key; ?>:</strong> <?php echo $value; ?>
                    <?php endforeach; ?>
                    <strong>Páginas:</strong> <?php echo $doc->paginas; ?>

                <?php endif; ?>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>
</body>

</html>