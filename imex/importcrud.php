<?php
// connection to Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "you_do";

$connect = mysqli_connect($servername, $username, $password, $database);


if (!($connect)) {
    echo "Error";
}
?>
<?php
require 'vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// if ($_POST['export_file_btn'] !== null) {
//     $filename = "sheet" . time();

//     $query = "SELECT * FROM tasks";
//     $query_run = mysqli_query($connect, $query);

//     if (mysqli_num_rows($query_run) > 0) {
//         $spreadsheet = new Spreadsheet();
//         $sheet = $spreadsheet->getActiveSheet();
//         $sheet->setCellValue('A1', 'ID');
//         $sheet->setCellValue('B1', 'task');
//         $sheet->setCellValue('C1', 'detail');
//         $sheet->setCellValue('D1', 'date');

//         $rowCount = 2;
//         foreach ($query_run as $data) {
//             $sheet->setCellValue('A' . $rowCount , $data['id']);
//             $sheet->setCellValue('B' . $rowCount , $data['task']);
//             $sheet->setCellValue('C' . $rowCount , $data['detail']);
//             $sheet->setCellValue('D' . $rowCount , $data['dated']);
//             $rowCount++;
//         }

//         $writer = new Xlsx($spreadsheet);
//         $final_name =  $filename . '.xls';
//         header('Content-Type:application/xls');
//         header('Content-Disposition:attachment;filename="'. urldecode($final_name).'"');
//         $writer->save('php://output');
//         // $writer->save($final_name); to store file in directory
//     } else {
//         echo "Unsuccessful";
//     }
// }

if (isset($_POST['import_file_btn'])) {
    $allowed = ['xls', 'csv', 'xlsx'];

    $filename = $_FILES['import_file']['name'];
    $check = explode(".", $filename);
    $file_ext = end($check);

    if (in_array($file_ext, $allowed)) {
        $targetPath = $_FILES['import_file']['tmp_name'];
        /** Load $inputFileName to a Spreadsheet object **/

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data  = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            $id = $row['0'];
            $task = $row['1'];
            $detail = $row['2'];
            $date = $row['3'];

            $check_task =  "SELECT * FROM tasks WHERE id = '$id'";
            $result = mysqli_query($connect, $check_task);
            if (mysqli_num_rows($result)  > 0) {
                // Already so update
                $up_query = "UPDATE tasks SET task = '$task',detail = '$detail' dated = '$date'";
                $up_result = mysqli_query($connect, $up_query);
                $msg = 1;
            } else {
                // new record
                $in_query = "INSERT INTO `tasks` (`id`, `task`, `detail`, `dated`) VALUES ('$id', '$task', '$detail', '$date');";
                $in_result = mysqli_query($connect, $in_query);
                $msg = 2;
            }
        }
        if (isset($msg)) {
            header("Location: ../crudapp.php");

        } else {
            echo "Unsuccessful";
        }
    } else {
        header("Location: ../crudapp.php");
        exit(0);
    }
    // require 'vendor/autoload.php';

    // $file = $_FILES['doc']['tmp_name'];

    // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    // $spreadsheet = $reader->load($file);

    // foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
    //     echo $worksheet->getTitle();
    // }
}
?>
