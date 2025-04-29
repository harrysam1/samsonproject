<?php
session_start();

include 'cart_functions.php';

$title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
$image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : '';
$price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';


$price = floatval(str_replace('€', '', $price));

PHPaddToCart($title, $image, $price);


header("Location: cart.php");
exit();
?>


