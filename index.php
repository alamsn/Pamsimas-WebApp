	<?php
//Mulai Sesion
session_start();

if (isset($_SESSION["ses_username"]) == "") {
    echo "<meta http-equiv='refresh' content='0;url=login'>";
} else {
    $data_ath = $_SESSION["ses_id"];
    $data_nama_lengkap = $_SESSION["ses_nama"];
    $data_nama = $_SESSION["ses_username"];
    $data_level = $_SESSION["ses_level"];
    $data_rek = $_SESSION["ses_rek"];
}

//KONEKSI DB
include "inc/koneksi.php";
//FUNGSI RUPIAH
include "inc/rupiah.php";
//FUNGSI ENKRIPSI
include "inc/enk.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>PAMSIMAS | Punjulharjo</title>

	<link rel="icon" href="assets/img/logo.png">
	<!-- BOOTSTRAP STYLES-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<link rel="stylesheet" href="dist/css/select2.min.css" />

	<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

	<link rel="stylesheet" href="dist/swal/sweetalert2.min.css">
	<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #202020;
  color: white;
  text-align: center;
}
</style>
	<script src="dist/swal/sweetalert2.min.js"></script>

</head>

<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="http://localhost/pamsimas_punjulharjo" class="navbar-brand">
					<i class="glyphicon glyphicon-tint"> </i> PAMSIMAS </a>
			</div>
			<div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
				<span class="label label-danger">Welcome,
					<?php echo $data_nama_lengkap; ?>-
					<?php echo $data_level; ?>
				</span>
		</nav>
		<!-- /. NAV TOP  -->
		<nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="main-menu">
					<!-- <li class="text-center">
						<img src="assets/img/logo.png" class="user-image img-responsive" />
					</li> -->

					<!-- Level  -->


					<?php
if ($data_level == "Administrator") {
    ?>

						<li>
							<a href="?halaman=home_sa">
								<i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
						</li>

						<li>
							<a href="?halaman=pakai_tampil">
								<i class="fa fa-refresh fa-2x"></i> Pemakaian</a>
						</li>

						<li>
							<a href="#">
								<i class="fa fa-tags fa-2x"></i> Tagihan
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level">
								<li>
									<a href="?halaman=tagih_tampil">Belum Bayar</a>
								</li>

								<li>
									<a href="?halaman=lunas_tampil">Lunas</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-book fa-2x"></i> Administrasi
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level">
								<li>
									<a href="?halaman=pelanggan_tampil">Pelanggan</a>
								</li>

								<li>
									<a href="?halaman=layanan_tampil">Layanan Air</a>
								</li>

							</ul>
						</li>

						<li>
							<a href="#">
								<i class="fa fa-cogs fa-2x"></i> Pengaturan
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level">

								<li>
									<a href="?halaman=pengguna_tampil">Pengguna Sistem</a>
								</li>
								<li>
									<a href="?halaman=info_tampil">Info Pelanggan</a>
								</li>

							</ul>
						</li>

						<li>
							<a href="#">
								<i class="fa fa-file fa-2x"></i> Laporan
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level">
								<li>
									<a href="?halaman=lap_masuk">Laporan Pemasukan</a>
								</li>
							</ul>
						</li>

					<?php
} elseif ($data_level == "Operator") {
    ?>

						<li>
							<a href="?halaman=home_op">
								<i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
						</li>

						<li>
							<a href="?halaman=pakai_tampil">
								<i class="fa fa-refresh fa-2x"></i> Data Pemakaian</a>
						</li>

					<?php
} elseif ($data_level == "Pelanggan") {
    ?>
						<li>
							<a href="?halaman=<?=sha1('home_pe')?>">
								<i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
						</li>

						<li>
							<a href="#">
								<i class="fa fa-tags fa-2x"></i> Tagihan
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-second-level">
								<li>
									<a href="?halaman=<?=sha1('p_tagih_tampil')?>">Belum Bayar</a>
								</li>

								<li>
									<a href="?halaman=<?=sha1('p_lunas_tampil')?>">Lunas</a>
								</li>
							</ul>
						</li>
					<?php
}
?>

					<li>
						<a href="logout" onclick="return confirm('Apakah anda yakin ingin keluar dari aplikasi ini ?')">
							<i class="fa fa-sign-out fa-2x"></i> Keluar</a>
					</li>

				</ul>


			</div>
		</nav>
		<!-- /. PAGE WRAPPER  -->
		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<!-- Menjadikan halaman web dinamis,
				dengan menjadikan halaman lain yang dipanggil sebagai sebuah konten dari index.php-->

<div class="footer">
  <p>Copyright © KKN T Undip - Punjulharjo 2020</p>
</div>
						<?php
