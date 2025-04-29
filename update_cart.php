<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'] ?? null;
$quantity = $data['quantity'] ?? 0;

// If quantity is zero or less, remove the item
if ($title && $quantity <= 0) {
    unset($_SESSION['cart'][$title]);
} elseif ($title && $quantity > 0) {
    // If the item exists, update it; if not, initialize it
    if (!isset($_SESSION['cart'][$title])) {
        $_SESSION['cart'][$title] = [
            'price' => $data['price'] ?? '€0.00',
            'image' => $data['image'] ?? 'images/default.png',
            'quantity' => $quantity
        ];
    } else {
        $_SESSION['cart'][$title]['quantity'] = $quantity;
    }
}

// Return the new cart count
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));

header('Content-Type: application/json');
echo json_encode(['cartCount' => $cartCount]);
