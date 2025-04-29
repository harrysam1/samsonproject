<?php
// Start the session
session_start();

// Simulate a user login for this example
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = '1'; // Assign a default user ID for demonstration
}

// Set a cookie to track visits (expires in 30 days)
if (isset($_COOKIE['user_visit'])) {
    $visitCount = $_COOKIE['user_visit'] + 1;
} else {
    $visitCount = 1;
}
setcookie('user_visit', $visitCount, time() + (30 * 24 * 60 * 60), "/");

// Fetch example for retrieving user data (e.g., from an API or database)
function fetchUserData($userId) {
    // Simulated database of users
    $data = [
        '1' => ['name' => 'Joe Joe', 'email' => 'joejoe@example.com'],
        '2' => ['name' => 'Sam Smith', 'email' => 'Sams@example.com']
    ];

    return $data[$userId] ?? null;
}

// Example user ID from the session
$userId = $_SESSION['user_id'];
$userData = fetchUserData($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - HS Clothing</title>
    <link rel="stylesheet" href="privacy.css">
</head>
<body>
    <header class="header">
        <img src="images/logo-search.png" alt="HS Clothing Logo" class="img-fluid">
    </header>
    <div class="container">
        <h1>Privacy Policy</h1>
        <p>Welcome to HS Clothing! Your privacy is critically important to us.</p>

        <!-- Session example -->
        <?php if ($userData): ?>
            <p>Hello, <strong><?php echo htmlspecialchars($userData['name']); ?></strong>! We're glad to have you back.</p>
        <?php endif; ?>

        <!-- Cookie example -->
        <p>You have visited our site <strong><?php echo $visitCount; ?></strong> time(s).</p>

        <h2>Information We Collect</h2>
        <p>We collect information to provide better services to our users. This includes:</p>
        <ul>
            <li>Session data to remember your preferences.</li>
            <li>Cookies to analyze traffic and improve our website.</li>
            <li>User data, such as your name and email, when you interact with our services.</li>
        </ul>

        <h2>How We Use Your Information</h2>
        <p>We use your data for the following purposes:</p>
        <ul>
            <li>Enhancing your shopping experience.</li>
            <li>Providing personalized services.</li>
            <li>Communicating updates and promotions.</li>
        </ul>

        <h2>Managing Cookies</h2>
        <p>You can control and manage cookies through your browser settings. Note that disabling cookies may affect the functionality of our website.</p>

        <h2>Session Information</h2>
        <p>Your session data is stored securely to ensure a smooth experience while browsing our site.</p>

        <h2>User Information</h2>
        <?php if ($userData): ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($userData['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
        <?php else: ?>
            <p>No user information available.</p>
        <?php endif; ?>

        <h2>Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:support@hsclothing.com">support@hsclothing.com</a>.</p>
    </div>
</body>
</html>
