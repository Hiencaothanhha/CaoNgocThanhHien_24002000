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
    $price = (float)$price;
    $quantity = (int)$quantity;
    
    $stmt = mysqli_prepare($conn, "INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sdi", $name, $price, $quantity);
    $sql = mysqli_stmt_execute($stmt);
    return $sql;
}

function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $id = (int)$id;
    $price = (float)$price;
    $quantity = (int)$quantity;

    $stmt = mysqli_prepare($conn, "UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sdii", $name, $price, $quantity, $id);
    $sql = mysqli_stmt_execute($stmt);
    return $sql;
}

function deleteProduct($id) {
    global $conn;
    $id = (int)$id;
    
    $sql = mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    return $sql;
}
?>