<?php
namespace core;

use controllers\CartController;
use controllers\ProductsController;

class Router {
    public function route() {
    $request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    // $request = trim($_SERVER['REQUEST_URI'], '/');

    // Delete params like: ?x=1
    if (strpos($request, '?') !== false) {
        $request = explode('?', $request)[0];
    }

    // $segments = explode('/', $request);
    // $main = $segments[0] ?? 'home';
    // $param = $segments[1] ?? null;
    $segments = explode('/', $request);
    $route = $segments[0] ?? 'home';
    $action = $segments[1] ?? null;
    $param = $segments[2] ?? null;

    $path = $route . ($action ? "/$action" : '');

    switch ($path) {
        case '':
        case 'home':
            (new ProductsController)->index();
            break;

        case (preg_match('/^product\/\d+$/', $path) ? true : false):
            $productId = (int) $segments[1];
            if ($productId) {
                $controller = new ProductsController();
                $controller->show($productId);
            } else {
                http_response_code(400);
                include __DIR__ . '/../../public_html/views/products/not-found.php';
                return;
            }
            break;

        case 'featured':
            (new ProductsController)->featured();
            break;

        case 'best-selling':
            (new ProductsController)->bestSelling();
            break;
    
        case 'cart':
            (new CartController)->index();
            break;

        case 'cart/delete':
            (new CartController)->delete();
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
