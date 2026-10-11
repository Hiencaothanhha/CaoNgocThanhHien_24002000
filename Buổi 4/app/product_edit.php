<?php
require_once 'model/product.php';

$id = $_GET["id"] ?? null;
$product = getProductById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    updateProduct($id, $_POST['name'], $_POST['price'], $_POST['quantity']);
    header("Location: product_list.php");
    exit;
}

include 'view/header.php';
?>
<form method="POST" action="product_edit.php?id=<?= $product['id'] ?>">    <div class="form-row">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" value="<?= $_POST['name'] ?? $product['name'] ?>" required>
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
