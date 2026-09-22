<?php
class Student {
    public $name;
    public $age;
    public $score;

    public function __construct($name, $age, $score) {
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }

    public function getRank() {
        if ($this->score >= 8) {
            return "Giỏi";
        } else if ($this->score >= 6.5 && $this->score < 8) {
            return "Khá";
        } else if ($this->score >= 5 && $this->score < 6.5) {
            return "Trung Bình";
        } else {
            return "Yếu";
        }
    }

    public function isPassed() {
        if ($this->score >= 5) {
            return true;
        }
        return false;
    }

    public function display() {
        echo "Họ tên: " . $this->name . ", Tuổi: " . $this->age . ", Điểm: " . $this->score . ", Xếp loại: " . $this->getRank() . "<br>";
    }
}

$student = [];

//Tạo danh sách các đối tượng student
$student1 = new Student("Nguyen Van An", 20, 8.5);
$student2 = new Student("Tran Thi Binh", 21, 6.5);
$student3 = new Student("Le Van Cuong", 19, 4.5);
$student4 = new Student("Pham Thi Dung", 20, 7.5);

$student[] = $student1;
$student[] = $student2;
$student[] = $student3;
$student[] = $student4;

//Duyệt danh sách và hiển thị thông tin
echo "Danh sách sinh viên: <br>";
foreach ($student as $s) {
    $s->display();
}

//Tìm sinh viên có điểm cao nhất
function findHighestScore($student) {
    $highestScore = $student[0]->score;
    $highestScoreStudent = $student[0];
    foreach ($student as $s) {
        if ($highestScore < $s->score) {
            $highestScore = $s->score;
            $highestScoreStudent = $s;
        }
    }
    return $highestScoreStudent;
}
$highestStudent = findHighestScore($student);
echo "Sinh viên có điểm cao nhất: " . "<br>";
$highestStudent->display();

//Đếm số sinh viên đạt yêu cầu
function countPassedStudents($student) {
    $count = 0;
    foreach ($student as $s) {
        if ($s->isPassed()) {
            $count++;
        }
    }
    return $count;
}
echo "Số sinh viên đạt yêu cầu: " . countPassedStudents($student) . "<br>";

//Điểm trung bình của tất cả sinh viên
function averageScore($student) {
    $totalScore = 0;
    foreach ($student as $s) {
        $totalScore += $s->score;
    }
    return $totalScore / count($student);
}
echo "Điểm trung bình của tất cả sinh viên: " . averageScore($student) . "<br>";

?>
