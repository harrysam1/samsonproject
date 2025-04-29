<?php
session_start();
include "config.php"; // Database connection file

$success = ""; // Success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

    // Check if email exists
    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['signup_success'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Signup failed. Try again!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup - HS Clothing</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row shadow-lg rounded overflow-hidden" style="max-width: 800px; width: 100%;">
        <!-- Logo section -->
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
            <img src="images/Hgif.gif" alt="Logo" class="img-fluid p-4" style="max-height: 150px;">
        </div>

        <!-- Signup form section -->
        <div class="col-md-6 bg-white p-4">
            <h2 class="text-center fw-bold mb-4">Sign Up</h2>

            <?php if (isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>

            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Register</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</div>
</body>
</html>
