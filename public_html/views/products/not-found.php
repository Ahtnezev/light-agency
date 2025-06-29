<?php

use function helpers\get_header;
use function helpers\get_footer;
use function helpers\get_navbar;
?>

<!doctype html>
<html lang="es-MX">

<head>
    <?php get_header(); ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php get_navbar(); ?>

    <main class="main min-vh-100 container mt-4">

        <div class="container text-center py-5">
            <h2 class="text-danger mb-4">Producto no encontrado</h2>
            <p class="text-muted mb-4">
                El producto que estás buscando no existe o ha sido eliminado.
            </p>
            <a href="/" class="btn btn-outline-dark">← Volver al listado</a>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>