if (isset($_GET['halaman'])) {
    $hal = $_GET['halaman'];

    switch ($hal) {
        case 'home_sa':
            include "home_sa.php";
            break;
        case 'home_op':
            include "home_op.php";
            break;
        case sha1('home_pe'):
            include "home_pe.php";
            break;

        //User
        case 'pengguna_tampil':
            include "super/pengguna/pengguna_tampil.php";
            break;
        case 'pengguna_tambah':
            include "super/pengguna/pengguna_tambah.php";
            break;
        case 'pengguna_ubah':
            include "super/pengguna/pengguna_ubah.php";
            break;
        case 'pengguna_hapus':
            include "super/pengguna/pengguna_hapus.php";
            break;

        //Info
        case 'info_tampil':
            include "super/info/info_tampil.php";
            break;
        case 'info_ubah':
            include "super/info/info_ubah.php";
            break;
        case 'kasperusahaan':
            include "super/info/dapat_tampil.php";
            break;

        //Layanan
        case 'layanan_tampil':
            include "super/layanan/layanan_tampil.php";
            break;
        case 'layanan_tambah':
            include "super/layanan/layanan_tambah.php";
            break;
        case 'layanan_ubah':
            include "super/layanan/layanan_ubah.php";
            break;
        case 'layanan_hapus':
            include "super/layanan/layanan_hapus.php";
            break;

        //Pelanggan
        case 'pelanggan_tampil':
            include "super/pelanggan/pelanggan_tampil.php";
            break;
        case 'pelanggan_tambah':
            include "super/pelanggan/pelanggan_tambah.php";
            break;
        case 'pelanggan_ubah':
            include "super/pelanggan/pelanggan_ubah.php";
            break;
        case 'pelanggan_hapus':
            include "super/pelanggan/pelanggan_hapus.php";
            break;
        case 'pelanggan_import':
            include "super/pelanggan/pelanggan_import.php";
            break;
        case 'nonaktif':
            include "super/pelanggan/status_no.php";
            break;
        case 'aktif':
            include "super/pelanggan/status_ok.php";
            break;

        //Pemakaian
        case 'pakai_tambah':
            include "super/pakai/pakai_tambah.php";
            break;
        case 'pakai_tampil':
            include "super/pakai/pakai_tampil.php";
            break;
        case 'pakai_hapus':
            include "super/pakai/pakai_hapus.php";
            break;
        case 'pakai_import':
            include "super/pakai/pakai_import.php";
            break;

        //Tagihan
        case 'tagih_tampil':
            include "super/tagih/tagih_tampil.php";
            break;
        case 'lunas_tampil':
            include "super/tagih/lunas_tampil.php";
            break;
        case 'tagih_bayar':
            include "super/tagih/tagih_bayar.php";
            break;
        case 'tagih_hapus':
            include "super/tagih/tagih_hapus.php";
            break;

        //lap
        case 'lap_masuk':
            include "lap/laporan_masuk.php";
            break;

        //##################### PELANGGAN ##########################################################

        //Tagihan
        case sha1('p_tagih_tampil'):
            include "pelanggan/tagih/tagih_tampil.php";
            break;
        case sha1('p_lunas_tampil'):
            include "pelanggan/tagih/lunas_tampil.php";
            break;

        //default
        default:
            echo "<center><h1> ERROR !</h1></center>";
            break;
    }
} else {
    if ($data_level == "Operator") {
        include "home_op.php";
    } elseif ($data_level == "Pelanggan") {
        include "home_pe.php";
    } elseif ($data_level == "Administrator") {
        include "home_sa.php";
    }
}
?>
					</div>
				</div>
				<!-- /. WRAPPER  -->
				<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
				<!-- JQUERY SCRIPTS -->
				<script src="assets/js/morris/morris.js"></script>
				<script src="assets/js/morris/morris-0.4.3.min.css"></script>
				<script src="assets/js/morris/morris.js"></script>
				<script src="assets/js/jquery-1.10.2.js"></script>
				<!-- BOOTSTRAP SCRIPTS -->
				<script src="assets/js/bootstrap.min.js"></script>
				<!-- METISMENU SCRIPTS -->
				<script src="assets/js/jquery.metisMenu.js"></script>
				<!-- CUSTOM SCRIPTS -->

				<script src="assets/js/dataTables/jquery.dataTables.js"></script>
				<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
				<script>
					$(document).ready(function() {
						$('#dataTables-example').dataTable();
					});
				</script>

				<script src="dist/js/select2.min.js"></script>
				<script>
					$(document).ready(function() {
						$("#id_pelanggan").select2({
							placeholder: "-- Pilih Pelanggan --"
						});
					});
				</script>

			<!-- CUSTOM SCRIPTS -->
			<script src="assets/js/custom.js"></script>
</body>
</html>