<?php

$id = $_GET['id'];

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

    $sql = "DELETE FROM baiviet where id=".$id;
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo json_encode([
            'success' => true
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => "Error: " . $sql . " - " . $conn->error
        ]);
    }
}
$conn->close(); ?>