<?php
namespace controllers;

use models\Category;
use models\Product;

class ProductsController {
    
    /**
     * Display all products 
    */
    public function index() {
        $limit = 10;
        $page = $this->pullPageNumber();
        $total = Product::countAll();
        $totalPages = (int) ceil($total / $limit);
        if ($page < 1 || $page > $totalPages) {
            $page = 1;
        }

        $products = Product::topSellingWithPagination($limit, $page);
        $categories = Category::allParents();
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

    /**
     * Get products where is_featured is true
    */
    public function featured()
    {
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = Product::countFeatured();
        $totalPages = ceil($total / $limit);
        if ($page < 1 || $page > $totalPages) $page = 1;

        $products = Product::featuredPaginated($limit, $page);
        include __DIR__ . '/../../public_html/views/products/list.php';
    }

    /**
     * Get products when views column has a high value
    */
    public function bestSelling()
    {
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total = Product::countBestSelling();
        $totalPages = ceil($total / $limit);
        if ($page < 1 || $page > $totalPages) $page = 1;

        $products = Product::bestSellingPaginated($limit, $page);
        include __DIR__ . '/../../public_html/views/products/list.php';
    }

    
    /**
     * @return int
    */
    public function pullPageNumber() : int {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        //! simple validation when user put manual a ( 0 ) or negative number, sample: -1
        if (empty($page) || $page < 0) $page = 1;

        return $page;
    }

    
}
