<?php
//kode 9 digit

$carikode = mysqli_query($koneksi, "SELECT id_pakai FROM tb_pakai order by id_pakai desc");
$datakode = mysqli_fetch_array($carikode);
$kode = $datakode['id_pakai'];
$urut = substr($kode, 1, 9);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "K" . "00000000" . $tambah;
} else if (strlen($tambah) == 2) {
    $format = "K" . "0000000" . $tambah;
} else if (strlen($tambah) == 3) {
    $format = "K" . "000000" . $tambah;
} else if (strlen($tambah) == 4) {
    $format = "K" . "00000" . $tambah;
} else if (strlen($tambah) == 5) {
    $format = "K" . "0000" . $tambah;
} else if (strlen($tambah) == 6) {
    $format = "K" . "000" . $tambah;
} else if (strlen($tambah) == 7) {
    $format = "K" . "00" . $tambah;
} else if (strlen($tambah) == 8) {
    $format = "K" . "0" . $tambah;
} else if (strlen($tambah) == 9) {
    $format = "K" . $tambah;
}
