<?php
// include database connection file
// connection to Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "you_do";

$connect = mysqli_connect($servername, $username, $password, $database);

// Created Succesfully
// $sql = "CREATE DATABASE you_do";
$sql = "CREATE TABLE IF NOT EXISTS tasks(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(20) NOT NULL,
    detail VARCHAR(50),
    dated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!mysqli_query($connect, $sql)) {
    echo "Error" . mysqli_error($connect);
}

// Get id from URL to delete that user
$id = $_GET['id'];

// Delete user row from table based on given id
$result = mysqli_query($connect, "DELETE FROM tasks WHERE id=$id");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:crudapp.php");
?>