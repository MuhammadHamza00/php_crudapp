<?php
include("config.php");
if (isset($_POST["input"])) {
    $input = $_POST['input'];

    $query = "SELECT * FROM tasks WHERE task LIKE '{$input}%'";

    $result = mysqli_query($connect,$query);
    echo "  <table class='table '> <thead>
    <tr>
        <th scope='col'>Task Id</th>
        <th scope='col'>Title</th>
        <th scope='col'>Description</th>    
        <th scope='col'>Dated On</th>
        <th scope='col'>Action</th>
    </tr>
    </thead>";
    if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <th scope='row'>" . $row['id'] . "</th>" .
                "<td>" . $row["task"] . "</td>" .
                "<td>" . $row["detail"] . "</td>" .
                "<td>" . $row["dated"] . "</td>" .
                "<td>" . "<a  class='btn btn-primary' href='edit.php?id=$row[id]'>Edit</a>" 
                . "<a class='btn btn-danger' href='del.php?id=$row[id]'>Delete</a>" . "</td>" .
                "</tr>";
        }
        echo "</table>";

    }
    else{
        echo "<h6 class='danger'>No Data Matched!</h6>";
    }
}
?>