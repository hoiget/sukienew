<?php

// Không có bất kỳ ký tự hoặc khoảng trắng nào ở đây


// Mã PHP của bạn ở đây


// Import thư viện cần thiết
require_once './tcpdf/tcpdf.php';

include_once("./api/connect.php");

// Kiểm tra và lấy ID hóa đơn
$id = $_GET['xuathoadon'] ?? null;

if (!$id || !is_numeric($id)) {
    die("ID hóa đơn không hợp lệ.");
}

// Lấy dữ liệu hóa đơn từ cơ sở dữ liệu
$sql = "SELECT hoadon.*, users.username, users.phone_number, users.hoten, users.address 
        FROM hoadon 
        INNER JOIN users ON hoadon.Iduser = users.id 
        WHERE hoadon.Idhd = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (empty($data)) {
    die("Không tìm thấy hóa đơn.");
}

// Tạo nội dung HTML cho PDF
$htmlContent = '<html>
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn bán hàng</title>
    <style>
        body { font-family: "DejaVu Sans", Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">HÓA ĐƠN</h3>
    <hr>
    <p>Tên khách hàng: ' . htmlspecialchars($data['username']) . '</p>
    <p>Địa chỉ: ' . htmlspecialchars($data['address']) . '</p>
    <p>SĐT: ' . htmlspecialchars($data['phone_number']) . '</p>
    <table>
        <tr>
            <th><b>Nội dung hóa đơn</b></th>
            <th><b>Số tiền</b></th>
        </tr>
        <tr>
            <td>' . htmlspecialchars($data['Noidunghoadon']) . '</td>
            <td>' . htmlspecialchars($data['sotien']) . '</td>
        </tr>
    </table>
    <p>Thời gian Thanh toán: ' . htmlspecialchars($data['Thoigian']) . '</p>
</body>
</html>';
error_reporting(0);
ini_set('display_errors', 0);
// Tạo file PDF và gửi về trình duyệt
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Hóa đơn bán hàng');
$pdf->AddPage();
$pdf->writeHTML($htmlContent, true, false, true, false, '');

// Đặt tên file khi tải về
$fileName = 'hoadon_' . $id . '.pdf';
ob_clean();
// Xuất file PDF trực tiếp đến trình duyệt để tải về
$pdf->Output($fileName, 'D');

// Đóng kết nối
$conn->close();
exit();
?>
