<?php
require_once 'model/product.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit; 
}

$id = $_GET["id"] ?? null;
$product = getProductById($id);
if (!$product) {
    header("Location: product_list.php");
    exit;
}

$error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = $_POST['price'] ?? 0;
    $quantity = $_POST['quantity'] ?? 0;

    if (empty($name)) {
        $error[] = "Tên sản phẩm không được để trống!";
    }
    if (!is_numeric($price) || $price <= 0) {
        $error[] = "Giá sản phẩm phải là số và lớn hơn 0!";
    }
    if (!is_numeric($quantity) || $quantity <= 0) {
        $error[] = "Số lượng phải là số và lớn hơn hoặc bằng 0!";
    }

    if (empty($error)) {
        updateProduct($id, $name, $price, $quantity);
        header("Location: product_list.php");
        exit;
    }
}

include 'view/header.php';
?>

<?php if (!empty($error)): ?>
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            <?php foreach ($error as $err): ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<h1 style="text-align: center;">Cập nhật sản phẩm</h1>

<form method="POST" action="product_edit.php?id=<?= $product['id'] ?>">    
    <div class="form-row">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $product['name'] ?? '') ?>" required>    
    </div>
    
    <div class="form-row">
        <label>Giá tiền:</label>
        <input type="number" name="price" value="<?= $_POST['price'] ?? $product['price'] ?>" required>
    </div>
    
    <div class="form-row">
        <label>Số lượng:</label>
        <input type="number" name="quantity" value="<?= $_POST['quantity'] ?? $product['quantity'] ?>" required>
    </div>
    
    <div class="form-row action-buttons">
        <button type="submit" style="margin-right: 25px;">Cập nhật</button>
        <a href="product_list.php"><button type="button">Quay lại</button></a>
    </div>
</form>
<?php include 'view/footer.php'; ?>