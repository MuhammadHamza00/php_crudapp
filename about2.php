<?php
    if (isset($_POST["submit"])) {
        $num_files = count($_FILES['images']['name']);
        echo $num_files;
        // Loop through all uploaded files
        for ($i = 0; $i < $num_files; $i++) {
            // Get the name, size, type, and temporary location of the current file
            $file_name = $_FILES['images']['name'][$i];
            $file_size = $_FILES['images']['size'][$i];
            $file_type = $_FILES['images']['type'][$i];
            $file_tmp = $_FILES['images']['tmp_name'][$i];
            // Do any necessary validation or processing on the current file
            // For example, you could check if the file is an image and has a valid size

            // Move the file from its temporary location to your desired location
            move_uploaded_file($file_tmp, "uploadsto/" . $file_name);

            // Display a message to indicate that the file was uploaded
            echo $file_name . " was uploaded successfully.<br>";
        }
    }
    ?>