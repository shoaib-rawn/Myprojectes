<?php
$conn = mysqli_connect("localhost", "root", "", "crud_db");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// First: Students
$sql1 = "SELECT * FROM student";
$result1 = mysqli_query($conn, $sql1);

echo "<h3>Student Data:</h3>";
while ($row = mysqli_fetch_assoc($result1)) {
  echo "Name: " . $row['name'] . " - Age: " . $row['age'] . "<br>";
}

// Second: Products
$sql2 = "SELECT * FROM products";
$result2 = mysqli_query($conn, $sql2);

echo "<h3>Product Data:</h3>";
while ($row = mysqli_fetch_assoc($result2)) {
  echo "Product Code: " . $row['productCode'] . " - Name: " . $row['product'] . "<br>";
}
?>

