<?php
require_once 'common/dbConnect.php';

function getUserByUsername($username) {
    global $conn;

    // Gửi câu lệnh lên mySQL để phiên dịch
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    // Gán dữ liệu thực tế vào đúng vị trí dấu ? với String (s), Integer (i), Double (d)
    mysqli_stmt_bind_param($stmt, "s", $username);
    // Ra lệng cho mySQL thực thi câu lệnh
    mysqli_stmt_execute($stmt);

    // Lấy toạn bộ kết quả xuất ra lưu vào biến
    $result = mysqli_stmt_get_result($stmt);

    // Duyệt dữ liệu, đưa dữ liệu vào mảng để sử dụng trong php
    return mysqli_fetch_assoc($result);
}

function createUser($username, $password) {
    global $conn;

    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    return mysqli_stmt_execute($stmt);
}
?>