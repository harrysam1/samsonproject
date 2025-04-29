<?php
// Start the session
session_start();

// Simulate a user login for this example
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = '1'; // Assign a default user ID for demonstration
}

// Check if the user has agreed to the terms
if (isset($_POST['agree_terms'])) {
    $_SESSION['agreed_to_terms'] = true;
    setcookie('terms_last_agreed', time(), time() + (365 * 24 * 60 * 60), "/"); // Expires in 1 year
}

// Fetch example: Simulate fetching legal updates
function fetchLegalUpdates() {
    // Simulated legal updates
    return [
        ['date' => '2025-01-01', 'update' => 'We have updated our return policy to include extended return periods for premium members.'],
        ['date' => '2024-10-01', 'update' => 'Shipping policy has been revised for international orders.']
    ];
}

// Fetch legal updates
$legalUpdates = fetchLegalUpdates();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Services - HS Clothing</title>
    <link rel="stylesheet" href="term.css">




</head>
<body>
    <header class="header">
        <img src="images/logo-search.png" alt="HS Clothing Logo" class="img-fluid">
    </header>
    <div class="container">
        <h1>Terms & Services</h1>
        <p>Welcome to HS Clothing! Please review our terms and services carefully.</p>

        <!-- Session example -->
        <?php if (isset($_SESSION['agreed_to_terms']) && $_SESSION['agreed_to_terms']): ?>
            <p>Thank you for agreeing to our terms on <?php echo date('Y-m-d', $_COOKIE['terms_last_agreed']); ?>.</p>
        <?php else: ?>
            <form method="POST">
                <button type="submit" name="agree_terms">Agree to Terms & Services</button>
            </form>
        <?php endif; ?>

        <h2>Recent Updates</h2>
        <!-- Fetch example -->
        <ul>
            <?php foreach ($legalUpdates as $update): ?>
                <li>
                    <strong><?php echo htmlspecialchars($update['date']); ?>:</strong>
                    <?php echo htmlspecialchars($update['update']); ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <h2>Content Ownership</h2>
        <p>All content provided on our website, including text, images, and code, is the property of HS Clothing and may not be reproduced without our consent.</p>

        <h2>User Responsibilities</h2>
        <p>By using our website, you agree to comply with our terms and refrain from any unlawful activities.</p>

        <h2>Dispute Resolution</h2>
        <p>Any disputes arising from the use of our services will be resolved under the jurisdiction of our local courts.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions about our Terms & Services, please contact us at <a href="mailto:support@hsclothing.com">support@hsclothing.com</a>.</p>
    </div>
</body>
</html>
