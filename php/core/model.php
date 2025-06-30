<?php

namespace core;

use PDO;
use core\Database;

abstract class Model
{
    protected static $table;

    /**
     * Get connection from database
     * @return \PDO
    */
    protected static function getConnection(): PDO
    {
        return Database::connect();
    }

    /**
     * Count all records
     * @return int
    */
    public static function countAll(): int
    {
        $pdo = static::getConnection();
        $stmt = $pdo->query("SELECT COUNT(*) FROM " . static::$table);
        return (int)$stmt->fetchColumn();
    }

    /**
     * Get all records from products table
     * @return array
    */
    public static function all(): array
    {
        $pdo = static::getConnection();
        $stmt = $pdo->query("SELECT * FROM " . static::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a record by id column
    */
    public static function find($id)
    {
        $pdo = static::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 
    public static function delete($id): bool
    {
        $pdo = static::getConnection();
        $stmt = $pdo->prepare("DELETE FROM " . static::$table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // 
    public static function update($id, array $data): bool
    {
        $pdo = static::getConnection();

        $set = [];
        $values = [];

        foreach ($data as $key => $value) {
            $set[] = "`$key` = ?";
            $values[] = $value;
        }

        $values[] = $id;

        $sql = "UPDATE " . static::$table . " SET " . implode(', ', $set) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($values);
    }

    /**
     * Find a record by id column with ur relationships
    */
    public static function findWithRelations($id, array $relations = [])
    {
        $pdo = static::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) return null;

        $pluralMap = [
            'category' => 'categories',
            'comment' => 'comments',
            'model' => 'models',
            'brand' => 'brands',
        ];


        foreach ($relations as $relation) {
            if (strpos($relation, '.') !== false) {
                // rels needed, sample: model.brand
                [$first, $second] = explode('.', $relation);
                $foreignKey = $first . '_id';
                $firstTable = $pluralMap[$first] ?? $first . 's';

                if (isset($record[$foreignKey])) {
                    $stmt = $pdo->prepare("SELECT * FROM $firstTable WHERE id = ?");
                    $stmt->execute([$record[$foreignKey]]);
                    $relatedFirst = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($relatedFirst) {
                        $secondForeignKey = $second . '_id';
                        $secondTable = $pluralMap[$second] ?? $second . 's';

                        if (isset($relatedFirst[$secondForeignKey])) {
                            $stmt = $pdo->prepare("SELECT * FROM $secondTable WHERE id = ?");
                            $stmt->execute([$relatedFirst[$secondForeignKey]]);
                            $relatedSecond = $stmt->fetch(PDO::FETCH_ASSOC);
                            $relatedFirst[$second] = $relatedSecond;
                        }

                        $record[$first] = $relatedFirst;
                    }
                }
            } else {
                if ($relation === 'comments') {
                    // 1:N
                    $stmt = $pdo->prepare("SELECT * FROM comments WHERE product_id = ?  ORDER BY created_at DESC LIMIT 7");
                    $stmt->execute([$record['id']]);
                    $record[$relation] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    $foreignKey = $relation . '_id';
                    $table = $pluralMap[$relation] ?? $relation . 's';

                    if (isset($record[$foreignKey])) {
                        $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = ?");
                        $stmt->execute([$record[$foreignKey]]);
                        $record[$relation] = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
            }
        }

        return $record;
    }
    
}
