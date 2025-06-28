<?php
namespace controllers;

use models\Product;

class ProductsController {
    /**
     * Display all products 
    */
    public function index() {
        $products = Product::all();
        $view = __DIR__ . '/../../public_html/views/products/index.php';
        include __DIR__ . '/../../public_html/views/layout.php';
    }

    /**
     * Search a specific product and display details itself
    */
    public function show($id) {
        $product = Product::findWithRelations($id, ['model.brand','comments', 'category']);
        if (!$product) {
            include __DIR__ . '/../../public_html/views/products/not-found.php';
            return;
        }
        $relatedProducts = Product::getRandomExcept($id);
        Product::incrementViews($id);
        include __DIR__ . '/../../public_html/views/products/show.php';
    }

    /**
     * Search products with pagination <in nav form>
    */
    public function search($query) {
        $totalPages = 0;
        $results = [];
        if (!empty(trim($query))) {
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $result = Product::searchWithPagination($query, 10, $page);
    
            $results = $result['data'];
            $totalPages = $result['totalPages'];
            $limit = $result['limit'];
        }
        include __DIR__ . '/../../public_html/views/products/search-results.php';
    }
    
    // public function update($id, $data) {
    //     Product::update($id, $data);
    // }
    
    // public function delete($id) {
    //     Product::delete($id);
    // }
}
