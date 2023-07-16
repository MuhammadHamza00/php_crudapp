<?php
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
$check = 0;
// mysqli_close($connect);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>You Doo!</title>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();
            // alert(input);
            if (input != "") {
                $.ajax({
                    url :"livesearch.php",
                    method:"POST",
                    data:{input:input},
                    success:function(data){
                        $("#search_results").html(data);
                        $("#search_results").css("display","block");

                    }
                });
            }
            else{
                $("#search_results").css("display","none");
            }
        });
    });
</script>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light  sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">You Doo!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="crudapp.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactform.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">My Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="display.php">Employees</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Messages -->
    <!-- <div class="alert alert-primary" role="alert">
        A simple primary alert—check it out!
    </div> -->
    <!-- Forms -->
    <?php
    $task = $des = "";
    $taskErr = $desErr = "";
    //task detail dated
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["content"])) {
            $taskErr = "Empty Field";
        } else {
            $task = $_POST["content"];
        }
        if (empty($_POST["detail"])) {
            $desErr = "Empty Field";
        } else {
            $des = $_POST["detail"];
        }
    }
    if (!empty($task) && !empty($des)) {
        $sql = "INSERT INTO `tasks` (`id`, `task`, `detail`, `dated`) VALUES ('', '$task', '$des',NOW())";
    } else {
        echo "<div class='alert alert-primary' role='alert'>Fields Required!</div>";
    }
    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-primary' role='alert'>Succesfully Item Added!</div>";
    }

    ?>
    <div class="container mt-5 mb-3 p-5" style="border: 1px solid #e3f2fd; border-radius:2rem;">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="text" class="form-label">Title</label>
                <input type="text" class="form-control" id="name" name="content" aria-describedby="textHelp">
                <span class="error"><?php echo $taskErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Description</label>
                <textarea class="form-control mt-2" placeholder="Enter Description" id="floatingTextarea2" name="detail" style="height: 100px"></textarea>
                <span class="error"><?php echo $desErr; ?></span>

            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size:1rem">Add Note</button>
        </form>
    </div>
    <!-- Notes -->
    <!-- Ajax search method -->
    <?php
    ?>
    <?php
    function Display($result)
    {
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
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
        } else {
            echo "0 results";
        }
    }
    ?>

 
    <div class="container p-10 mb-5 p-5" style="border:2px solid #e3f2fd;border-radius:2rem;">
        <table class="table ">
            <div class="container" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
                <input type="text" class="form-control me-2 mb-2" placeholder="Search Here!" size="30"id="live_search">
                <div id="search_results"></div>
            </div>
            <thead>
                <tr>
                    <th scope="col">Task Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Dated On</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT * FROM tasks";
            $result = mysqli_query($connect, $sql);
            if (!$result) {
                echo "Facing  Errors" . "<br>";
            }
            Display($result);
            ?>
        </table>
        <form action="export.php" method="POST" enctype="multipart/form-data">
            <button type="submit"class="btn btn-success"name="export_file_btn">Export</button>
        </form>
        <!-- <a href="code.php"><button type="button"class="btn btn-success">Export</button></a> -->
        <form action="imex/importcrud.php" method="POST" enctype="multipart/form-data">
            <input type="file"name="import_file"class="form-control mt-3">
            <button type="submit"class="btn btn-primary"name="import_file_btn"style="margin-top:1rem;">Import</button>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
<?php
mysqli_close($connect);
?>