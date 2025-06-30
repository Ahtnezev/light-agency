<div class="container my-5">
    <h2 class="mb-4">Carrito de Compras</h2>

    <div class="table-responsive">
        <table class="table align-middle table-hover table-striped" id="cart-table">
            <thead class="table-light">
                <tr>
                    <th>Producto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Mensualidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                use helpers\CartHelper;
                use function helpers\asset;

                // print_r($cartItems);
                foreach($cartItems as $key => $cart) :
                    $subtotal = $cart['subtotal'] * $cart['qty'];
                    $mensual6 = CartHelper::calculateMonthly($subtotal, 6);
                    $mensual12 = CartHelper::calculateMonthly($subtotal, 12);
                ?>
                    <tr class="cart-item">
                        <td>
                            <img src="<?= asset('images/products/' .  e($cart['image_url']) ) ?>" class="img-thumbnail" style="width: 80px;" alt="<?= e($cart['specs']) ?>">
                        </td>
                        <td>HP 240 G8</td>
                        <td>$<?= CartHelper::getSubtotal($cart['subtotal']) ?></td>
                        <td>
                            <input id="qty-<?= $cart['qty'] ?>" type="number" disabled class="form-control form-control-sm w-50" min="1" value="<?= $cart['qty'] ?>">
                        </td>
                        <td>$<?= CartHelper::getSubtotal($cart['subtotal']) ?></td>
                         <td>
                            <small>6 meses: $<?= $mensual6 ?> / mes</small><br>
                            <small>12 meses: $<?= $mensual12 ?> / mes</small>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger btn-delete" data-id="<?= $cart['id'] ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-end mt-4">
        <div class="col-md-4">
            <div class="card card-resumen border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Resumen de tu carrito</span>
                    </h5>
                    <p>De contado</p>
                    <p class="mb-2 d-flex justify-content-between">
                        <span>Total:</span>
                        <strong>$<?= CartHelper::getTotal($cartItems) ?> MXN</strong>
                    </p>
                    <button class="btn btn-success w-100 mt-3" id="button-process-payment">Proceder al Pago</button>
                </div>
            </div>
        </div>
    </div>
</div>