<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products LIMIT 24");

$stmt->execute();

$get_products = $stmt->get_result();
?>