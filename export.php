<?php
// connection to Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "you_do";

$connect = mysqli_connect($servername, $username, $password, $database);

$sql = "SELECT * FROM tasks";
$result = mysqli_query($connect,$sql);
if (!mysqli_query($connect, $sql)) {
    echo "Error" . mysqli_error($connect);
}

$html = '<table><tr><td>ID</td><td>Task</td><td>Details</td><td>Dated</td></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<table><tr><td>' . $row['id'] . '</td><td> '. $row["task"] . '</td><td>'. $row["detail"] . '</td><td>' . $row["dated"] .'</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=report.xls');
echo $html; 
?>