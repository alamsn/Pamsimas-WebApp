<?php
include "inc/koneksi.php";
include "inc/kode.php";

?>

<div class="panel panel-info">
    <div class="panel-heading">
        <b>Tambah Pemakaian</b>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>ID Pemakaian</label>
                        <input class="form-control" type="text" name="id_pakai" value="<?php echo $format; ?>" readonly/>
                    </div>

                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                        <option value=""></option>

<?php
// ambil data dari database
$query = "select * from tb_pelanggan where status='Aktif'";
$hasil = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_array($hasil)) {
    ?>
        <option value="<?php echo $row['id_pelanggan'] ?>"><?php echo $row['id_pelanggan'] ?> | <?php echo $row['nama_pelanggan'] ?></option>
        <?php
}
?>
</select>
</div>

<div class="form-group">
<label>Bulan</label>
<select name="id_bulan" id="id_bulan" class="form-control" required>
<option value="">-- Pilih Bulan --</option>
<?php
// ambil data dari database
$query = "select * from tb_bulan order by id_bulan asc";
$hasil = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_array($hasil)) {
    ?>
<option value="<?php echo $row['id_bulan'] ?>"> <?php echo $row['nama_bulan'] ?></option>
<?php
}
?>
</select>
</div>

<div class="form-group">
    <label>Tahun</label>
    <input class="form-control" name="tahun" placeholder="Masukkan tahun"/>
</div>

<div class="form-group">
    <label>Meteran Bulan Lalu</label>
    <input type="text" name="awal" id="awal" class="form-control" placeholder="Meteran bulan lalu" >
</div>

<div class="form-group">
        <label>Meteran Bulan Ini</label>
        <input type="text" name="akhir" id="akhir" class="form-control" placeholder="Meteran bulan ini">
</div>

<div class="form-group mb-0">
    <label>Pemakaian (Bulan Ini - Bulan lalu)</label>
    <input type="text" name="total" id="total" class="form-control" placeholder="Pemakaian bulan ini" readonly="">
</div>

<div class="form-group mb-0">
<?php $sql_cek1 = "SELECT i.tarif_dasar FROM tb_layanan i INNER JOIN tb_pelanggan p ON i.id_layanan=p.id_layanan";
$query_cek1 = mysqli_query($koneksi, $sql_cek1);
$data_cek1 = mysqli_fetch_array($query_cek1, MYSQLI_BOTH);

$sql_cek2 = "SELECT j.tarif_1 FROM tb_layanan j INNER JOIN tb_pelanggan p ON j.id_layanan=p.id_layanan";
$query_cek2 = mysqli_query($koneksi, $sql_cek2);
$data_cek2 = mysqli_fetch_array($query_cek2, MYSQLI_BOTH);

$sql_cek3 = "SELECT k.tarif_2 FROM tb_layanan k INNER JOIN tb_pelanggan p ON k.id_layanan=p.id_layanan";
$query_cek3 = mysqli_query($koneksi, $sql_cek3);
$data_cek3 = mysqli_fetch_array($query_cek3, MYSQLI_BOTH);

$sql_cek4 = "SELECT k.admin FROM tb_layanan k INNER JOIN tb_pelanggan p ON k.id_layanan=p.id_layanan";
$query_cek4 = mysqli_query($koneksi, $sql_cek4);
$data_cek4 = mysqli_fetch_array($query_cek4, MYSQLI_BOTH);
?>
<input type="hidden" class="form-control" name="tarif_dasar" id="tarif_dasar" value="<?php echo $data_cek1['tarif_dasar']; ?>" readonly=""/>
<input type="hidden" class="form-control" name="tarif_1" id="tarif_1" value="<?php echo $data_cek2['tarif_1']; ?>" readonly=""/>
<input type="hidden" class="form-control" name="tarif_2" id="tarif_2" value="<?php echo $data_cek3['tarif_2']; ?>" readonly=""/>
<input type="hidden" class="form-control" name="admin" id="admin" value="<?php echo $data_cek4['admin']; ?>" readonly=""/>
</div>
<div class="form-group mb-0">
    <input type="hidden" name="harga" id="harga" class="form-control"  readonly="">
</div>
<div>
    <input type="submit" name="Simpan" value="Simpan" class="btn btn-success" >
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
    $sql_simpan = "INSERT INTO tb_pakai (id_pakai, id_pelanggan, bulan, tahun, awal, akhir, pakai) VALUES (
            '" . $_POST['id_pakai'] . "',
            '" . $_POST['id_pelanggan'] . "',
            '" . $_POST['id_bulan'] . "',
            '" . $_POST['tahun'] . "',
            '" . $_POST['awal'] . "',
            '" . $_POST['akhir'] . "',
            '" . $_POST['total'] . "');";
    $sql_simpan .= "INSERT INTO tb_tagihan (id_pakai, tagihan) VALUES (
            '" . $_POST['id_pakai'] . "',
            '" . $_POST['harga'] . "')";
    $query_simpan = mysqli_multi_query($koneksi, $sql_simpan);

    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
                    Swal.fire({title: 'Simpan Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?halaman=pakai_tampil';
                        }})</script>";
    } else {
        echo "<script>
                    Swal.fire({title: 'Simpan Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?halaman=pakai_tambah';
                        }})</script>";
    }
    //selesai proses simpan data
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#id_pelanggan').change(function(){
            var id_pelanggan = $(this).val();
            $.ajax({
                url:"super/pakai/proses-ajax.php",
                method:"POST",
                data:{id_pelanggan:id_pelanggan},
                success:function(data){
                    $('#awal').val(data);
                }
            });
        });
    });
</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#akhir, #awal, #tarif_dasar, #tarif_1, #tarif_2, #admin").keyup(function() {
            var awal  = $("#awal").val();
            var akhir = $("#akhir").val();
            var awal = parseInt(awal);
            var akhir = parseInt(akhir);
            var total = parseInt(akhir) - parseInt(awal);
            $("#total").val(total);

            var tarif_dasar = $("#tarif_dasar").val();
            var tarif_1 = $("#tarif_1").val();
            var tarif_2 = $("#tarif_2").val();
            var admin = $("#admin").val();

                if (total <= 10) {
                    var total = $("#total").val();
                    var harga = (10 * parseInt(tarif_dasar)) + parseInt(admin);
                } else if (total > 10 && total <= 20) {
                    var total = $("#total").val();
                    var harga = (10 * parseInt(tarif_dasar)) + ((parseInt(total) - 10) * parseInt(tarif_1)) + parseInt(admin);
                } else if (total > 20) {
                    var total = $("#total").val();
                    var harga = (10 * parseInt(tarif_dasar)) + (10 * parseInt(tarif_1)) + ((parseInt(total) - 20) * parseInt(tarif_2)) + parseInt(admin);
                } $("#harga").val(harga);
        });
    });
</script>
