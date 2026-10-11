<?php
require_once 'model/product.php';
deleteProduct($_GET['id']);
header("Location: product_list.php");
?>