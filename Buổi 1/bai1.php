<?php
$student = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];
$totalScore = 0;
echo "Danh sách sinh viên: \n";
foreach ($student as $s) {
    echo "Họ tên: " . $s["name"] . ", Tuổi: " . $s["age"] . ", Điểm: " . $s["score"] . "\n";
    $totalScore += $s["score"];
}
$averageScore = $totalScore / count($student);
echo "Điểm trung bình của tất cả sinh viên: " . $averageScore . "\n";
?>
