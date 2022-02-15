<?php
// menghubungkan dengan koneksi
include '../../inc/koneksi.php';
// menghubungkan dengan library excel reader
include "../../inc/excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['filepelanggan']['name']);
move_uploaded_file($_FILES['filepelanggan']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filepelanggan']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepelanggan']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 1; $i <= $jumlah_baris; $i++) {

    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $id_pelanggan = $data->val($i, 0);
    $nama_pelanggan = $data->val($i, 1);
    $alamat = $data->val($i, 2);
    $no_hp = $data->val($i, 3);
    $id_layanan = $data->val($i, 4);
    $username = $data->val($i, 5);
    $password = $data->val($i, 6);
    // input data ke database (table data_pelanggan)
    $sql_simpan = "INSERT INTO tb_pelanggan (id_pelanggan,nama_pelanggan,alamat,no_hp,id_layanan) VALUES ('$id_pelanggan','$nama_pelanggan','$alamat','$no_hp')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    $sql_simpan_1 = "INSERT INTO tb_user (nama_user,username,password,level,no_hp,no_rek) VALUES ( '$nama_pelanggan', '$username','$password','Pelanggan','$no_hp','$id_pelanggan')";
    $query_simpan_1 = mysqli_query($koneksi, $sql_simpan_1);
    $berhasil++;

}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepelanggan']['name']);

// alihkan halaman ke index.php
header("location:../../index.php?berhasil=$berhasil");
?>