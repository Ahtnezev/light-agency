<?php

use helpers\Money;

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
        <div class="container my-4">
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-3">Resultados de búsqueda "<span class="text-success"><?= e($query) ?></span>"</h5>
                    <?php if (empty($results)): ?>
                        <p class="text-muted">No se encontraron productos.</p>
                    <?php else: ?>
                        <ul class="list-group">
                            <?php foreach ($results as $product): ?>
                                <li class="list-group-item shadow-sm d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= asset('images/products/' . e($product['image_url'])) ?>" alt="<?= e($product['specs']) ?>" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                        <div>
                                            <div class="fw-semibold"><?= e($product['specs'] ?? 'Especificaciones...') ?></div>
                                            <a href="/product/<?= $product['id'] ?>" class="btn btn-sm btn-success mt-1">Ver</a>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-success fw-bold">$<?= Money::toMXN($product['price']) ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if ($totalPages > 1): ?>
                        <nav class="mt-4">
                            <ul class="pagination justify-content-center float-end">
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                        <a class="page-link" href="/search?q=<?= urlencode($query) ?>&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php get_footer(); ?>
</body>

</html>