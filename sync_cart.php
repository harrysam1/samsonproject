<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data)) {
    $_SESSION['cart'] = $data;
}
?>

