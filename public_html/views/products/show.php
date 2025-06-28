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

    <main class="container my-5">
        <div class="col-12">
            <h1 class="display-6 mb-4">Información del producto</h1>
            <p class="text-muted">Visto <?= (int)$product['views'] ?> veces</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <?php if (!empty($product)): ?>
                    <article class="card shadow rounded-4 border-0 pt-4">
                        <div class="row g-0">
                            <div class="col-12">
                                <img src="<?= asset('images/products/' . e($product['image_url'])) ?>" class="img img-fluid rounded-start w-100 h-100 object-fit-cover" alt="<?= e($product['specs']) ?>">
                            </div>
                            <div class="col-12">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <span class="badge bg-success float-end">4.5 ★</span>
                                        <!-- <span class="text-muted ms-2">Valoración promedio</span> -->
                                    </div>
                                    <h2 class="card-title mb-3"><?= e($product['model']['name']) ?></h2>
                                    <h5 class="text-muted mb-3">Marca: <em class="fw-semibold"><?= e($product['model']['brand']['name']) ?></em></h5>

                                    <p class="card-text mb-4"><?= nl2br(e($product['specs'])) ?></p>

                                    <ul class="list-group list-group-flush my-4">
                                        <li class="list-group-item">✅ Garantía de <?= random_int(1, 12) ?> meses</li>
                                        <li class="list-group-item">🚚 Envío gratuito a todo el país</li>
                                        <li class="list-group-item">🔧 Soporte técnico incluido</li>
                                    </ul>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="h4 text-primary fw-bold mb-0">$<?= number_format($product['price'], 2) ?> MXN</span>
                                        <a href="/" class="btn btn-outline-success">← Volver</a>
                                    </div>
                                </div> <!-- card-body -->
                            </div> <!-- col-12 col-md-6 -->
                        </div> <!-- row -->
                    </article> <!-- card -->
                <?php endif; ?>
            </div> <!-- col-12 col-md-6 -->

            <div class="col-12 col-md-4">
                <sidebar class="mt-5 mt-md-0">
                    <?php if (!empty($product['category']['name'])): ?>
                        <strong>Categoría:</strong>
                        <span class="badge bg-danger"><?= e($product['category']['name']) ?></span>
                    <?php endif; ?>
                    <div class="mb-0 mb-md-5 mt-3">
                        <h6 class="text-muted">También te puede interesar</h6>
                        <?php if (!empty($relatedProducts)): ?>
                            <ul class="list-group list-group-flush mt-3">
                                <?php foreach($relatedProducts as $related) : ?>
                                    <li class="mb-2 list-group-item bg-transparent">
                                        <a href="/product/<?= e($related['id']) ?>">
                                            <span><?= e($related['specs']) ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="alert alert-light shadow mt-4">
                        <strong>¿Por qué elegir este modelo?</strong><br>
                        Perfecto para estudiantes, profesionales y quienes buscan un rendimiento equilibrado con diseño moderno.
                    </div>
                </sidebar>
            </div> <!-- col-12 col-md-6 -->
        </div> <!-- row -->
    </main> <!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <hr class="mx-auto" style="width: 50%;">
            </div>
        </div>
    </div>
                        
    <?php if (!empty($product['comments'])): ?>
        <div class="container comments-container mt-3 mb-5">
            <h4 class="mb-4 pb-2">Comentarios de clientes</h4>
            <?php foreach ($product['comments'] as $comment): ?>
                <article class="mb-4 p-3 rounded shadow-sm border bg-light-subtle">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <strong><i class="fas fa-user-astronaut text-success"></i> <?= e($comment['name']) ?></strong>
                        <span class="badge bg-warning text-dark"><?= e($comment['rating']) ?> ★</span>
                    </div>
                    <p class="mb-0"><?= nl2br(e($comment['content'])) ?></p>
                </article> <!-- bg-light-subtle -->
            <?php endforeach; ?>
        </div> <!-- container -->
    <?php else: ?>
        <div class="container my-5">
            <h5 class="text-muted">Este producto aún no tiene comentarios.</h5>
        </div> <!-- container -->
    <?php endif; ?>

    <?php get_footer(); ?>
</body>

</html>