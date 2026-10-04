CREATE DATABASE IF NOT EXISTS movie_tickets;
USE movie_tickets;

-- Tạo bảng movies
CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0),
    total_seats INT NOT NULL CHECK (total_seats >= 0),
    available_seats INT NOT NULL CHECK (available_seats >= 0));
    
-- Thêm ít nhất 5 bộ phim
INSERT INTO movies (title, price, total_seats, available_seats) VALUES 
('Avatar', 120000, 100, 12),
('Titanic', 100000, 120, 27),
('The Lion King', 80000, 160, 42),
('Avengers', 100000, 130, 31),
('Zootopia', 90000, 160, 89);

-- Hiển thị toàn bộ danh sách phim
SELECT * FROM movies;

-- Hiển thị phim có giá vé lớn hơn 100000
SELECT * FROM movies WHERE price > 100000;

-- Hiển thị phim còn nhiều hơn 50 ghế
SELECT * FROM movies WHERE available_seats > 50;

-- Sắp xếp phim theo giá vé giảm dần
SELECT * FROM movies ORDER BY price DESC;

-- Cập nhật số ghế còn lại của một bộ phim
UPDATE movies SET available_seats = 58 WHERE title = 'Titanic';

-- Xóa một phim
DELETE FROM movies WHERE title = 'Avatar';

-- Hiển thị số vé đã bán của từng phim
SELECT title, (total_seats - available_seats) AS sold_tickets FROM movies;

-- Tính doanh thu của từng phim
SELECT title, (total_seats - available_seats)*price AS revenue FROM movies;

-- Tính tổng doanh thu của tất cả các phim
SELECT SUM((total_seats - available_seats)*price) AS total_revenue FROM movies;

-- Tìm phim có số vé bán ra nhiều nhất
SELECT title, (total_seats - available_seats) AS sold_tickets FROM movies
GROUP BY id, title HAVING sold_tickets = (SELECT MAX(total_seats - available_seats) FROM movies);
