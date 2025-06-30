<?php

use helpers\Money;

use function helpers\asset;

$products = $products ?? []; ?>

<div class="col-12">
    <ul class="list-group list-group-flush">
        <li class="list-group-item bg-transparent border-bottom-0">
            <span><i class="fas fa-external-link-alt text-danger"></i></span>
            <a href="/best-selling" target="_blank" class="text-dark fw-semibold text-decoration-none">Nuestros productos más vendidos</a>
        </li>
        <li class="list-group-item bg-transparent">
            <span><i class="fas fa-external-link-alt text-danger"></i></span>
            <a href="/featured" target="_blank" class="text-dark fw-semibold text-decoration-none">Conoce nuestros productos destacados</a>
        </li>
    </ul>
</div>
<div class="col-12">
    <h4 class="my-4">Categorías</h4>
    <?php if (count($categories) > 0) : ?>
        <nav class="nav flex-column flex-sm-row bg-dark p-3 rounded mb-5">
            <?php foreach ($categories as $cat): ?>
                <a class="nav-link text-white fw-semibold me-3" href="/category/<?= $cat['id'] ?>">
                    <?= e($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    <?php else: ?>
        <div class="alert">No se encontraron nuevas categorías :(</div>
    <?php endif; ?>
</div>

<div class="col-12">
    <h1 class="display-6 mb-4">Productos destacados</h1>
</div> <!-- col-12 -->

<?php if (!empty($products)) {
    foreach ($products as $key => $product) { ?>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <article class="card card-minimal shadow-lg mb-5 fade-in" style="animation-delay: 0.6s;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-feather-alt text-primary me-3 fs-4"></i>
                        <h5 class="card-title text-dark mb-0">$<?= Money::toMXN($product['price']) ?> <small>MXN</small></h5>
                    </div> <!-- d-flex -->
                    <div>
                        <a href="/product/<?= $product['id'] ?>" target="_blank">
                            <img
                                class="card-img-top"
                                src="<?= asset('images/products/' . $product['image_url']) ?>"
                                alt="Image">
                        </a>
                    </div>
                    <hr>
                    <p class="card-text text-muted pt-3">
                        <?= e($product['specs']) ?>
                    </p>
                </div> <!-- card-body -->
                <div class="card-footer">
                    <div class="float-end">
                        <a href="/product/<?= $product['id'] ?>" class="btn btn-sm btn-success btn-modern my-2" target="_blank">
                            <i class="fas fa-eye me-2"></i>Ver más
                        </a>
                    </div> <!-- float-end -->
                </div> <!-- card-footer -->
            </article> <!-- card -->
        </div>
    <?php } ?>
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-end">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Anterior</a></li>
                <?php endif; ?>

                <!-- <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $page === $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?> -->

                <?php if ($page < $totalPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Siguiente</a></li>
                <?php endif; ?>
            </ul> <!-- pagination -->
        </nav>
    <?php endif; ?>
<?php } else { ?>
    <div class="alert alert-modern mb-4">
        <!-- <button class="alert-close" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button> -->
        <div class="alert-modern-content">
            <div class="alert-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <h2>No contamos con stock por el momento, una disculpa :(</h2>
            <p class="mb-3">Te notificaremos tan pronto tengamos disponibilidad</p>
            <button class="btn btn-modern-alert me-2">
                <i class="fas fa-bell me-2"></i>Notificarme
            </button>
            <button class="btn btn-modern-alert">
                <i class="fas fa-heart me-2"></i>Lista de deseos
            </button>
        </div>
    </div>
<?php } ?>