<?php
include "config.php";
require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;



if (isset($_POST['export_btn'])) {
    $filename = "sheet" .time();
    $ext = $_POST['export_file_type'];
    echo $ext;
    $query = "SELECT * FROM register_form";
    $query_run = mysqli_query($connect,$query);

    if (mysqli_num_rows($query_run) > 0) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'f_name');
        $sheet->setCellValue('C1', 'l_name');
        $sheet->setCellValue('D1', 'u_name');
        $sheet->setCellValue('E1', 'email');
        $sheet->setCellValue('F1', 'country');
        $sheet->setCellValue('G1', 'state');
        $sheet->setCellValue('H1', 'city');
        $sheet->setCellValue('I1', 'join_date');
        $sheet->setCellValue('J1', 'age');
        $sheet->setCellValue('K1', 'gender');

        $rowCount = 2;

        foreach ($query_run as $data) {
            $sheet->setCellValue('A'. $rowCount, $data['id']);
            $sheet->setCellValue('B'. $rowCount, $data['f_name']);
            $sheet->setCellValue('C'. $rowCount, $data['l_name']);
            $sheet->setCellValue('D'. $rowCount, $data['u_name']);
            $sheet->setCellValue('E'. $rowCount, $data['email']);
            $sheet->setCellValue('F'. $rowCount, $data['country']);
            $sheet->setCellValue('G'. $rowCount, $data['state']);
            $sheet->setCellValue('H'. $rowCount, $data['city']);
            $sheet->setCellValue('I'. $rowCount, $data['join_date']);
            $sheet->setCellValue('J'. $rowCount, $data['age']);
            $sheet->setCellValue('K'. $rowCount, $data['gender']);
            $rowCount++;
        }
        if ($ext == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
            $final_name =  $filename .'.xlsx';
            
        } else if($ext == 'xls') {
            $writer = new Xls($spreadsheet);
            $final_name =  $filename .'.xls';
        }
        else if($ext == 'csv'){
            $writer = new Csv($spreadsheet);
            $final_name =  $filename .'.csv';
        }
        header('Content-Type:application/vmd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition:attachment;filename="'. urldecode($final_name).'"');
        $writer->save('php://output');
        // $writer->save('$final_name');
    }
    else{
        header("Location : display.php");
    }
}
?>