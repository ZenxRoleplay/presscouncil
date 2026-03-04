<?php
$host     = getenv('MYSQLHOST')     ?: 'localhost';
$user     = getenv('MYSQLUSER')     ?: 'sahil';
$password = getenv('MYSQLPASSWORD') ?: 'Pcm66220666*';
$database = getenv('MYSQLDATABASE') ?: 'pcm_website';
$port     = (int)(getenv('MYSQLPORT') ?: 3306);

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>