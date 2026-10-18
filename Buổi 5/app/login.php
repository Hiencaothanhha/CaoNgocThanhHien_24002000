<?php
session_start();
if (isset($_SESSION['username'])) { 
    header("Location: product_list.php"); 
    exit; 
}
require_once 'model/user.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $user = getUserByUsername($username);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: product_list.php");
        exit;
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu sai.";
    }
}
include 'view/header.php';
?>
<h1 style="text-align: center;">Đăng nhập</h1>
<?php if($error) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    <div class="form-row"><label>Tên đăng nhập:</label><input type="text" name="username"></div>
    <div class="form-row"><label>Mật khẩu:</label><input type="password" name="password"></div>
    <div class="form-row action-buttons"><button type="submit">Đăng nhập</button></div>
    <div class="form-row action-buttons">Chưa có tài khoản?<a href="register.php"> Đăng ký</a></div>
</form>
<?php include 'view/footer.php'; ?>