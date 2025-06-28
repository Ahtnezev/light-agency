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

    <main class="main min-vh-100 container mt-4">
      <div class="row">
        <div class="col-12">
          <h1 class="display-6">Productos</h1>
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