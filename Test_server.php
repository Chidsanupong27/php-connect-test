<?php
// กำหนดชื่อเซิร์ฟเวอร์ และข้อมูลการเชื่อมต่อ
$serverName = "LAPTOP-0K2FO98U\SQLEXPRESS"; // หรือใช้ "127.0.0.1" หรือชื่อเซิร์ฟเวอร์ของคุณ
$connectionOptions = [
    "Database" => "Test_top",  // ชื่อฐานข้อมูลที่ต้องการเชื่อมต่อ
    "TrustServerCertificate" => true, // อนุญาตให้เชื่อมต่อได้แม้ไม่มีใบรับรอง
    "ConnectionPooling" => true // เปิดใช้งาน Connection Pooling เพื่อประสิทธิภาพ
];

// เชื่อมต่อไปยัง SQL Server โดยใช้ Windows Authentication
$conn = sqlsrv_connect($serverName, $connectionOptions);

// เช็คการเชื่อมต่อ
if ($conn === false) {
    die("Connection failed:<br>" . print_r(sqlsrv_errors(), true));
}

echo "Hello world";

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง dbo.Products
$sql = "SELECT p_id, p_name, p_price FROM dbo.Products"; 
$stmt = sqlsrv_query($conn, $sql);

// ตรวจสอบว่าคำสั่ง SQL สำเร็จหรือไม่
if ($stmt === false) {
    die("Query failed:<br>" . print_r(sqlsrv_errors(), true));
}

// แสดงผลลัพธ์
echo "<h1>PHP + SQL Server OK!</h1>";
echo "<ul>";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<li>ID: {$row['p_id']}, Name: {$row['p_name']}, Price: {$row['p_price']}</li>";
}
echo "</ul>";

// ปิด statement และการเชื่อมต่อ
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
