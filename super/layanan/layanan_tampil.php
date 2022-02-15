<div class="row">
                <div class="col-md-12">
                    <!--
                    <a href="?halaman=layanan_tambah" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
                    Advanced Tables -->

                    <div class="panel panel-info">
                        <div class="panel-heading">
                             <b>Data Layanan</b>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Layanan</th>
                                            <th>Tarif Dasar Per Meter</th>
                                            <th>Tarif Setelah 10 M <sup> 3</sup> </th>
                                            <th>Tarif Setelah 20 M <sup> 3</sup> </th>
                                            <th>Biaya Admin</th>
                                            <th>Aksi</th>

                                        </tr>

                                    </thead>
                                    <tbody>


                                    <?php

$no = 1;
$sql = $koneksi->query("select * from tb_layanan");
while ($data = $sql->fetch_assoc()) {

    ?>

                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['layanan']; ?></td>
                                        <td><?php echo rupiah($data['tarif_dasar']); ?></td>
                                        <td><?php echo rupiah($data['tarif_1']); ?></td>
                                        <td><?php echo rupiah($data['tarif_2']); ?></td>
                                        <td><?php echo rupiah($data['admin']); ?></td>
                                        <td>
                                        <a href="?halaman=layanan_ubah&kode=<?php echo $data['id_layanan']; ?>" title="Ubah" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="?halaman=layanan_hapus&kode=<?php echo $data['id_layanan']; ?>" onclick="return confirm('Apakah anda yakin hapus layanan ini ?')" title="Hapus" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></>
                                        </td>

                                    </tr>
                                    <?php
}
?>

                                    </tbody>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>