<?php
$conn = new mysqli("localhost", "root", "", "crud_db"); // ✅ your database name
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
