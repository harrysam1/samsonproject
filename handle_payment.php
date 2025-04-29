<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardName = htmlspecialchars($_POST['cardName'] ?? 'Valued Customer');
    $userEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    setcookie("user_name", $cardName, time() + (86400 * 30), "/");

    $cartItems = $_SESSION['cart'] ?? [];
    $_SESSION['cart'] = [];

    // Generate order details
    $orderNumber = 'ORD-' . strtoupper(uniqid());
    $trackingNumber = 'TRK-' . strtoupper(bin2hex(random_bytes(4)));
    $orderDate = date("F j, Y, g:i a");

    // Prepare fake email content
    $subject = "Order Confirmation - HS CLOTHING";
    $message = "Hello $cardName,\n\n";
    $message .= "Thank you for your order with HS CLOTHING!\n\n";
    $message .= "Order Number: $orderNumber\n";
    $message .= "Tracking Number: $trackingNumber\n";
    $message .= "Order Date: $orderDate\n\n";
    $message .= "Order Summary:\n";

    $total = 0.0;
    foreach ($cartItems as $title => $item) {
        $price = floatval(str_replace(['€', ','], '', $item['price']));
        $quantity = intval($item['quantity']);
        $message .= "- $title (x$quantity) at {$item['price']}\n";
        $total += $price * $quantity;
    }

    $message .= "\nTotal: €" . number_format($total, 2) . "\n\n";
    $message .= "We hope you enjoy your purchase!\nHS CLOTHING Team";

    // Simulate email sending
    $emailSent = true;

    // Save to session
    $_SESSION['order_number'] = $orderNumber;
    $_SESSION['tracking_number'] = $trackingNumber;
    $_SESSION['order_date'] = $orderDate;
    $_SESSION['order_total'] = $total;
    $_SESSION['order_items'] = $cartItems;
    $_SESSION['user_email'] = $userEmail;
    $_SESSION['card_name'] = $cardName;
    $_SESSION['email_sent'] = $emailSent;

    // Redirect to payment confirmation page
    header("Location: process_payment.php");
    exit();

} else {
    header("Location: cart.php");
    exit();
}
