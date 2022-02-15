<?php

if (isset($_GET['kode'])) {
    $sql_cek = "select p.id_pelanggan, p.nama_pelanggan, t.id_tagihan, t.tagihan, t.status, k.tahun, k.pakai, b.nama_bulan
        from tb_pelanggan p inner join tb_pakai k on p.id_pelanggan=k.id_pelanggan
        inner join tb_tagihan t on k.id_pakai=t.id_pakai
        inner join tb_bulan b on k.bulan=b.id_bulan
        where t.id_tagihan='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}

$tanggal = date("Y-m-d");

?>

<div class="row">
<div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <b>Pembayaran tagihan</b>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">

                                    <tbody>
                                    <br>
                                        <tr>
                                            <td>ID | Nama Plg</td>
                                            <td width="80%">: <?php echo $data_cek['id_pelanggan']; ?> - <?php echo $data_cek['nama_pelanggan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bulan | Tahun</td>
                                            <td>: <?php echo $data_cek['nama_bulan']; ?> - <?php echo $data_cek['tahun']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pemakaian</td>
                                            <td>: <?php echo $data_cek['pakai']; ?> Meter</td>
                                        </tr>

                                        <tr>
                                            <td>Tagihan</td>
                                            <td>: <?php echo rupiah($data_cek['tagihan']); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Status</td>
                                            <td>:
                                            <?php $warna = $data_cek['status']?>
                                            <?php if ($warna == 'Belum Bayar') {?>
                                                <span class="label label-danger">Belum Bayar</span>
                                            <?php } elseif ($warna == 'Lunas') {?>
                                                <span class="label label-primary">Lunas</span>
                                            </td>
                                            <?php }?>
                                        </tr>

                                    </tbody>

                                </table>

                                <form method="POST">
                                <?php $status = $data_cek['status']?>
                                <?php if ($status == 'Belum Bayar') {?>

                                <div class="form-group">
                                <input type='hidden' class="form-control" name="id_tagihan" value="<?php echo $data_cek['id_tagihan']; ?>" readonly/>
                                </div>

                                <div class="form-group">
                                <input type='hidden' class="form-control" name="tagih" id="tagih" value="<?php echo $data_cek['tagihan']; ?>" readonly/>
                                </div>



                                <div class="form-group">
                                <label>Uang Pembayaran</label>
                                <input type='text' class="form-control" name="bayar" id="bayar" placeholder="Uang pembayaran"/>
                                </div>

                                <div class="form-group">
                                <label>Uang Kembalian</label>
                                <input type='text' class="form-control" name="kembali" id="kembali" readonly/>
                                </div>


                                <div>

                                    <input type="submit" name="Bayar" value="Bayar" class="btn btn-primary" >
                                    <a href="?halaman=tagih_tampil" title="Kembali" class="btn btn-default">Batal</a>

                                <?php } elseif ($status == 'Lunas') {?>
                                    <a href="./report/cetak_pembayaran.php?id_tagihan=<?php echo $data_cek['id_tagihan']; ?>" target=" _blank" title="Cetak Struk" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak Struk</a>
                                    <a href="?halaman=lunas_tampil" title="Pembayaran Lunas" class="btn btn-default">Tagihan Lunas</a>
                                </div>
                                <?php }?>

                            </div>

                    </form>
                </div>
            </div>
        </div>

    <?php
if (isset($_POST['Bayar'])) {
    //mulai proses simpan data
    $sql_simpan = "INSERT INTO tb_pembayaran (id_tagihan, tgl_bayar, uang_bayar, kembali) VALUES (
            '" . $_POST['id_tagihan'] . "',
            '" . $tanggal . "',
            '" . $_POST['bayar'] . "',
            '" . $_POST['kembali'] . "');";
    $sql_simpan .= "UPDATE tb_tagihan SET
            status='Lunas'
            WHERE id_tagihan='" . $_POST['id_tagihan'] . "'";
    $query_simpan = mysqli_multi_query($koneksi, $sql_simpan);

    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
                    Swal.fire({title: 'Pembayaran Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?halaman=tagih_bayar&kode=" . $_POST['id_tagihan'] . "';
                        }})</script>";
    } else {
        echo "<script>
                    Swal.fire({title: 'Pembayaran Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?halaman=tagih_bayar&kode=" . $_POST['id_tagihan'] . "';
                        }})</script>";
    }
    //selesai proses simpan data
}

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#tagih, #bayar").keyup(function() {
            var tagih  = $("#tagih").val();
            var bayar = $("#bayar").val();
            var kembali = parseInt(bayar) - parseInt(tagih);
            $("#kembali").val(kembali);

        });
    });
</script>