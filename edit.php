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
$check = 0;
// mysqli_close($connect);


// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{
	$id = $_POST['id'];
	$task=$_POST['task'];
	$des=$_POST['des'];

	// update user data
	$result = mysqli_query($connect, "UPDATE tasks SET task='$task',detail='$des' WHERE id=$id");

	// Redirect to homepage to display updated user in list
	header("Location: crudapp.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($connect, "SELECT * FROM tasks WHERE id=$id");

while($user_data = mysqli_fetch_array($result))
{
	$task = $user_data['task'];
	$des = $user_data['detail'];

}
?>
<html>
<head>
	<title>Edit User Data</title>
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>You Doo!</title>
</head>
</head>

<body>
	<br/><br/>
	<div class="container mt-5 mb-3 p-5" style="border: 1px solid #e3f2fd; border-radius:2rem;">
      	<form name="update_user" method="post" action="edit.php">
            <div class="mb-3">
                <label for="text" class="form-label">Title</label>
				<input type="text" name="task" class="form-control" value=<?php echo $task;?>>

            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Description</label>
				<!-- <input type="text" name="des" value=<?php echo $des;?> class="form-control mt-2" placeholder="Enter Description" > -->
                <textarea class="form-control mt-2" placeholder="Enter Description" id="floatingTextarea2" name="des" style="height: 100px"><?php echo $des;?></textarea>
            </div>
            <input type="submit" name="update" value="Update">
			<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
        </form>
    </div>
</body>
</html>