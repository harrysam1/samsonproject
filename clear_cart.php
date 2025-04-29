<?php
session_start();
$_SESSION['cart'] = [];
header('Content-Type: application/json');
echo json_encode(['status' => 'cleared']);
