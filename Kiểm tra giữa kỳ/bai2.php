<?php
$products = [
    ["name" => "Sách", "price" => 20000, "quantity" => 5],
    ["name" => "Vở", "price" => 30000, "quantity" => 10],
    ["name" => "Bút", "price" => 5000, "quantity" => 2],
    ["name" => "Thước", "price" => 5000, "quantity" => 1],
    ["name" => "Stickers", "price" => 10000, "quantity" => 8]
];

function caculateTotal($product) {
    if (empty($product)) {
        return 0;
    }
    $total = 0;
    $len = count($product);
    for ($i = 0; $i < $len; $i++) {
        $price = $product[$i]['price'];
        $quantity = $product[$i]['quantity'];
        
        if ($price < 0 || $quantity < 0) {
            echo "Sản phẩm không hợp lệ!";
            return 0;
        }
        
        $total += ($price * $quantity);
    }
    return $total;
}

function findMaxPrice($product) {
    if (empty($product)) {
        return "";
    }

    $len = count($product);
    for ($i = 0; $i < $len; $i++) {
        if ($product[$i]['price'] < 0 || $product[$i]['quantity'] < 0) {
            echo "Sản phẩm không hợp lệ!";
            return "";
        }
        
    }

    $maxPrice = $product[0]['price'];

    
    for ($i = 1; $i < $len; $i++) {
        $price = $product[$i]['price'];

        if ($price > $maxPrice) {
            $maxPrice = $price;
        }
    }

    return $maxPrice;
}

$total = caculateTotal($products);
$maxProduct = findMaxPrice($products);

echo "Tổng giá trị sản phẩm: " . $total . " VNĐ <br>";
echo "Sản phẩm có giá cao nhất: " . $maxProduct . " VNĐ <br>";

?>
