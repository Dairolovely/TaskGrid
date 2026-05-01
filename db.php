<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "taskgrid";

// Using $conn and MySQLi as requested by your teacher
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>