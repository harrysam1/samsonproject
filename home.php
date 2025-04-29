<?php
session_start();

// Show one-time welcome message after login
$welcome_message = '';
if (isset($_SESSION['welcome_message'])) {
    $welcome_message = $_SESSION['welcome_message'];
    unset($_SESSION['welcome_message']);
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "samsonproject";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>HS CLOTHING</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="home.css">
</head>

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
        <div class="offcanvas-body">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="About.php" class="nav-link">About page</a>
            </li>
          
            <li class="nav-item">
              <a href="signup.php" class="nav-link">Become a member</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  </div>
</nav>

    

  <!-- ✅ Welcome Message -->
  <?php if (!empty($welcome_message)) : ?>
    <div class="container mt-5 pt-5">
      <div id="welcomeMessage" class="alert alert-success text-center">
        <?= htmlspecialchars($welcome_message) ?>
      </div>
    </div>
   
  <?php endif; ?>

  <section id="hero">
    <div class="text-center">
      <h1 class="display-4">Welcome to HS Clothing</h1>
      <p class="lead">Unleash Your Style with Trendy, High-Quality Fashion</p>
      <a href="shopnow.php" class="btn btn-outline-light btn-lg">Shop Now</a>
    </div>
  </section>

  <footer class="bg-dark text-white mt-5">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-6">
          <h5>HS Clothing</h5>
          <p>&copy; 2025 All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="privacy.php" class="text-white me-3">Privacy Policy</a>
          <a href="Term&Services.php" class="text-white">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="welcome.js"></script>


</body>
</html>

<?php
$conn->close();
?>
