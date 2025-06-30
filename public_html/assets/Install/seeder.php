<?php

// script to generate 1k comments with ur related products and 200 products 

require_once __DIR__ . '/../../../php/config.php';
require_once __DIR__ . '/../../../php/core/autoload.php';

use core\Database;
use models\Category;
use models\Modell;
use models\Product;

$pdo = Database::connect();
$totalProducts = Product::countAll();
$totalModell = Modell::countAll();
$totalCategory = Category::countAll();
$commentsMax = 1000;
$productsMax = 200;
// $json = file_get_contents('https://randomuser.me/api/');
// $randomNames = json_decode($json, true);
$randomNames = [
    'Drake',
    'Mayra',
    'Vanessa',
    'Claudia',
    'Yunnue',
    'Paulina',
    'Omar',
    'Diego',
    'Luis',
    'Zoe',
    'Garen',
    'Lux',
    'Zed',
    'Talon',
    'Akali',
    'Katarina',
    'Jax',
    'Ekko',
    'Jinx'
];
$lorems = [
    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, obcaecati!',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, enim. Perspiciatis, aut! Quos nulla ut rem ipsum quisquam deserunt aspernatur.',
    'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque aliquam fugit hic necessitatibus ducimus? Tempora.',
    'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt officiis non atque ducimus cupiditate, sequi totam minus dolorem quo autem distinctio quas cum enim id consequuntur ipsum illum ad laboriosam.',
    'Lorem ipsum dolor sit amet.',
    'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim.',
    'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum quibusdam debitis illo cumque. Voluptas magnam blanditiis totam.'
];
$randomSpecs = [
    'Intel Core i7-12700H, 16GB DDR4 RAM, 512GB SSD, NVIDIA RTX 3060 6GB',
    'AMD Ryzen 9 5900HX, 32GB DDR5 RAM, 1TB NVMe, Radeon RX 6800M',
    'Apple M2 Pro, 16GB RAM unificada, 1TB SSD, GPU de 10 núcleos',
    'Intel Core i5-12400F, 16GB RAM, 256GB SSD + 1TB HDD, GTX 1660 Super',
    'AMD Ryzen 7 5800X, 64GB DDR4 RAM, 2TB SSD, NVIDIA RTX 3080 Ti',
    'Intel Core i9-13900K, 32GB DDR5 RAM, 2TB NVMe, NVIDIA RTX 4090 24GB',
    'Apple M1, 8GB RAM, 256GB SSD, GPU integrada',
    'Intel Core i3-12100, 8GB RAM, 500GB HDD, Intel UHD Graphics 730',
    'AMD Ryzen 5 5600G, 16GB RAM, 1TB SSD, Radeon Vega 7 integrada',
    'Intel Xeon W-2295, 128GB ECC RAM, 4TB SSD, NVIDIA Quadro RTX 5000',
    'AMD Ryzen 7 7735HS, 16GB DDR5, 1TB SSD, NVIDIA GeForce RTX 4050',
    'Intel Core i5-11400H, 12GB RAM, 512GB SSD, Intel Iris Xe Graphics',
    'Intel Core i9-10980HK, 64GB DDR4, 2TB SSD, NVIDIA RTX A5000',
    'AMD Ryzen 5 4600H, 8GB DDR4, 256GB SSD, Radeon RX 5500M',
    'Apple M2 Max, 32GB RAM unificada, 2TB SSD, GPU de 38 núcleos',
    'Intel Core i7-11800H, 32GB RAM, 1TB SSD, NVIDIA RTX 3070',
    'AMD Ryzen Threadripper PRO 3995WX, 128GB ECC RAM, 4TB NVMe, Quadro RTX 8000',
    'Intel Pentium Gold G7400, 8GB RAM, 1TB HDD, Intel UHD Graphics 710',
    'AMD Ryzen 3 5300U, 4GB RAM, 128GB SSD, Radeon Vega integrada',
    'Intel Core i5-13500, 16GB RAM, 512GB SSD, NVIDIA GTX 1650',
];

try {
    for ($i = 1; $i <= $commentsMax; $i++) {
        $productId = rand(1, $totalProducts);
        $name = $randomNames[array_rand($randomNames)];
        $content = $lorems[array_rand($lorems)];
        $rating = rand(1, 5);

        $stmt = $pdo->prepare("
        INSERT INTO comments(product_id, name, content, rating) VALUES (?,?,?,?)
    ");
        $stmt->execute([$productId, $name, $content, $rating]);
    }
} catch (\Throwable $th) {
    echo 'whoops: ' . $th->getMessage();
    exit;
}

try {
    for ($i = 1; $i <= $productsMax; $i++) {
        $modelId = rand(1, $totalModell);
        $specs = $randomSpecs[array_rand($randomNames)];
        $price = rand(10000, 60000);
        $imageUrl = 'default.webp';
        $categoryId = rand(1, $totalCategory);
        $views = rand(150, 850);

        $stmt = $pdo->prepare("
            INSERT INTO products(model_id, specs, price, image_url, category_id, views) VALUES (?,?,?,?,?,?)
        ");
        $stmt->execute([$modelId, $specs, $price, $imageUrl, $categoryId, $views]);
    }
} catch (\Throwable $th) {
    echo 'whoops: ' . $th->getMessage();
    exit;
}

echo 'script executed!';
