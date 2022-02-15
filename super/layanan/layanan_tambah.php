<?php
include "inc/koneksi.php";
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <b>Tambah Layanan</b>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">

                    <div class="form-group">
                        <label>Nama Layanan</label>
                        <input class="form-control" name="nama_layanan" placeholder="Masukkan nama layanan"/>
                    </div>

                    <div class="form-group">
                        <label>Tarif Dasar Per Meter</label>
                        <input class="form-control" name="tarif_dasar" placeholder="Masukkan tarif layanan"/>
                    </div>

                    <div class="form-group">
                        <label>Tarif Setelah 10 M <sup> 3</sup></label>
                        <input class="form-control" name="tarif_1" placeholder="Masukkan tarif layanan"/>
                    </div>

                    <div class="form-group">
                        <label>Tarif Setelah 20 M <sup> 3</sup></label>
                        <input class="form-control" name="tarif_2" placeholder="Masukkan tarif layanan"/>
                    </div>

                    <div class="form-group">
                        <label>Biaya Admin</label>
                        <input class="form-control" name="admin" placeholder="Masukkan tarif layanan"/>
                    </div>

                    <div>
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-success" >
                        <a href="?halaman=layanan_tampil" title="Kembali" class="btn btn-default">Batal</a>
                    </div>
            </div>
            </form>
        </div>

    </div>
</div>
</div>


<?php

if (isset($_POST['Simpan'])) {
    //mulai proses simpan data
    $sql_simpan = "INSERT INTO tb_layanan (layanan, tarif_dasar, tarif_1, tarif_2, admin) VALUES (
        '" . $_POST['nama_layanan'] . "',
        '" . $_POST['tarif_dasar'] . "',
        '" . $_POST['tarif_1'] . "',
        '" . $_POST['tarif_2'] . "',
        '" . $_POST['admin'] . "'
        )";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    if ($query_simpan) {
        echo "<script>alert('Simpan Berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?halaman=layanan_tampil'>";
    } else {
        echo "<script>alert('Simpan Gagal')</script>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?halaman=layanan_tampil'>";
    }
    //selesai proses simpan data
}

?>