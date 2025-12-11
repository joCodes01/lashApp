<?php
include 'config.php';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if($conn->connect_error) {
    die("Something went wrong. Please try again later." . $conn->connect_error);
}else{
    // echo "Database is connected";
}
?>