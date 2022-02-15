<div class="box">
    <h1>Pemekaian</h1>
    <h4>
        <h4>Masukkan file excel untuk menginput banyak data pemakaian</h4>
        <div class="pull-right">
            <a href="?halaman=pakai_tampil" class="btn btn-warning btn-primary"><i class="glyphicon glyphicon-menu-left"></i>Kembali</a>
        </div>
    </h4>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="super/pakai/import.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">File Excel</label>
                    <input type="file" name="berkas_excel" id="exampleInputFile" class="form-control" required>
                </div>
                <div class="form-group pull-right">
                    <input type="submit" name="import" value="import" class="btn btn-succes">
                </div>
            </form>
        </div>
    </div>
</div>


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

<?php
if (isset($_POST['import'])) {
    //mulai proses import data
    $sql_import = "INSERT INTO tb_pakai (id_pakai, pakai) VALUES (
            '" . $_POST['id_pakai'] . "',
            '" . $_POST['total'] . "');";
    $sql_import .= "INSERT INTO tb_tagihan (id_pakai, tagihan) VALUES (
            '" . $_POST['id_pakai'] . "',
            '" . $_POST['harga'] . "')";
    $query_import = mysqli_multi_query($koneksi, $sql_import);

    mysqli_close($koneksi);

    if ($query_import) {
        echo "<script>
                    Swal.fire({title: 'import Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?halaman=pakai_tampil';
                        }})</script>";
    } else {
        echo "<script>
                    Swal.fire({title: 'import Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?halaman=pakai_tambah';
                        }})</script>";
    }
    //selesai proses import data
}?>

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


                if (awal <= 10 && akhir <= 10) {
                    var total = $("#total").val();
                    var harga = (10 * parseInt(tarif_dasar)) + parseInt(admin);
                } else if (awal <= 10 && akhir > 10 && akhir <= 20) {
                    var total = $("#total").val(total);
                    var harga = ((parseInt(tarif_1) * (parseInt(akhir) - 10)) + ((10 - parseInt(awal)) * parseInt(tarif_dasar))) + parseInt(admin);
                } else if (awal <= 10 && akhir > 20) {
                    var total = $("#total").val(total);
                    var harga = ((parseInt(tarif_2) * (parseInt(akhir) - 20)) + (10 * parseInt(tarif_1))  + ((10 - parseInt(awal)) * parseInt(tarif_dasar))) + parseInt(admin);
                } else if (awal > 10 && awal <= 20 && akhir <= 20) {
                    var harga = ((parseInt(akhir) - parseInt(awal)) * parseInt(tarif_1)) + parseInt(admin);
                } else if (awal > 10 && awal <= 20 && akhir > 20) {
                    var total = $("#total").val(total);
                    var harga = (((20 - parseInt(awal)) * parseInt(tarif_1)) +  ((parseInt(akhir) - 20) * parseInt(tarif_2))) + parseInt(admin);
                } else if (awal > 20) {
                    var harga = (parseInt(total) * parseInt(tarif_2)) + parseInt(admin);
                } $("#harga").val(harga);

                var harga = parseInt(harga);
                if (harga < 16000) {
                    var harga = $("#harga").val(16000);
                } else {
                    var harga = $("#harga").val(harga);
                }
        });
    });
</script>
