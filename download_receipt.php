<?php
session_start();
$user = $_COOKIE['user_name'] ?? 'Customer';

// You can customize this with more order info later
$receipt = "Thank you, $user!\n\nYour payment was successful.\nWe appreciate your order.\n- HS CLOTHING";

// Send download headers
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="receipt.txt"');
echo $receipt;
exit;



