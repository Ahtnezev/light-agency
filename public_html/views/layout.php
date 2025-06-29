<?php
  use function helpers\asset;
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

    <main class="main min-vh-100 container mt-4">
      <section class="py-5 shadow bg-danger border rounded-5 mb-5">
        <div class="container text-center">
          <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
              <h1 class="display-5 fw-bold text-white">¡Descuentos Especiales en Laptops!</h1>
              <p class="lead text-white mb-4">
                Aprovecha las mejores ofertas en marcas como Dell, HP, Lenovo y más. Solo por tiempo limitado.
              </p>
              <a href="javascript:void(0);" id="btn-sales" class="btn btn-success btn-lg px-4">Ver Ofertas</a>
            </div>
            <div class="col-md-4 d-none d-md-block">
              <img src="<?= asset('images/products/buen-fin.png') ?>" alt="Oferta Laptop" class="img-fluid">
            </div>
          </div>
        </div>
      </section>

      <div class="row">
        <div class="col-12">
          <h1 class="display-6">Productos destacados</h1>
        </div> <!-- col-12 -->
        <?php
          if (isset($view) && file_exists($view)) {
            include $view;
          } else {
            echo "<p class='mt-4 ps-3'>View not found.</p>";
          }
        ?>
      </div> <!-- row -->
    </main>
    
    <?php get_footer(); ?>
  </body>
</html>