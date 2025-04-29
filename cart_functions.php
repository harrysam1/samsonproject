<?php
session_start();

// Function to add an item to the cart
function PHPaddToCart($title, $image, $price) {
    // Ensure price is stored as a number, removing any extra euro signs
    $price = floatval(str_replace('€', '', $price));

    // Check if the cart session variable exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the item is already in the cart
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['title'] == $title) {
            // Update the quantity if the item already exists
            $item['quantity'] += 1;
            return;
        }
    }
    
    // If the item is not in the cart, add it as a new entry
    $_SESSION['cart'][] = [
        'title' => $title,
        'image' => $image,
        'price' => $price,
        'quantity' => 1,
    ];
}


function countItemsAndPrice() {
    $total_items = 0;
    $total_price = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total_items += $item['quantity'];
            $total_price += $item['price'] * $item['quantity'];
        }
    }

    return [
        'no_of_items' => $total_items,
        'total_price' => $total_price
    ];
}
?>
