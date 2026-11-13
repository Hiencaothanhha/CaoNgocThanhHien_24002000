-- Tạo bảng products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price INT CHECK (price > 0),
    stock INT CHECK (stock >= 0)
);

-- Chèn dữ liệu mẫu
INSERT INTO products (name, price, stock) VALUES 
('Bút bi', 5000, 20),
('Vở ô ly', 12000, 15),
('Thước kẻ', 8000, 0);