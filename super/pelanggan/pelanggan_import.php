<div class="box">
    <h1>Pelanggan</h1>
    <h4>
        <h4>Masukkan file excel untuk menginput banyak data pelanggan</h4>
        <div class="pull-right">
            <a href="?halaman=pelanggan_tampil" class="btn btn-warning btn-primary"><i class="glyphicon glyphicon-menu-left"></i>Kembali</a>
        </div>
    </h4>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="super/pelanggan/import.php" method="POST" enctype="multipart/form-data">
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
