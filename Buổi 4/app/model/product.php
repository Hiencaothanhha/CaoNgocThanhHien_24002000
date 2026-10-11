<?php
# require_once nạp file chỉ một lần duy nhất.
require_once 'common/dbConnect.php';

function getAllProducts() {
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM products ORDER BY id");
    $products = [];
    if ($sql) {
        foreach ($sql as $row) {
            $products[] = $row;
        }
    }
    return $products;
}

function getProductById($id) {
    global $conn;
    $id = (int)$id;
    $sql = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    if ($sql) {
        foreach ($sql as $row) {
            return $row; // Trả về sản phẩm đầu tiên tìm thấy
        }
    }
    return null;
}

function addProduct($name, $price, $quantity) {
    global $conn;
    $name = str_replace("'", "''", $name);
    $price = (float)$price;
    $quantity = (int)$quantity;
    
    $sql = mysqli_query($conn, "INSERT INTO products (name, price, quantity) VALUES ('$name', $price, $quantity)");
    return $sql;
}

function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $id = (int)$id;
    $name = str_replace("'", "''", $name);
    $price = (float)$price;
    $quantity = (int)$quantity;

    $sql = mysqli_query($conn, "UPDATE products SET name = '$name', price = $price, quantity = $quantity WHERE id = $id");
    return $sql;
}

function deleteProduct($id) {
    global $conn;
    $id = (int)$id;
    
    $sql = mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    return $sql;
}
?>