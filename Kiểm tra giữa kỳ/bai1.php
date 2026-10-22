<?php
$name = "Cao Ngọc Thanh Hiền";
$score = 10;

function xepLoai($sc) {
    if ($sc >= 8) {
        return "Giỏi";
    } else if ($sc >= 6.5) {
        return "Khá";
    } else if ($sc >= 5) {
        return "Trung Bình";
    } else {
        return "Yếu";
    }
}

if ($score < 0 || $score > 10) {
    echo "Điểm không hợp lệ! <br>";
} else {
    $xepLoai = xepLoai($score);
    echo "Họ và tên: " . $name . " | Điểm: " . $score . " | Xếp loại: " . $xepLoai;
}
?>
