<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <b>Laporan Pemasukan</b>
            </div>
            <div class="panel-body">

            <form action="./report/laporan_pemasukan.php" method="post" enctype="multipart/form-data" target="_blank">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input type="date" class="form-control" name="tgl1" required/>
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" class="form-control" name="tgl2" required/>
                </div>

                    <button type="submit" class="btn btn-primary" name="btnCetak" target="_blank">Cetak</button>
            </form>
            </div>
            <div class="panel-footer">
                Panel Footer
            </div>
        </div>
    </div>
</div>