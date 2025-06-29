<?php

use function helpers\asset;
use helpers\Money;
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

        <div class="container mt-4">
            <h2 class="mb-4">
                <?php $type = strpos($_SERVER['REQUEST_URI'], 'featured') !== false ?>
                <?php if ($type) : ?>
                    <i class="fas fa-star text-warning"></i>
                    <span>Productos Destacados</span>
                <?php else: ?>
                    <i class="fas fa-heart text-danger"></i>
                    <span>Productos más vendidos</span>
                <?php endif; ?>
            </h2>

            <div class="row g-4">
                <?php foreach ($products as $product): ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <article class="card card-minimal shadow-lg mb-5 fade-in" style="animation-delay: 0.6s;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-feather-alt text-primary me-3 fs-4"></i>
                                    <h5 class="card-title text-dark mb-0">$<?= Money::toMXN($product['price']) ?> <small>MXN</small></h5>
                                </div>
                                <div>
                                    <a href="/product/<?= $product['id'] ?>">
                                        <img
                                            class="card-img-top"
                                            src="<?= asset('images/products/' . $product['image_url']) ?>"
                                            alt="Image">
                                    </a>
                                </div>
                                <p class="card-text text-muted pt-3">
                                    <?= e($product['specs']) ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <a href="/product/<?= $product['id'] ?>" class="btn btn-sm btn-success btn-modern my-2">
                                        <i class="fas fa-eye me-2"></i>Ver más
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>

            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>

    </main>

    <?php get_footer(); ?>
</body>

</html>