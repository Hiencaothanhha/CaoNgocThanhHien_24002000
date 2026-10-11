<?php
require_once 'model/product.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    addProduct($_POST['name'], $_POST['price'], $_POST['quantity']);
    header("Location: product_list.php");
    exit;
}
include 'view/header.php';
?>
<form method="POST">
    <div class="form-row">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" required>
    </div>
    
    <div class="form-row">
        <label>Giá tiền:</label>
        <input type="number" name="price" min="1" required>
    </div>
    
    <div class="form-row">
        <label>Số lượng:</label>
        <input type="number" name="quantity" min="0" required>
    </div>
    
    <div class="form-row action-buttons">
        <button type="submit" style="margin-right: 50px;">Lưu</button>
        <a href="product_list.php"><button type="button">Quay lại</button></a>
    </div>
</form>
<?php include 'view/footer.php'; ?>
