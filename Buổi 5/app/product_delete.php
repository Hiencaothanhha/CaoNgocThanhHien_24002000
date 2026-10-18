<?php
require_once 'model/product.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit; 
}

$id = $_GET['id'] ?? null;
$product = getProductById($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    
    if ($id) {
        deleteProduct($id);
    }
}

header("Location: product_list.php");
exit;
