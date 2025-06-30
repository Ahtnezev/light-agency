<?php
namespace models;

use core\Model;
use PDO;

class Cart extends Model {

    protected static $table = 'cart';

    /**
     * 
    */
    public static function setDeletedAt(int $cartId) {
        $pdo = static::getConnection();
        $stmt = $pdo->prepare("UPDATE cart SET deleted_at = NOW() WHERE product_id = ?");
        $stmt->execute([$cartId]);
    }

   /**
    * Get cart items where paid column is false and deleted_at is null
    * @return array
   */
   public static function allWithProducts() {
    $pdo = self::getConnection();
    $stmt = $pdo->prepare("
        SELECT cart.*, products.specs, products.image_url
        FROM cart
        JOIN products ON products.id = cart.product_id
        WHERE cart.paid = 0
        AND cart.deleted_at IS NULL
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   
   }

}