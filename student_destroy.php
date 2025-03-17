<?php
$maSV = $_POST['MaSV'];
$current_image = $_POST['current_image'];

// Xóa hình ảnh nếu có
if(!empty($current_image)) {
    $target_dir = "images/";
    $image_path = $target_dir . $current_image;
    if(file_exists($image_path)) {
        unlink($image_path);
    }
}

// Trước khi xóa sinh viên, cần xóa các bản ghi liên quan trong bảng DangKy và ChiTietDangKy
// Lấy các MaDK liên quan đến sinh viên này
$sql = "SELECT MaDK FROM DangKy WHERE MaSV='$maSV'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $maDK = $row['MaDK'];
        // Xóa các chi tiết đăng ký
        $sql_delete_ctdk = "DELETE FROM ChiTietDangKy WHERE MaDK='$maDK'";
        $conn->query($sql_delete_ctdk);
    }
    // Xóa đăng ký
    $sql_delete_dk = "DELETE FROM DangKy WHERE MaSV='$maSV'";
    $conn->query($sql_delete_dk);
}

// Cuối cùng xóa sinh viên
$sql = "DELETE FROM SinhVien WHERE MaSV='$maSV'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
?>