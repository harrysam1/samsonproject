<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SamsonProject";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>About - HS CLOTHING</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="normalize.css">
  <link rel="stylesheet" type="text/css" href="style.css">
 

  <section id="about" class="pt-5 pb-5">
    <div class="container">
      <h1 class="text-center mb-4">About HS Clothing</h1>
      <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
          <h2>Our Journey</h2>
          <p>HS Clothing is more than just a fashion brand; it is a symbol of passion, creativity, and a commitment to delivering high-quality apparel to our customers. Founded with the goal of offering timeless style and comfort, HS Clothing has become a trusted name in fashion.</p>
          <p>Our brand is driven by the love of fashion and a desire to create pieces that are both stylish and comfortable. Whether you’re looking for casual wear or something more formal, HS Clothing offers a wide variety of options for every occasion.</p>
          <h3>Our Mission</h3>
          <p>At HS Clothing, we aim to redefine the fashion industry by providing stylish and high-quality garments that are affordable for everyone. Our mission is to create lasting relationships with our customers by delivering exceptional service, top-notch products, and a memorable shopping experience.</p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          <h3>Why Choose Us?</h3>
          <ul>
            <li>Trendy and modern designs that fit every personality.</li>
            <li>High-quality fabrics and materials for comfort and durability.</li>
            <li>Affordable prices without compromising on quality.</li>
            <li>Exceptional customer service to ensure your satisfaction.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <body>

<nav class="navbar fixed-top navbar-expand-lg py-4">
  <div class="container">
  <nav class="navbar fixed-top navbar-expand-lg py-4">
<div class="container">
  <a href="home.php" class="navbar-brand d-flex align-items-center">
    <img src="images/hgif.gif" alt="logo" class="img-fluid">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" id="offcanvasNavbar">
      <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
    
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
</div>
</nav>



  <footer class="bg-dark text-white py-4">
    <div class="container text-center">
      <p>© 2025 HS CLOTHING. All rights reserved.</p>
      <p><a href="home.php" class="text-white">Home</a> | <a href="about.php" class="text-white">About</a> | <a href="shopnow.php" class="text-white">Shop Now</a></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
