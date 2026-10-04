-- Tạo database shopping_cart và bảng cart_items
CREATE DATABASE IF NOT EXISTS shopping_cart;
USE shopping_cart;

CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0),
    quantity INT NOT NULL CHECK (quantity > 0)); 
    
-- Thêm ít nhất 5 sản phẩm vào giỏ hàng
INSERT INTO cart_items (name, price, quantity) VALUES 
('Sách', 20000, 1),
('Vở', 15000,  5),
('Bút bi', 8000, 10),
('Thước kẻ', 5000, 1),
('Bút chì', 5000, 2),
('Máy tính Casio', 800000, 1);

-- Hiển thị toàn bộ sản phẩm
SELECT * FROM cart_items;

-- Hiển thị sản phẩm có giá lớn hơn 100000
SELECT * FROM cart_items WHERE price > 100000;

-- Hiển thị sản phẩm có số lượng lớn hơn 5
SELECT * FROM cart_items WHERE quantity > 5;

-- Sắp xếp sản phẩm theo giá giảm dần
SELECT * FROM cart_items ORDER BY price DESC;

-- Cập nhật giá của một sản phẩm
UPDATE cart_items SET price = 25000 WHERE name = 'Sách';

-- Cập nhật số lượng của một sản phẩm
UPDATE cart_items SET quantity = 2 WHERE name = 'Thước kẻ';

-- Xóa một sản phẩm
DELETE FROM cart_items WHERE name = 'Bút chì';

-- Hiển thị tên sản phẩm, giá, số lượng và thành tiền
SELECT name, price, quantity, (price * quantity) as total
FROM cart_items;

-- Tính tổng tiền của toàn bộ giỏ hàng
SELECT SUM(price * quantity) AS total FROM cart_items;


