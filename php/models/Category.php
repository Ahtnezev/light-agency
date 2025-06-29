<?php
namespace models;
use core\Model;
use PDO;

class Category extends Model {
    protected static $table = 'categories';
  
    /**
     * Get parent categories
     * @return array
    */
    public static function allParents() : array {
        $pdo = static::getConnection();

        $stmt = $pdo->query("SELECT id, name FROM categories WHERE parent_id IS NULL");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

}