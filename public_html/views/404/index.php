<?php

use function helpers\get_header;
use function helpers\get_footer;
use function helpers\get_navbar;
?>

<!doctype html>
<html lang="en">

<head>
  <?php get_header(); ?>
</head>

<body class="d-flex flex-column min-vh-100">
  <?php get_navbar(); ?>

  <main class="main_404 min-vh-100 d-flex flex-wrap align-items-center justify-content-center">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-10 col-lg-11 mx-auto">
          <section class="px-4">
            <h1 class="display-6 title text-center">Oops!, el contenido que consultaste no se encuentra disponible o ya no existe :(</h1>
            <a href="/" class="btn btn-outline-success d-block w-75 mx-auto mt-4">Regresar al sitio</a>
          </section>
        </div>
      </div>
    </div>
  </main>

  <?php get_footer(); ?>
</body>

</html>