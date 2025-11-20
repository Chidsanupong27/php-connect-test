<?php
$serverName = "localhost"; 
$connectionOptions = [
    "Database" => "Testtop", 
    "Uid"      => "sa",       
    "PWD"      => "12345678", 
];

echo "Hello world";

$conn = sqlsrv_connect($serverName, $connectionOptions);


if ($conn === false) {
    die("Connection failed:<br>" . print_r(sqlsrv_errors(), true));
}


$sql = "SELECT p_id, p_name, p_price FROM Test_top"; 
$stmt = sqlsrv_query($conn, $sql);


if ($stmt === false) {
    die("Query failed:<br>" . print_r(sqlsrv_errors(), true));
}


echo "<h1>PHP + SQL Server OK!</h1>";
echo "<ul>";
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

    echo "<li>ID: {$row['p_id']}, Name: {$row['p_name']}, Price: {$row['p_price']}</li>";
}
echo "</ul>";


sqlsrv_free_stmt($stmt);


sqlsrv_close($conn);
?>
