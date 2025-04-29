<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get cart items
$cartItems = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart - HS CLOTHING</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="cart.css">
 
  
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <a href="home.php" class="navbar-brand d-flex align-items-center">
    <img src="images/hgif.gif" alt="logo" class="img-fluid">
  </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
          <li class="nav-item"><a class="nav-link" href="shopnow.php">Shop Now</a></li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              <i class="fas fa-shopping-cart"></i> Cart 
              <span id="cart-count" class="badge bg-dark"><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  

  <section id="cart" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Shopping Cart</h2>
      
      <?php if (!empty($cartItems)) : ?>
        <div id="cart-items">
          <?php foreach ($cartItems as $title => $item) : ?>
            <?php 
              // Ensure keys exist to prevent errors
              $image = isset($item['image']) ? $item['image'] : 'images/default.png';
              $price = isset($item['price']) ? $item['price'] : '€0.00';
              $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
            ?>
            
            <div class="cart-item" id="cart-item-<?php echo htmlspecialchars($title); ?>">
              <img src="<?php echo htmlspecialchars($image); ?>" class="cart-image" alt="<?php echo htmlspecialchars($title); ?>">
              <span><?php echo htmlspecialchars($title); ?></span>
              <span><?php echo htmlspecialchars($price); ?></span>
              
              <div class="quantity-container">
                <button class="quantity-btn" onclick="updateCart('<?php echo htmlspecialchars($title); ?>', -1)">-</button>
                <span id="qty-<?php echo htmlspecialchars($title); ?>"><?php echo htmlspecialchars($quantity); ?></span>
                <button class="quantity-btn" onclick="updateCart('<?php echo htmlspecialchars($title); ?>', 1)">+</button>
              </div>

              <button class="remove-btn" onclick="removeFromCart('<?php echo htmlspecialchars($title); ?>')">&times;</button>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
          <button class="btn btn-danger" onclick="clearCart()">Clear Cart</button>
          <a href="checkout.php" class="btn btn-success">Checkout Now</a>


        </div>

      <?php else : ?>
        <p class="text-center">Your cart is empty.</p>
      <?php endif; ?>
    </div>
</section>

  <script>
    function updateCart(title, change) {
        let qtyElement = document.getElementById('qty-' + title);
        let currentQty = parseInt(qtyElement.innerText);
        let newQty = currentQty + change;

        if (newQty < 1) return removeFromCart(title);
        
        fetch("update_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ title, quantity: newQty })
        })
        .then(response => response.json())
        .then(data => {
            qtyElement.innerText = newQty;
            document.getElementById('cart-count').textContent = data.cartCount;
        });
    }

    function removeFromCart(title) {
        fetch("update_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ title, quantity: 0 })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-item-' + title).remove();
            document.getElementById('cart-count').textContent = data.cartCount;
        });
    }

    function clearCart() {
        fetch("clear_cart.php", { method: "POST" })
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-items').innerHTML = "<p class='text-center'>Your cart is empty.</p>";
            document.getElementById('cart-count').textContent = "0";
        });
    }
  </script>

</body>
</html>