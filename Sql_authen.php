<?php
// ตั้งค่าการเชื่อมต่อ SQL Server
$serverName = "LAPTOP-0K2FO98U\SQLEXPRESS";  // หรือใช้ "127.0.0.1" หรือชื่อเซิร์ฟเวอร์ของคุณ
$connectionOptions = [
    "Database" => "Test_top",  // ชื่อฐานข้อมูล
    "Uid" => "sa",             // ชื่อผู้ใช้เป็น sa
    "PWD" => "GKm/Zv1HqZSRHK6hOQ6fOz5XpVy2Im6w7XLfPWKOHkg=",       // รหัสผ่านที่ตั้งไว้สำหรับ sa
    "TrustServerCertificate" => true, // อนุญาตให้เชื่อมต่อได้แม้ไม่มีใบรับรอง
    "ConnectionPooling" => true // เปิดใช้งาน Connection Pooling
];

// เชื่อมต่อไปยัง SQL Server โดยใช้ SQL Authentication
$conn = sqlsrv_connect($serverName, $connectionOptions);

// เช็คการเชื่อมต่อ
if ($conn === false) {
    die("Connection failed:<br>" . print_r(sqlsrv_errors(), true));
}

echo "Connected successfully to SQL Server";

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
