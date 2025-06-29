<?php

// script to generate 1k comments with ur related products

require_once __DIR__ . '/../../../php/config.php';
require_once __DIR__ . '/../../../php/core/autoload.php';
use core\Database;
use models\Product;

$pdo = Database::connect();
$totalProducts = Product::count();
// $json = file_get_contents('https://randomuser.me/api/');
// $randomNames = json_decode($json, true);
$randomNames = [
    'Drake', 'Mayra', 'Vanessa', 'Claudia', 'Yunnue',
    'Paulina', 'Omar', 'Diego', 'Luis', 'Zoe', 'Garen',
    'Lux', 'Zed', 'Talon', 'Akali', 'Katarina', 'Jax',
    'Ekko', 'Jinx'
];

$totalComments = 1000;
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

try {
    for ($i=1; $i <= $totalComments; $i++) { 
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

echo 'script executed';