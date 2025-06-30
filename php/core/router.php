<?php
namespace core;

use controllers\CartController;
use controllers\CategoriesController;
use controllers\ProductsController;

class Router {
    public function route() {
    $request = trim($_SERVER['REQUEST_URI'], '/');

    // Delete params like: ?x=1
    if (strpos($request, '?') !== false) {
        $request = explode('?', $request)[0];
    }

    $segments = explode('/', $request);
    $main = $segments[0] ?? 'home';
    $param = $segments[1] ?? null;

    switch ($main) {
        case '':
        case 'home':
            $controller = new ProductsController();
            $controller->index();
            break;

        case 'product':
            if ($param && is_numeric($param)) {
                $controller = new ProductsController();
                $controller->show((int)$param);
            } else {
                http_response_code(400);
                include __DIR__ . '/../../public_html/views/products/not-found.php';
                return;
            }
            break;

        case 'featured':
            $controller = new ProductsController();
            $controller->featured();
            break;

        case 'best-selling':
            $controller = new ProductsController();
            $controller->bestSelling();
            break;
    
        case 'cart':
            $controller = new CartController();
            $controller->index();
            break;

        case 'search':
            $query = $_GET['q'] ?? '';
            $controller = new ProductsController();
            $controller->search($query);
            break;

        default:
            http_response_code(404);
            include __DIR__ . '/../../public_html/views/404/index.php';
            break;
    }
}
}
