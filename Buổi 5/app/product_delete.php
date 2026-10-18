<?php
require_once 'model/product.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit; 
}

$id = $_GET['id'] ?? null;
$product = getProductById($id);

if (!$product) {
    include 'view/header.php';
    echo "<div style='text-align: center; margin-top: 50px;'>";
    echo "<h3 style='color: red;'>Lỗi: Sản phẩm không tồn tại!</h3>";
    echo "<a href='product_list.php'><button type='button'>Quay lại danh sách</button></a>";
    echo "</div>";
    include 'view/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    deleteProduct($id);
    header("Location: product_list.php");
    exit;
}
?>

<?php include 'view/header.php'; ?>

<h1 style="text-align: center;">Xóa sản phẩm</h1>
<div style="text-align: center; margin-top: 20px; font-family: Arial, sans-serif; font-size: 20px">
    <p>Bạn có chắc chắn muốn xóa sản phẩm <strong><?= htmlspecialchars($product['name']) ?></strong> không?</p>
    <p style="color: red;">(Hành động này không thể hoàn tác)</p>

    <form method="POST" action="product_delete.php?id=<?= $product['id'] ?>">
        <div class="form-row action-buttons" style="margin-top: 10px;">
            <button type="submit" style="padding: 10px 20px; border: 1px solid #999; border-radius: 6px; cursor: pointer; margin-right: 100px;">Xóa</button>
            <a href="product_list.php"><button type="button" style="padding: 10px 30px; border: 1px solid #999; border-radius: 6px; cursor: pointer; margin-right: 25px;">Quay lại</button></a>
        </div>
    </form>
</div>

<?php include 'view/footer.php'; ?>
