<?php

require_once __DIR__ . '/../../../php/config.php';
require_once __DIR__ . '/../../../php/core/autoload.php';

use core\Database;

$logFile = __DIR__ . '/install_log.txt';
$log = [];
$totalInserted = [];
$pdo = null;

try {
    $pdo = Database::connect();
    $pdo->beginTransaction();

    // Table: brands
    $brands = [
        ['Dell'], ['HP'], ['Lenovo'], ['Asus'], ['Apple']
    ];
    $stmt = $pdo->prepare("INSERT INTO brands (name) VALUES (?)");
    foreach ($brands as $brand) {
        $stmt->execute($brand);
    }
    $totalInserted['brands'] = count($brands);

    // Table: categories
    $categories = [
        ['Laptops', null],
        ['Ultrabooks', 1],
        ['Gaming', 1],
        ['Workstations', 1],
        ['Macbooks', null]
    ];
    $stmt = $pdo->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    foreach ($categories as $cat) {
        $stmt->execute($cat);
    }
    $totalInserted['categories'] = count($categories);

    // Table: models
    $models = [
        [1, 'Inspiron 15', 2022],
        [2, 'HP 250 G8', 2023],
        [3, 'ThinkPad X1', 2021],
        [4, 'ROG Zephyrus', 2024],
        [5, 'MacBook Air M2', 2023]
    ];
    $stmt = $pdo->prepare("INSERT INTO models (brand_id, name, year) VALUES (?, ?, ?)");
    foreach ($models as $model) {
        $stmt->execute($model);
    }
    $totalInserted['models'] = count($models);

    // Table: products
    $products = [
        [1, 2, 14999.00, 'Procesador i5, 8GB RAM, SSD 256GB', 'default.webp', 100],
        [2, 3, 13999.00, 'Procesador Ryzen 5, 8GB RAM, SSD 512GB', 'default.webp', 80],
        [3, 4, 18999.00, 'Core i7, 16GB RAM, SSD 1TB', 'default.webp', 120],
        [4, 5, 25999.00, 'RTX 4060, 16GB RAM, SSD 1TB', 'default.webp', 200],
        [5, 5, 28999.00, 'Chip M2, 8GB RAM, 256GB SSD', 'default.webp', 300]
    ];
    $stmt = $pdo->prepare("INSERT INTO products (model_id, category_id, price, specs, image_url, views) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($products as $prod) {
        $stmt->execute($prod);
    }
    $totalInserted['products'] = count($products);

    // Table: comments
    $comments = [
        [1, 'Juan', 'Excelente producto', 5],
        [1, 'Ana', 'Muy buena relación calidad/precio', 4],
        [2, 'Luis', 'Rápido y confiable', 5],
        [3, 'Marta', 'Un poco caro, pero potente', 4],
        [4, 'Carlos', 'Ideal para gaming', 5],
        [5, 'Elena', 'Apple siempre caro, pero bueno', 4],
        [5, 'Paco', 'Me encanta el diseño', 5],
        [3, 'Leo', 'Buen rendimiento', 4],
        [2, 'Sara', 'Se calienta un poco', 3],
        [1, 'Tania', 'Recomendado', 5]
    ];
    $stmt = $pdo->prepare("INSERT INTO comments (product_id, name, content, rating) VALUES (?, ?, ?, ?)");
    foreach ($comments as $com) {
        $stmt->execute($com);
    }
    $totalInserted['comments'] = count($comments);

    $pdo->commit();

    $log[] = "Instalación completada con éxito.";
} catch (Exception $e) {
    if ($pdo instanceof PDO) {
        $pdo->rollBack();
    }
    $log[] = "Error durante la instalación: " . $e->getMessage();
}

// write results
$log[] = "\nRegistros insertados por tabla:";
foreach ($totalInserted as $table => $count) {
    $log[] = "- $table: $count registros.";
}

file_put_contents($logFile, implode(PHP_EOL, $log));

echo "<pre>" . implode(PHP_EOL, $log) . "</pre>";