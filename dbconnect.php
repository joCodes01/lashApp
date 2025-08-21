<?php

$conn = new mysqli("localhost", "root", "", "lashapp");

if($conn->connect_error) {
    die("Something went wrong. Please try again later." . $conn->connect_error);
}else{
    // echo "Database is connected";
}
?>