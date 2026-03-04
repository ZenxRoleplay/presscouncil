<?php
$servername = getenv('MYSQLHOST')     ?: 'localhost';
$username   = getenv('MYSQLUSER')     ?: 'sahil';
$password   = getenv('MYSQLPASSWORD') ?: 'Pcm66220666*';
$dbname     = getenv('MYSQLDATABASE') ?: 'pcm_website';
$dbport     = (int)(getenv('MYSQLPORT') ?: 3306);

$conn = new mysqli($servername, $username, $password, $dbname, $dbport);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>