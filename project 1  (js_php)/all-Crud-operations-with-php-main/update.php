<?php
include 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data['id']); // ✅ ensure ID is an integer
$productCode = $conn->real_escape_string($data['productCode']);
$product = $conn->real_escape_string($data['product']);
$qty = intval($data['qty']);
$perPrice = floatval($data['perPrice']);

$sql = "UPDATE products SET 
    productCode = '$productCode', 
    product = '$product', 
    qty = $qty, 
    perPrice = $perPrice 
    WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(["status" => "updated"]);
} else {
    echo json_encode(["status" => "error", "error" => $conn->error]); // ✅ shows error
}
?>
