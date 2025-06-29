<?php

namespace models;

use core\Model;
use PDO;

class Product extends Model
{
    protected static $table = 'products';

     /**
     * @return array
    */
    public static function topSellingWithPagination(int $limit = 10, int $page = 1): array {
        $offset = ($page - 1) * $limit;

        $pdo = static::getConnection();
        $stmt = $pdo->prepare("
            SELECT
                p.*,
                c.name AS category_name
                FROM products p
                JOIN categories c ON p.category_id = c.id
                ORDER BY p.views DESC
                LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get random products (x2) to display in: "also u could interest"
     * @return array
    */
    public static function getRandomExcept($excludeId, $limit = 2) : array
    {
        $pdo = static::getConnection();
        $limit = (int)$limit;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id != ? ORDER BY RAND() LIMIT $limit");
        $stmt->execute([$excludeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Search products by: model name or specs
     * @return array
    */
    public static function search($query, $limit = 10) : array
    {
        $pdo = static::getConnection();
        $limit = (int)$limit;
        $stmt = $pdo->prepare("SELECT * FROM products WHERE model_id IN(
            SELECT id FROM models WHERE name LIKE ? ) OR specs LIKE ? LIMIT $limit");
        $search = '%' . trim($query) . '%';
        $stmt->execute([$search, $search]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;    
    }


    /**
     * Increments views column on products
    */
    public static function incrementViews($id) : void
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("UPDATE products SET views = views + 1 where id = ?");
        $stmt->execute([$id]);
    }

    /**
     * Get products by searching action with pagination
     * @return array
    */
    public static function searchWithPagination($query, $limit = 10, $page = 1) : array 
    {
        $pdo = static::getConnection();
        $offset = ($page - 1) * $limit;
        $searchTerm = '%' . $query . '%';

        $countStmt = $pdo->prepare("
            SELECT COUNT(*) FROM products 
            WHERE specs LIKE ? 
            OR model_id IN (
                SELECT id FROM models WHERE name LIKE ?
            )
        ");
        $countStmt->execute([$searchTerm, $searchTerm]);
        $total = $countStmt->fetchColumn();

        $stmt = $pdo->prepare("
            SELECT * FROM products 
            WHERE specs LIKE ? 
            OR model_id IN (
                SELECT id FROM models WHERE name LIKE ?
            )
            LIMIT $limit OFFSET $offset
        ");
        $stmt->execute([$searchTerm, $searchTerm]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'data' => $results,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
            'totalPages' => ceil($total / $limit)
        ];
    }
}
