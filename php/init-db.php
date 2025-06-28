<?php
require_once __DIR__ . '/config.php';

$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = file_get_contents(__DIR__ . '/../public_html/assets/Install/script.sql');

try {
    $pdo->exec($sql);
    echo "✅ Base de datos inicializada correctamente.";
} catch (PDOException $e) {
    echo "❌ Error al ejecutar script.sql: " . $e->getMessage();
}
