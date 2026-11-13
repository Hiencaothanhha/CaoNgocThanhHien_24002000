<?php
// Thiết lập header trả về định dạng JSON
header('Content-Type: application/json; charset=utf-8');

// Kết nối cơ sở dữ liệu
$host = '127.0.0.1';
$dbname = 'shopping';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Lỗi kết nối CSDL: " . $e->getMessage()]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

// Lấy dữ liệu JSON từ body (cho POST và PUT)
$inputJSON = json_decode(file_get_contents('php://input'), true);

// Kiểm tra tính hợp lệ của dữ liệu đầu vào
function validateInput($data) {
    if (!isset($data['name']) || !isset($data['price']) || !isset($data['stock'])) {
        return "Vui lòng cung cấp đầy đủ name, price và stock.";
    }

    $name = trim($data['name']);
    if (mb_strlen($name) < 1 || mb_strlen($name) > 100) {
        return "Tên sản phẩm (sau khi bỏ khoảng trắng) phải từ 1 đến 100 ký tự.";
    }

    // Kiểm tra price là số nguyên > 0
    if (!filter_var($data['price'], FILTER_VALIDATE_INT) || $data['price'] <= 0) {
        return "Đơn giá phải là số nguyên lớn hơn 0.";
    }

    // Kiểm tra stock là số nguyên >= 0
    if (!filter_var($data['stock'], FILTER_VALIDATE_INT) && $data['stock'] !== 0 && $data['stock'] !== '0') {
         return "Số lượng tồn phải là số nguyên không âm.";
    }
    if ($data['stock'] < 0) {
        return "Số lượng tồn phải là số nguyên không âm.";
    }

    return true;
}

// Kiểm tra sản phẩm có tồn tại hay không?
function productExists($pdo, $id) {
    $stmt = $pdo->prepare("SELECT id FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() !== false;
}

// Xử lý các phương thức yêu cầu
switch ($method) {
    // Trả về danh sách sản phẩm
    case 'GET':
        try {
            $stmt = $pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(["success" => true, "data" => $products]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Lỗi truy vấn: " . $e->getMessage()]);
        }
        break;

    // Thêm sản phẩm mới
    case 'POST':
        $validation = validateInput($inputJSON);
        if ($validation !== true) {
            echo json_encode(["success" => false, "message" => $validation]);
            exit;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
            $stmt->execute([trim($inputJSON['name']), $inputJSON['price'], $inputJSON['stock']]);
            echo json_encode(["success" => true, "message" => "Thêm sản phẩm thành công."]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Lỗi thêm dữ liệu: " . $e->getMessage()]);
        }
        break;

    // Cập nhật sản phẩm theo id trên URL
    case 'PUT':
        if (!isset($_GET['id'])) {
            echo json_encode(["success" => false, "message" => "Thiếu id sản phẩm trên URL."]);
            exit;
        }
        $id = $_GET['id'];

        if (!productExists($pdo, $id)) {
            echo json_encode(["success" => false, "message" => "Sản phẩm cần sửa không tồn tại."]);
            exit;
        }

        $validation = validateInput($inputJSON);
        if ($validation !== true) {
            echo json_encode(["success" => false, "message" => $validation]);
            exit;
        }

        try {
            $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");
            $stmt->execute([trim($inputJSON['name']), $inputJSON['price'], $inputJSON['stock'], $id]);
            echo json_encode(["success" => true, "message" => "Cập nhật sản phẩm thành công."]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Lỗi cập nhật dữ liệu: " . $e->getMessage()]);
        }
        break;

    // Xóa sản phẩm theo id trên URL
    case 'DELETE':
        if (!isset($_GET['id'])) {
            echo json_encode(["success" => false, "message" => "Thiếu id sản phẩm trên URL."]);
            exit;
        }
        $id = $_GET['id'];

        if (!productExists($pdo, $id)) {
            echo json_encode(["success" => false, "message" => "Sản phẩm cần xóa không tồn tại."]);
            exit;
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(["success" => true, "message" => "Xóa sản phẩm thành công."]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Lỗi xóa dữ liệu: " . $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Phương thức không được hỗ trợ."]);
        break;
}
?>