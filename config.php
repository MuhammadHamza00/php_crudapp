<?php
// connection to Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "you_do";

$connect = mysqli_connect($servername, $username, $password, $database);

// Created Succesfully
// $sql = "CREATE DATABASE you_do";
if (!$connect) {
    echo "Unable to Connect with Database".$database;
}
// if (!mysqli_query($connect, $sql)) {
//     echo "Error" . mysqli_error($connect);
// }

?>