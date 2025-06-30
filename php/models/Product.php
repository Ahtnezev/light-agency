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
                FROM ".self::$table." p
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
     * Get featured products
     * @return array
    */
    public static function featuredPaginated(int $limit = 10, int $page = 1): array {
        $offset = ($page - 1) * $limit;
        $pdo = static::getConnection();
        $stmt = $pdo->prepare("
            SELECT p.*, c.name AS category_name
            FROM ".self::$table." p
            JOIN categories c ON p.category_id = c.id
            WHERE p.is_featured = 1
            ORDER BY p.created_at DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get best selling products
     * @return array
    */
    public static function bestSellingPaginated(int $limit = 10, int $page = 1): array {
        $offset = ($page - 1) * $limit;
        $pdo = static::getConnection();
        $stmt = $pdo->prepare("
            SELECT p.*, c.name AS category_name
            FROM ".self::$table." p
            JOIN categories c ON p.category_id = c.id
            ORDER BY p.views DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countFeatured()
    {
        $pdo = static::getConnection();
        return $pdo->query("SELECT COUNT(*) FROM ".self::$table." WHERE is_featured = 1")->fetchColumn();
    }
    
    public static function count() : int
    {
        $pdo = static::getConnection();
        return $pdo->query("SELECT COUNT(*) FROM ".self::$table)->fetchColumn();
    }

    public static function countBestSelling()
    {
        $pdo = static::getConnection();
        return $pdo->query("SELECT COUNT(*) FROM ".self::$table."")->fetchColumn(); // o con filtro si lo deseas
    }

    /**
     * Get random products (x2) to display in: "also u could interest"
     * @return array
    */
    public static function getRandomExcept($excludeId, $limit = 2) : array
    {
        $pdo = static::getConnection();
        $limit = (int)$limit;
        $stmt = $pdo->prepare("SELECT * FROM ".self::$table." WHERE id != ? ORDER BY RAND() LIMIT $limit");
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
        $stmt = $pdo->prepare("SELECT * FROM ".self::$table." WHERE model_id IN(
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
        $stmt = $pdo->prepare("UPDATE ".self::$table." SET views = views + 1 where id = ?");
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
            SELECT COUNT(*) FROM ".self::$table." 
            WHERE specs LIKE ? 
            OR model_id IN (
                SELECT id FROM models WHERE name LIKE ?
            )
        ");
        $countStmt->execute([$searchTerm, $searchTerm]);
        $total = $countStmt->fetchColumn();

        $stmt = $pdo->prepare("
            SELECT * FROM ".self::$table." 
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
