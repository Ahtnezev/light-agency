<?php

use function helpers\get_header;
use function helpers\get_footer;
use function helpers\get_navbar;
?>

<!doctype html>
<html lang="es-MX">

<head>
    <?php get_header(); ?>
    <title><?= \helpers\env('APP_TITLE') ?> <?= \helpers\setTitle('Mi carrito') ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php get_navbar(); ?>

    <main class="main min-vh-100 container mt-4">
        <div class="row">
            <div class="col-12">

            </div> <!-- col-12 -->
        </div> <!-- row -->
    </main> <!-- main -->

    <?php get_footer(); ?>
</body>

</html>