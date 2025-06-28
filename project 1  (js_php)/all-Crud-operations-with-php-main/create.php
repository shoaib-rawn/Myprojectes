<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$productCode = $data['productCode'];
$product = $data['product'];
$qty = $data['qty'];
$perPrice = $data['perPrice'];

$conn->query("INSERT INTO products (productCode, product, qty, perPrice) VALUES ('$productCode', '$product', $qty, $perPrice)");
echo json_encode(["status" => "success"]);
?>
