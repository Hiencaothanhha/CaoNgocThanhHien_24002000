<?php 
$student = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

function caculateAverageScore($student) {
    if (empty($student)) {
        return 0;
    }
    $totalScore  = 0;
    foreach ($student as $s) {
        $totalScore += $s["score"];
    }
    return $totalScore / count($student);
}

function getRank($score) {
    if ($score >= 8) {
        return "Giỏi";
    } else if ($score >= 6.5) {
        return "Khá";
    } else if ($score >= 5) {
        return "Trung Bình";
    } else {
        return "Yếu";
    }
}

function displayStudent($student) {
    echo "Danh sách sinh viên: <br>";
    foreach ($student as $s) {
        $score = $s["score"];
        $rank = getRank($score);
        echo "Họ tên: " . $s["name"] . ", Tuổi: " . $s["age"] . ", Điểm: " . $s["score"] . ", Xếp loại: " . $rank . "<br>";
    }
}

displayStudent($student);
echo "Điểm trung bình của tất cả sinh viên: " . caculateAverageScore($student) . "<br>";
?>
