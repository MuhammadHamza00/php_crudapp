<?php
include "config.php";
require 'vendor/autoload.php';


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;


if (isset($_POST['import_btn'])) {
    $allowed_ext = ["xls","csv","xlsx"];
    $filename = $_FILES['import_file']['name'];
    $checking = explode(".",$filename);
    $file_ext = end($checking);

    if (in_array($file_ext,$allowed_ext)) {
        $targetPath = $_FILES['import_file']['tmp_name'];
        /** Load $inputFileName to a Spreadsheet object **/

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data  = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            $id = $row['0'];
            $f_name = $row['1'];
            $l_name = $row['2'];
            $u_name = $row['3'];
            $email = $row['4'];
            $country = $row['5'];
            $state = $row['6'];
            $city = $row['7'];
            $join_date = $row['8'];
            $age = $row['9'];
            $gender = $row['10'];
            echo '<alert>'.'Date'.$join_date.'</alert>';
            
            $check_task =  "SELECT * FROM register_form WHERE id = '$id'";
            $result = mysqli_query($connect, $check_task);
            if (mysqli_num_rows($result)  > 0) {
                // Already so update
                $up_query = "UPDATE register_form SET f_name='$f_name',l_name='$l_name',email='$email',country='$country',state='$state',city='$city',join_date='$join_date',age='$age',gender='$gender' WHERE id = '$id'";
                $up_result = mysqli_query($connect, $up_query);
                $msg = 1;
            } else {
                // new record
                $in_query = "INSERT INTO `register_form` (`id`, `f_name`, `l_name`, `u_name`, `email`, `country`, `state`, `city`, `join_date`, `age`, `gender`) VALUES ('$id', '$f_name', '$l_name', '$u_name', '$email', '$country', '$state', '$city', '$join_date', '$age', '$gender');";
                $in_result = mysqli_query($connect, $in_query);
                $msg = 2;
            }

        }
        if (isset($msg)) {
            header("Location: ../display.php");
        } else {
            echo '<alert>'.'Error in it'.'</alert>';
        }
    }
    else{
        header("Location: ../display.php");
    }
}

?>