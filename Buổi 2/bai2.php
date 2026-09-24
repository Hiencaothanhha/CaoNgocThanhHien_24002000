<?php
class Movie {
    private $id;
    private $title;
    private $price;
    private $totalSeats;
    private $availableSeats;

    public function __construct($id, $title, $price, $totalSeats) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTotalSeats() {
        return $this->totalSeats;
    }

    public function getAvailableSeats() {
        return $this->availableSeats;
    }

    public function bookTickets($quantity) {
        if ($quantity <= 0 || $quantity > $this->availableSeats) {
            return false;
        }
        $this->availableSeats -= $quantity;
        return true;
    }

    public function cancelTickets($quantity) {
        if ($quantity <= 0 || $this->availableSeats + $quantity > $this->totalSeats) {
            return false;
        }
        $this->availableSeats += $quantity;
        return true;
    }

    public function getSoldSeats() {
        return $this->totalSeats - $this->availableSeats;
    }

    public function getRevenue() {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo() {
        echo "Mã phim: " . $this->id . " - Tên phim: " . $this->title . "<br>";
        echo "Giá vé: " . number_format($this->price, 0, ',', '.') . " đồng <br>";
        echo "Tổng số ghế: " . $this->totalSeats . " ghế <br>";
        echo "Ghế còn lại: " . $this->availableSeats . "/" . $this->totalSeats . " ghế <br>";
        echo "Số vé đã bán: " . $this->getSoldSeats() . "/" . $this->totalSeats . " vé <br>";
        echo "Doanh thu: " . number_format($this->getRevenue(), 0, ',', '.') . " đồng <br>";
    }

    public static function findMovieById($movies, $id) {
        if (empty($movies)) {
            return null;
        }

        foreach ($movies as $movie) {
            if ($movie->getId() === $id) {
                return $movie;
            }
        }
        return null;
    }

    public static function getTotalRevenue($movies) {
        if (empty($movies)) {
            return 0;
        }

        $totalRevenue = 0;
        foreach ($movies as $movie) {
            $totalRevenue += $movie->getRevenue();
        }
        return $totalRevenue;
    }

    public static function getBestSellingMovie($movies) {
        if (empty($movies)) {
            return null;
        }

        $bestSellingMovie = null;
        $maxSoldSeats = 0;
        foreach ($movies as $movie) {
            if ($movie->getSoldSeats() > $maxSoldSeats) {
                $maxSoldSeats = $movie->getSoldSeats();
                $bestSellingMovie = $movie;
            }
        }
        return $bestSellingMovie;
    }
}

//Tạo danh sách các bộ phim
$movie1 = new Movie(1, "Avengers", 100000, 100);
$movie2 = new Movie(2, "Avatar", 120000, 80);
$movie3 = new Movie(3, "Batman", 90000, 120);
$movies = [$movie1, $movie2, $movie3];

//Đặt vé cho phim Avengers
$movie1->bookTickets(30);

//Đặt vé cho phim Avatar
$movie2->bookTickets(12);

//Hủy môt số vé cho phim Avengers
$movie1->cancelTickets(5);

//Hiển thị thông tin các bộ phim
echo "Danh sách các bộ phim: <br>";
foreach ($movies as $movie) {
    $movie->displayInfo();
    echo "<br>";
}

//Tính tổng doanh thu của tất cả các bộ phim
echo "Tổng doanh thu của tất cả các bộ phim: " . number_format(Movie::getTotalRevenue($movies), 0, ',', '.') . " đồng <br>";

//Tìm bộ phim có số vé bán chạy nhất
$bestSellingMovie = Movie::getBestSellingMovie($movies);
if ($bestSellingMovie) {
    echo "Bộ phim bán chạy nhất: " . $bestSellingMovie->getTitle() . " - đã bán " . $bestSellingMovie->getSoldSeats() . "/" . $bestSellingMovie->getTotalSeats() . " vé <br>";
} else {
    echo "Chưa có bộ phim nào bán được bán vé.<br>";
}
?>
