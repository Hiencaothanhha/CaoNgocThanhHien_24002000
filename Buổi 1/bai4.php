<?php
class Student {
    private $name;
    private $age;
    private $score;

    public function __construct($name, $age, $score) {
        $this->name = $name;
        $this->age = $age;
        $this->score = $score;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getScore() {
        return $this->score;
    }

    public function getRank() {
        if ($this->score >= 8) {
            return "Giỏi";
        } else if ($this->score >= 6.5) {
            return "Khá";
        } else if ($this->score >= 5) {
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

    public static function findHighestScore($students) {
        if (empty($students)) {
            return null;
        }
        
        $highestScore = $students[0]->getScore();
        $highestScoreStudent = $students[0];
        foreach ($students as $s) {
            if ($highestScore < $s->getScore()) {
                $highestScore = $s->getScore();
                $highestScoreStudent = $s;
            }
        }
        return $highestScoreStudent;
    }

    public static function countPassedStudents($students) {
        if (empty($students)) {
            return 0;
        }

        $count = 0;
        foreach ($students as $s) {
            if ($s->isPassed()) {
                $count++;
            }
        }
        return $count;
    }

    public static function averageScore($students) {
        if (empty($students)) {
            return 0;
        }

        $totalScore = 0;
        foreach ($students as $s) {
            $totalScore += $s->getScore();
        }
        return $totalScore / count($students);
    }
}

//Tạo danh sách các đối tượng student
$student1 = new Student("Nguyen Van An", 20, 8.5);
$student2 = new Student("Tran Thi Binh", 21, 6.5);
$student3 = new Student("Le Van Cuong", 19, 4.5);
$student4 = new Student("Pham Thi Dung", 20, 7.5);

$student = [$student1, $student2, $student3, $student4];

//Duyệt danh sách và hiển thị thông tin
echo "Danh sách sinh viên: <br>";
foreach ($student as $s) {
    $s->display();
}

//Tìm sinh viên có điểm cao nhất
$highestStudent = Student::findHighestScore($student);
if ($highestStudent === null) {
    echo "Không có sinh viên nào trong danh sách.<br>";
} else {
    echo "Sinh viên có điểm cao nhất: " . $highestStudent->getName() . ", Điểm: " . $highestStudent->getScore() . "<br>";
}

//Đếm số sinh viên đạt yêu cầu
$passedStudentsCount = Student::countPassedStudents($student);
echo "Số sinh viên đạt yêu cầu: " . $passedStudentsCount . "<br>";

//Điểm trung bình của tất cả sinh viên
$average = Student::averageScore($student);
echo "Điểm trung bình của tất cả sinh viên: " . $average . "<br>";

?>
