<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "pblvoting";

$conn = mysqli_connect($server , $username, $password, $database);
if (!$conn)
{
    die("Database connection failed.");
}

mysqli_set_charset($conn, 'utf8mb4');
?>