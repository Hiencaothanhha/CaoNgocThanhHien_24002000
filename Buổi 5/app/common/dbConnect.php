<?php
# mysqli_connect(host, username, password, database_name)
$conn = mysqli_connect('localhost', 'root', '', 'shopping_cart');
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
?>