<?php
session_start();
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0.0;

foreach ($cartItems as $item) {
    $price = floatval(str_replace(['€', ','], '', $item['price']));
    $total += $price * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - HS CLOTHING</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="checkout.css">
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Checkout</h2>

    <?php if (!empty($cartItems)) : ?>
        <div class="mb-4">
            <h5>Order Summary:</h5>
            <div class="list-group">
                <?php foreach ($cartItems as $title => $item): ?>
                    <?php
                        $image = isset($item['image']) ? $item['image'] : 'images/default.png';
                        $price = isset($item['price']) ? $item['price'] : '€0.00';
                        $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
                    ?>
                    <div class="product-item">
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?>">
                        <div>
                            <strong><?php echo htmlspecialchars($title); ?></strong><br>
                            Qty: <?php echo $quantity; ?> <br>
                            Price: <?php echo $price; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-between fw-bold pt-3">
                    <span>Total:</span>
                    <span>€<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
        </div>

        <div class="card-form">
            <!-- ✅ Form Starts Here -->
            <form action="process_payment.php" method="POST">
                <div class="mb-3">
                    <label for="cardName" class="form-label">Cardholder Name</label>
                    <input type="text" class="form-control" id="cardName" name="cardName" required>
                </div>

                <!-- ✅ Email Address Field Added -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" required maxlength="16">
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="expiry" class="form-label">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="col">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required maxlength="3">
                    </div>
                </div>
 


                <form method="post" action="handle_payment.php">
                <button type="submit" class="btn btn-success w-100">Pay €<?php echo number_format($total, 2); ?></button>
</form>

            </form>
            <!-- ✅ End of Form -->
        </div>
    <?php else: ?>
        <p class="text-center">Your cart is empty. <a href="shopnow.php">Go Shopping</a></p>
    <?php endif; ?>
</div>

</body>
</html>
