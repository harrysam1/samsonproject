<?php
session_start();

// Set a cookie for visitor name if it's not set (simulated login)
if (!isset($_COOKIE['visitor_name'])) {
    setcookie('visitor_name', 'HS Shopper', time() + (86400 * 30), "/");
}
$visitorName = $_COOKIE['visitor_name'] ?? 'Guest';

// Initialize cart in session if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Count total cart quantity
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shop Now - HS CLOTHING</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Discover the latest collections at HS CLOTHING. Shop Now!">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="shopnow.css">
  
  
</head>

<body>

<!-- Logo at Top Left -->
<div class="container mt-3 mb-1">
  <a href="home.php" class="navbar-brand d-flex align-items-center">
    <img src="images/hgif.gif" alt="logo" class="img-fluid" style="max-width: 120px;">
  </a>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
 
 <div class="collapse navbar-collapse" id="navbarNav">
   <ul class="navbar-nav ms-auto">
     <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
     <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
     <li class="nav-item"><a class="nav-link" href="shopnow.php">Shop Now</a></li>
     <li class="nav-item">
       <a class="nav-link" href="cart.php">
         <i class="fas fa-shopping-cart"></i> Cart 
         <span id="cart-count" class="badge bg-dark"><?php echo $cartCount; ?></span>
       </a>
     </li>
   </ul>
 </div>
</div>
</nav>
  
</div>

<!-- Set Your Name Section -->
<div class="container my-3">
  <label for="nameInput" class="form-label">Set Your Name:</label>
  <input type="text" id="nameInput" class="form-control" placeholder="Enter your name">
  <button class="btn btn-dark mt-2" onclick="setVisitorName()">Save Name</button>

  <div class="text-end mt-2">
    <small>Welcome, <strong><?php echo htmlspecialchars($visitorName); ?></strong>!</small>
  </div>
</div>



  <section id="shop-now" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">All Product</h2>
      <div class="row" id="product-grid">
        <?php

$products = [
  ["image" => "images/shopping%20(2).webp", "title" => "Heak Jones", "price" => "€30.00"],
  ["image" => "images/images.jpg", "title" => "Sum Joggers", "price" => "€60.00"],
  ["image" => "images/tyu.webp", "title" => "Inex Complete", "price" => "€40.00"],
  ["image" => "images/yyy.webp", "title" => "Soe Sweatshirt", "price" => "€40.00"],
  ["image" => "images/download (1)4.jpg", "title" => "Gew Complete", "price" => "€45.00"],
  ["image" => "images/stray.jpg", "title" => "White Tshirt", "price" => "€20.00"],
  ["image" => "images/re.jpg", "title" => "Yellow Tshirt", "price" => "€30.00"],
  ["image" => "images/shopping.webp", "title" => "Sev Complete", "price" => "€55.00"],
  ["image" => "images/shopping%20(1).webp", "title" => "Brown Jacket", "price" => "€75.00"],
  ["image" => "images/bf8bd03b1c9afbe5b3285b57606d1db9_1743e0ef477f.webp", "title" => "Graphic Hoodie", "price" => "€50.00"]
];

// Inject existing session quantities
foreach ($products as &$product) {
  $title = $product['title'];
  $product['quantity'] = $_SESSION['cart'][$title]['quantity'] ?? 0;
}
unset($product); // Break the reference



        foreach ($products as $product) {
          $title = $product['title'];
          $quantity = $product['quantity'];


          echo "<div class='col-md-4 mb-4'>";
          echo "<div class='card'>";
          echo "<img src='{$product['image']}' class='card-img-top' alt='{$title}'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>{$title}</h5>";
          echo "<p class='card-text'>{$product['price']}</p>";
          echo "<div class='quantity-container'>";
          echo "<button class='quantity-btn' onclick=\"updateQuantity('{$title}','{$product['price']}','{$product['image']}', -1)\">-</button>";
          echo "<span id='qty-{$title}'>{$quantity}</span>";
          echo "<button class='quantity-btn' onclick=\"updateQuantity('{$title}','{$product['price']}','{$product['image']}', 1)\">+</button>";
          echo "</div>";
          echo "<p class='added-message' id='msg-{$title}'>Added to cart</p>";
          echo "</div></div></div>";
        }
        ?>
      </div>
    </div>
  </section>

  <script>
  function setVisitorName() {
    const name = document.getElementById('nameInput').value;
    fetch('set_name.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("Name saved! Please refresh the page.");
      }
    });
  }
</script>


  <script>
    function updateQuantity(title, price, image, change) {
        let qtyElement = document.getElementById('qty-' + title);
        let currentQty = parseInt(qtyElement.innerText);
        let newQty = currentQty + change;

        if (newQty < 0) newQty = 0;
        qtyElement.innerText = newQty;

        if (newQty > 0 || currentQty > 0) {
            addToCart(title, price, image, newQty);
        }
    }

    function addToCart(title, price, image, quantity) {
        fetch("update_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ title, price, image, quantity })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('cart-count').textContent = data.cartCount;
            document.getElementById('msg-' + title).style.display = "block";
            setTimeout(() => document.getElementById('msg-' + title).style.display = "none", 1500);
        });
    }
  </script>

</body>
</html>