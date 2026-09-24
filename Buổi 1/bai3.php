<?php
$student = [
    ["name" => "Nguyen Van An", "age" => 20, "score" => 8.5],
    ["name" => "Tran Thi Binh", "age" => 21, "score" => 6.5],
    ["name" => "Le Van Cuong", "age" => 19, "score" => 4.5],
    ["name" => "Pham Thi Dung", "age" => 20, "score" => 7.5]
];

function findBestStudent($student) {
    if (empty($student)) {
        return null;
    }

    $bestStudent = $student[0];
    $len = count($student);
    for ($i = 1; $i < $len; $i++) {
        if ($bestStudent["score"] < $student[$i]["score"]) {
            $bestStudent = $student[$i];
        }
    }
    return $bestStudent;
}

function findWorstStudent($student) {
    if (empty($student)) {
        return null;
    }

    $worstStudent = $student[0];
    $len = count($student);
    for ($i = 1; $i < $len; $i++) {
        if ($worstStudent["score"] > $student[$i]["score"]) {
            $worstStudent = $student[$i];
        }
    }
    return $worstStudent;
}

function countPassedStudents($student) {
    if (empty($student)) {
        return 0;
    }
    $countPassedStudents = 0;
    foreach ($student as $s) {
        if ($s["score"] >= 5) {
            $countPassedStudents++;
        }
    }
    return $countPassedStudents;
}

function findStudentByName($student, $name) {
    foreach ($student as $s) {
        $fullName = explode(" ", $s["name"]);
        if ($fullName[count($fullName) - 1] == $name) {
            return $s["name"];
        }
    }
    return null;
}

$bestStudent = findBestStudent($student);
$worstStudent = findWorstStudent($student);
$name = "Dung";

if ($bestStudent) {
    echo "Sinh viên có điểm cao nhất: " . $bestStudent["name"] . ", Điểm: " . $bestStudent["score"] . "<br>";
}

if ($worstStudent) {
    echo "Sinh viên có điểm thấp nhất: " . $worstStudent["name"] . ", Điểm: " . $worstStudent["score"] . "<br>";
}

echo "Số sinh viên đạt: " . countPassedStudents($student) ."<br>";
echo "Tìm kiếm sinh viên theo tên " . $name . " : " . findStudentByName($student, $name) ."<br>";

?>
