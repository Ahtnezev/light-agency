<?php use function helpers\env; ?>
<footer class="bg-dark text-white text-center py-4 mt-5 border-top">
  <div class="container">
    <p class="mb-1">&copy; <?= date('Y') ?> <?= env('APP_TITLE') ?>. Todos los derechos reservados.</p>
    <div class="d-flex justify-content-center gap-3 small">
      <a href="/#" class="text-white text-decoration-none">Acerca de</a>
      <a href="/#" class="text-white text-decoration-none">Contacto</a>
      <a href="/#" class="text-white text-decoration-none">Privacidad</a>
    </div>
  </div>
</footer>