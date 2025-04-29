<?php
session_start();
include "config.php"; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // ✅ Save session data
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;

        // ✅ Set a cookie with user's name (valid for 7 days)
        setcookie("user_name", $name, time() + (7 * 24 * 60 * 60), "/");

        // ✅ Add a "thank you" session message
        $_SESSION['welcome_message'] = "Thank you for becoming a member, $name!";
        ;

        // ✅ Redirect to home.php
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - HS Clothing</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row shadow-lg rounded overflow-hidden" style="max-width: 800px; width: 100%;">
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light">
            <img src="images/Hgif.gif" alt="Logo" class="img-fluid p-4" style="max-height: 150px;">
        </div>

        <div class="col-md-6 bg-white p-4">
            <h2 class="text-center fw-bold mb-4">Login</h2>

            <?php
            if (isset($_SESSION['signup_success'])) {
                echo "<div class='alert alert-success text-center'>{$_SESSION['signup_success']}</div>";
                unset($_SESSION['signup_success']);
            }
            if (isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>";
            ?>

            <form method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">Login</button>
            </form>
            <p class="text-center mt-3">Don't have an account? <a href="signup.php">Signup here</a></p>
            <p class="text-center mt-3"><a href="logout.php" class="text-danger">Logout</a></p>

        </div>
    </div>
</div>
</body>
</html>
