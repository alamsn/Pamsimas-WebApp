<?php
include '../../inc/koneksi.php';
require '../../vendor/autoload.php';

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
        $id_pelanggan = $sheetData[$i]['0'];
        $nama_pelanggan = $sheetData[$i]['1'];
        $alamat = $sheetData[$i]['2'];
        $no_hp = $sheetData[$i]['3'];
        $id_layanan = $sheetData[$i]['4'];
        $username = $sheetData[$i]['5'];
        $password = $sheetData[$i]['6'];
        $sql_simpan = "INSERT INTO tb_pelanggan (id_pelanggan,nama_pelanggan, alamat, no_hp, id_layanan, status) VALUES ('$id_pelanggan','$nama_pelanggan','$alamat','$no_hp', $id_layanan, 'Aktif')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_query($koneksi, "INSERT INTO tb_user (nama_user,level,no_hp,no_rek,username,password) VALUES ( '$nama_pelanggan','Pelanggan','$no_hp','$id_pelanggan', '$username','$password')");
    }
    header("location:../../index.php?");
}
