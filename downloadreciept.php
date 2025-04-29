<?php
session_start();
require('libs/fpdf/fpdf.php');

if (!isset($_COOKIE['user_name']) || empty($_SESSION['cart'])) {
    echo "No receipt data found.";
    exit;
}

$cardName = $_COOKIE['user_name'];
$cartItems = $_SESSION['cart'];
$total = 0.0;

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Header
$pdf->Cell(0, 10, 'HS CLOTHING - Receipt', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);
$pdf->Cell(0, 10, "Customer: $cardName", 0, 1);
$pdf->Ln(5);
$pdf->Cell(0, 10, 'Order Summary:', 0, 1);

// Items
foreach ($cartItems as $title => $item) {
    $price = floatval(str_replace(['€', ','], '', $item['price']));
    $quantity = intval($item['quantity']);
    $line = "$title (x$quantity) - {$item['price']}";
    $pdf->Cell(0, 10, $line, 0, 1);
    $total += $price * $quantity;
}

// Total
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total Paid: €' . number_format($total, 2), 0, 1);

// Output
$pdf->Output('D', 'Receipt_HS_CLOTHING.pdf'); // D = force download
?>
