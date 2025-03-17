<?php
displayHeader();

$id = $_GET['id'];
$sql = "SELECT sv.*, nh.TenNganh 
        FROM SinhVien sv 
        LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
        WHERE sv.MaSV='$id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    echo '<div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-danger text-white text-center">
                <h3>Xác nhận xóa sinh viên</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning text-center">
                    <strong>Bạn có chắc chắn muốn xóa sinh viên này không?</strong>
                </div>
                
                <div class="p-3">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="bg-light">Mã sinh viên:</th>
                            <td>' . $row['MaSV'] . '</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Họ tên:</th>
                            <td>' . $row['HoTen'] . '</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Ngành học:</th>
                            <td>' . $row['TenNganh'] . '</td>
                        </tr>
                    </table>
                </div>

                <div class="text-center">
                    <form action="index.php?action=destroy" method="post">
                        <input type="hidden" name="MaSV" value="' . $row['MaSV'] . '">
                        <input type="hidden" name="current_image" value="' . $row['Hinh'] . '">
                        <button type="submit" class="btn btn-danger px-4">Xóa</button>
                        <a href="index.php" class="btn btn-secondary px-4">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>';
    
} else {
    echo '<div class="alert alert-danger text-center">Không tìm thấy sinh viên</div>';
}

displayFooter();
?>
