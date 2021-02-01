<?php

$id = $_GET['id'];
$title = $_POST['title'];
$image = $_POST['image'];

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
} else {
    $conn->set_charset("utf8");

    $sql = "UPDATE baiviet set tieude='".$title."', hinhanh='".$image."' where id=".$id;
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "Update successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close(); ?>