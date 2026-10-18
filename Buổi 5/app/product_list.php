<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit; 
}

require_once 'model/product.php';
$products = getAllProducts();
include 'view/header.php';
?>
<h1 style="text-align: center;">Quản lý Sản phẩm</h1>
<a href="product_add.php" style="display: block; text-align: center; margin-bottom: 15px;"><button>Thêm sản phẩm</button></a>
<table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%; text-align: center;">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Chức năng</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= number_format($p['price'], 0, ',', '.') ?></td>
        <td><?= $p['quantity'] ?></td>
        <td>
            <a href="product_edit.php?id=<?= $p['id'] ?>">Sửa</a> | 
            <form method="POST" action="product_delete.php" style="display:inline; margin:0;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <button type="submit" style="background: none; border: none; color: gray; cursor: pointer; text-decoration: none; padding: 0; font-size: inherit; font-family: inherit;" onmouseover="this.style.color='black'" onmouseout="this.style.color='gray'">Xóa</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'view/footer.php'; ?>
