<?php
namespace controllers;

use models\Cart;
use PDOException;

class CartController {

    /**
     * 
    */
    public function index() {
        $cartItems = Cart::allWithProducts();
        include __DIR__ . '/../../public_html/views/cart/index.php';
    }

    public function addProduct() {
    }

    /**
     * Delete a cart item
    */
    public function delete() {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $id = intval($input['id'] ?? 0);

        if ($id <= 0 || empty($id)) {
            echo json_encode(['success' => false, 'message' => 'ID invalido: ' . $id]);
            return;
        }

        try {
            Cart::setDeletedAt($id);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}
