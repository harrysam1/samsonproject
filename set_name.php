<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = htmlspecialchars($data['name'] ?? 'HS Shopper');
    setcookie('visitor_name', $name, time() + (86400 * 30), "/");
    echo json_encode(["success" => true, "name" => $name]);
}
?>
