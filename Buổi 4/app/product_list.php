<?php
require_once 'model/product.php';
$products = getAllProducts();
include 'view/header.php';
?>
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
        <td><?= $p['name'] ?></td>
        <td><?= number_format($p['price'], 0, ',', '.') ?></td>
        <td><?= $p['quantity'] ?></td>
        <td>
            <a href="product_edit.php?id=<?= $p['id'] ?>">Sửa</a> | 
            <a href="product_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa?');">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'view/footer.php'; ?>