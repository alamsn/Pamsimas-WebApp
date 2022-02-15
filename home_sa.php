<?php
$data_nama_lengkap = $_SESSION["ses_nama"];
$data_level = $_SESSION["ses_level"];
?>

<h2>Selamat Datang</h2>
<h3>
	<?php echo $data_nama_lengkap; ?>(
	<?php echo $data_level; ?>) Di Aplikasi Pembayaran Tagihan Air.</h3>
<hr/>

<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-red set-icon">
				<i class="fa fa-users"></i>
			</span>
			<p class="main-text">
				Data Pelanggan
			</p>
			<br>
			<hr/>
			<div class="text-box">
				<p class="main-text">
					<?php // menghitung
                    $sql_hitung = "SELECT COUNT(id_pelanggan) from tb_pelanggan where status='Aktif'";
                    $q_hit= mysqli_query($koneksi, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]." Pelanggan Aktif";
                    }
                    ?>
				</p>
				<h5>
					<b><a href="?halaman=pelanggan_tampil">Selengkapnya</a></b>
				</h5>
			</div>

			<div class="text-box">
				<p class="main-text">
					<?php // menghitung
                    $sql_hitung = "SELECT COUNT(id_pelanggan) from tb_pelanggan where status='Non Aktif'";
                    $q_hit= mysqli_query($koneksi, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]." Pelanggan Non Aktif";
                    }
                    ?>
				</p>
				<h5>
					<b>
						<a href="?halaman=pelanggan_tampil">Selengkapnya</a>
					</b>
				</h5>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="panel panel-back noti-box">
			<span class="icon-box bg-color-green set-icon">
				<i class="fa fa-tags"></i>
			</span>
			<p class="main-text">
				Data Tagihan
			</p>
			<br>
			<hr/>

			<div class="text-box">
				<p class="main-text">
					<?php // menghitung
                    $sql_hitung = "SELECT COUNT(id_tagihan) from tb_tagihan where status='Belum Bayar'";
                    $q_hit= mysqli_query($koneksi, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]." Tagihan Belum Bayar";
                    }
                    ?>
				</p>
				<h5>
					<b>
						<a href="?halaman=tagih_tampil">Selengkapnya</a>
					</b>
				</h5>
			</div>

			<div class="text-box">
				<p class="main-text">
					<?php // menghitung
                    $sql_hitung = "SELECT COUNT(id_tagihan) from tb_tagihan where status='Lunas'";
                    $q_hit= mysqli_query($koneksi, $sql_hitung);
                    while($row = mysqli_fetch_array($q_hit)) {
                        echo  $row[0]." Tagihan Lunas";
                    }
                    ?>
				</p>
				<h5>
					<b>
						<a href="?halaman=lunas_tampil">Selengkapnya</a>
					</b>
				</h5>
			</div>