<?php
require_once 'model/user.php';
$error = $success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } elseif (getUserByUsername($username)) {
        $error = "Tên đăng nhập đã tồn tại!";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        if (createUser($username, $hashed)) {
            $success = "Đăng ký thành công! <a href='login.php'>Đăng nhập ngay</a>";
        } else {
            $error = "Lỗi hệ thống.";
        }
    }
}
include 'view/header.php';
?>
<h1 style="text-align: center;">Đăng ký tài khoản</h1>
<?php if($error) echo "<p style='color:red'>$error</p>"; ?>
<?php if($success) echo "<p style='color:green'>$success</p>"; else { ?>
<form method="POST">
    <div class="form-row"><label>Tên đăng nhập:</label><input type="text" name="username"></div>
    <div class="form-row"><label>Mật khẩu:</label><input type="password" name="password"></div>
    <div class="form-row action-buttons"><button type="submit">Đăng ký</button></div>
</form>
<?php } ?>
<?php include 'view/footer.php'; ?>