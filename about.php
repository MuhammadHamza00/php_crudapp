<?php
// connection to Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "you_do";

// $connect = mysqli_connect($servername, $username, $password, $database);
$connect = mysqli_connect("localhost", "root", "", "image_upload");

// Created Succesfully
// $sql = "CREATE DATABASE you_do";
$sql = "CREATE TABLE IF NOT EXISTS gallery(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename varchar(100) NOT NULL
)";

if (!mysqli_query($connect, $sql)) {
    echo "Error" . mysqli_error($connect);
}

$msg = "";
if (isset($_POST['upload'])) {
    $images = $_FILES['image']['name'];
    echo "in isset";
    $fileNames = array_filter($_FILES['image']['name']); 
    foreach ($_FILES['image']['name'] as $key=>$val) {
        // Get image name
        $image = basename($_FILES['image']['name'][$key]); 
        // $image = $images['name'][$key];
        echo "count";
        $sql = "INSERT INTO `gallery` (`filename`) VALUES ('$image');";
        
        $target = "uploadsto/" . basename($_FILES['image']['name'][$key]);
        mysqli_query($connect, $sql);
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target)) {
            $msg = "Image uploaded successfully";
    
        } else {
            $msg = "Failed to upload image";
        }
    }
}

$result = mysqli_query($connect, "SELECT * FROM gallery");

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container mt-5"style="border: 1px solid #e3f2fd; border-radius:2rem;padding:2rem;">
        <form enctype="multipart/form-data" action="about.php" method="POST">
                <label for="file" class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="image[]" multiple>
                <button type="submit" class="btn btn-primary" style="font-size:1rem;margin-top:1rem;" name="upload">Upload</button>
            </form>
    </div>


    <div class="container"style="display:flex-box;flex-direction:column;border: 1px solid #e3f2fd; border-radius:2rem;padding:2rem;margin:2rem;">
        <?php
        while ($row = mysqli_fetch_array($result)) {

            echo "<img style='width:20rem;'class='img-thumbnail' src='uploadsto/" . $row['filename'] . "' >";

            // echo '<button type="submit">Delete</button>';
        }
        ?>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <?php
    mysqli_close($connect);
    ?>
</body>

</html>