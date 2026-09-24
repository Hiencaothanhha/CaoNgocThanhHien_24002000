<?php
class CartItem {
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getTotal() {
        return $this->price * $this->quantity;
    }
}
class ShoppingCart {
    private $items = [];

    public function addItem(CartItem $item) {
        if ($item->getPrice() <= 0 || $item->getQuantity() <= 0) {
            return;
        }
        $this->items[] = $item;
    }

    public function removeItem($name) {
        $isFound = false;
        foreach ($this->items as $index => $item) {
            if ($item->getName() === $name) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                $isFound = true;
                break;
            }
        }
        if (!$isFound) {
            echo "Sản phẩm không tồn tại";
        }
    }

    public function calculateTotal() {
        if (empty($this->items)) {
            return 0;
        }
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    } 

    public function displayCart() {
        if (empty($this->items)) {
            echo "Giỏ hàng trống";
        } else {
            foreach ($this->items as $item) {
                echo "Tên sản phẩm: " . $item->getName() 
                . " | Đơn giá: " . number_format($item->getPrice(), 0, ',', '.') . " đồng" 
                . " | Số lượng: ". $item->getQuantity() 
                . " | Thành tiền: " . number_format($item->getTotal(), 0, ',', '.') . " đồng<br>";
            }
            echo "Tổng tiền: " . number_format($this->calculateTotal(), 0, ',', '.') . " đồng <br>";
        }
    }
}

//Tạo một đối tượng ShoppingCart và ít nhất 4 đối tượng CartItem
$shopping = new ShoppingCart();

$item1 = new CartItem("Sách", 20000, 5);
$item2 = new CartItem("Vở", 15000, 3);
$item3 = new CartItem("Bút", 8000, 10);
$item4 = new CartItem("Thước", 5000, 0);

//Thêm các sản phẩm vào giỏ hàng
$shopping->addItem($item1);
$shopping->addItem($item2);
$shopping->addItem($item3);
$shopping->addItem($item4);

//Hiển thị toàn bộ giỏ hàng
echo "Giỏ hàng hiện tại: <br>";
$shopping->displayCart();
echo "<br>";

//Tính và hiển thị tổng tiền của giỏ hàng
echo "Tổng tiền của giỏ hàng: " . number_format($shopping->calculateTotal(), 0, ',', '.') . " đồng <br>";
echo "<br>";

//Xóa một sản phẩm khỏi giỏ hàng
$shopping->removeItem("Vở");

//Hiển thị giỏ hàng sau khi xóa sản phẩm
echo "Giỏ hàng cập nhật: <br>";
$shopping->displayCart();
echo "<br>";

?>
