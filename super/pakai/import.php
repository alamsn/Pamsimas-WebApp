
<?php
include '../../inc/koneksi.php';
require '../../vendor/autoload.php';
include "../../inc/kode.php";

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    for ($i = 1; $i < count($sheetData); $i++) {
        $id_pakai = $sheetData[$i]['0'];
        $id_pelanggan = $sheetData[$i]['1'];
        $id_bulan = $sheetData[$i]['2'];
        $tahun = $sheetData[$i]['3'];
        $awal = $sheetData[$i]['4'];
        $akhir = $sheetData[$i]['5'];
        $sql_import = "INSERT INTO tb_pakai (id_pakai,id_pelanggan, id_bulan, tahun, awal, akhir) VALUES ('$id_pelanggan','$id_bulan', '$tahun',$awal, $akhir)";
    }
    header("location:../../index.php?");
}

?>

