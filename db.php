<?php
$conn = new mysqli("localhost","root","","attendance_db");

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}
?>