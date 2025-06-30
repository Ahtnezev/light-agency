<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.getAttribute('data-id');
                fetch('/cart/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: productId
                    })
                })
                .then(async res => {
                    const type = res.headers.get('content-type');
                    if (!type || !type.includes('application/json')) {
                        throw new Error('Respuesta no es JSON');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        // const row = button.closest('tr');
                        // row.remove();

                        // const cartTable = document.getElementById('cart-table');
                        // const items = cartTable.querySelectorAll('tbody .cart-item');

                        // if (items.length === 0) {
                        //     document.getElementById('empty-cart-msg').style.display = 'block';
                        //     cartTable.style.display = 'none';
                        // }

                        Swal.fire('', 'Producto eliminado correctamente', 'success');
                        setTimeout(() => { window.location.href = '/cart' }, 1000); // temp
                    } else {
                        Swal.fire('Error', data.message || 'No se pudo eliminar', 'error');
                    }
                })
                .catch(err => {
                    console.error('Error en el fetch:', err.message);
                    Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
                });
            });
        });
    });
</script>