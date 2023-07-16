<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
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
    <div class="container">

        <h2>All Registered Employee</h2>
    </div>
    <div class="container p-10 mb-5 p-5" style="border:2px solid #e3f2fd;border-radius:2rem;">
        <table class="table ">
            <div class="container" style="display:flex;flex-direction:column;justify-content:center;align-items:center;">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">City</th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                    </tr>
                </thead>
            </div>
            <?php

            function Display($result)
            {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <th scope='row'>" . $row['id'] . "</th>" .
                            "<td>
                            <div id='img_div'style='border:2px solid grey'>
                                <img style='width:5rem;height:5rem;' src='uploadsto/" . $row['p_img'] . "' >
                            </div>
                            </td>" .
                            "<td>" . $row["f_name"] . "</td>" .
                            "<td>" . $row["l_name"] . "</td>" .
                            "<td>" . $row["u_name"] . "</td>" .
                            "<td>" . $row["email"] . "</td>" .
                            "<td>" . $row["country"] . "</td>" .
                            "<td>" . $row["state"] . "</td>" .
                            "<td>" . $row["city"] . "</td>" .
                            "<td>" . $row["join_date"] . "</td>" .
                            "<td>" . $row["age"] . "</td>" .
                            "<td>" . $row["gender"] . "</td>" .
                            "<td>" . "<a  class='btn btn-primary' href='edit.php?id=$row[id]'>Edit</a>"
                            . "<a class='btn btn-danger' href='del.php?id=$row[id]'>Delete</a>" . "</td>" .
                            "</tr>";
                    }
                } else {
                    echo "0 results";
                }
            }
            $sql = "SELECT * FROM register_form";
            $result = mysqli_query($connect, $sql);
            if (!$result) {
                echo "Facing  Errors" . "<br>";
            }
            Display($result);
            ?>
        </table>
        <div class="col-md-6 ">
            <form action="imex/export.php" method="POST" enctype="multipart/form-data">
                <div class="row m-2">
                    <div class="col-md-6  mb-2">
                        <select name="export_file_type" id="export" class="form-control" required>
                            <option value="">Select</option>
                            <option value="xlsx">xlsx</option>
                            <option value="csv">csv</option>
                            <option value="xls">xls</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" name="export_btn">Export</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 ">
            <form action="imex/import.php" method="POST" enctype="multipart/form-data">
                <div class="row m-2">
                    <div class="col-md-6">
                        <input type="file" name="import_file" id=""class="form-control mb-3">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary" name="import_btn">Import</button>
                    </div>
                </div>
            </form>
        </div>

</body>

</html>