<?php
require_once __DIR__ . '/../../../php/helpers/get_env.php';
?>
<nav class="navbar bg-dark border-bottom border-body navbar-fade" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <?= \helpers\env('APP_TITLE_NAVBAR') ?>
    </a>
    <div class="d-flex flex-row-reverse justify-content-between">
      <a href="/cart" class="btn btn-primary ms-2">
        <i class="fas fa-cart-plus float-end"></i>
      </a>
      <form class="d-flex" role="search" action="/search" method="GET" autocomplete="off">
        <input class="form-control me-2" type="search" name="q" placeholder="Buscar Modelo/Specs" aria-label="Buscar" required />
        <button class="btn btn-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>