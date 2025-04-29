<?php
session_start();

// Generate a new order number
$orderNumber = "ORD-" . strtoupper(bin2hex(random_bytes(4))); // Example: ORD-A1B2C3D4

// Generate a new tracking number
$trackingNumber = "TRK-" . strtoupper(bin2hex(random_bytes(6))); // Example: TRK-12A3B4C5D6E7

// Set the current order date
$orderDate = date('Y-m-d H:i:s'); // Example: 2025-04-18 15:30:00

// Example order total and cart items (can be fetched from your payment process logic)
$total = $_SESSION['order_total'] ?? 0.00; // Use session total or set default
$cartItems = $_SESSION['order_items'] ?? []; // Use session cart items or set default
$userEmail = $_SESSION['user_email'] ?? null; // Use session email or set null
$cardName = $_SESSION['card_name'] ?? 'Customer';
$emailSent = $_SESSION['email_sent'] ?? false;

// Save the generated values in the session
$_SESSION['order_number'] = $orderNumber;
$_SESSION['tracking_number'] = $trackingNumber;
$_SESSION['order_date'] = $orderDate;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Successful - HS CLOTHING</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="processpayment.css">
    <meta http-equiv="refresh" content="12;url=home.php">
</head>
<body>

<div class="confirmation-box">
    <h2>Payment Successful ✅</h2>
    <p>Thank you, <strong><?php echo $_COOKIE['user_name'] ?? 'Customer'; ?></strong>!</p>
    <p>Your order has been placed and will be processed shortly.</p>

    <?php if ($userEmail): ?>
        <p>Email confirmation 
            <strong><?php echo $emailSent ? "was sent ✅" : "could not be sent ❌"; ?></strong> 
            to <strong><?php echo htmlspecialchars($userEmail); ?></strong>.
        </p>
    <?php endif; ?>

    <div class="order-details mt-3">
        <p><strong>Order Number:</strong> <?php echo htmlspecialchars($orderNumber); ?></p>
        <p><strong>Tracking Number:</strong> <?php echo htmlspecialchars($trackingNumber); ?></p>
        <p><strong>Order Date:</strong> <?php echo htmlspecialchars($orderDate); ?></p>
    </div>

    <div class="product-summary mt-4">
        <h5>Order Summary:</h5>
        <ul class="list-group">
            <?php foreach ($cartItems as $title => $item): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?php echo htmlspecialchars($title); ?> (x<?php echo $item['quantity']; ?>)</span>
                    <span><?php echo $item['price']; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="fw-bold mt-3">Total Paid: €<?php echo number_format($total, 2); ?></div>
    </div>

    <form method="post" action="download_receipt.php">
        <button type="submit" class="btn btn-primary download-btn mt-3">Download Receipt</button>
    </form>
</div>

<script src="process_payment.js"></script>

</body>
</html>
