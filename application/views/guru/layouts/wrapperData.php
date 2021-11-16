<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/x-icon" sizes="16x20" href="<?= base_url() ?>assets/layout/logo.ico">
	<title><?= $judul ?></title>
	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- toast CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
	<!-- Custom CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/horizontal/css/pages/table-pages.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/template/adminwrap/horizontal/css/style.css" rel="stylesheet">
	<!-- This page CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/horizontal/css/pages/ribbon-page.css" rel="stylesheet">
	<!-- You can change the theme colors from here -->
	<link href="<?= base_url() ?>assets/template/adminwrap/horizontal/css/colors/blue-dark.css" id="theme" rel="stylesheet">
	<!--alerts CSS -->
	<link href="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="card-no-border">
	<!-- Memanggil file php di guru/components/preloadder.php -->
	<div id="main-wrapper">
		<!-- Memanggil file php di guru/components/header.php -->
		<?php $this->load->view('guru/components/header') ?>
		<!-- Memanggil file php di guru/components/sidebar.php -->
		<?php $this->load->view('guru/components/sidebar') ?>
		<!-- Content -->
		<div class="page-wrapper">
			<!-- Memanggil varible viewUtama dari method controller -->
			<?php $this->load->view($viewUtama) ?>
			<!-- Memanggil file php di guru/components/footer.php -->
			<?php $this->load->view('guru/components/footer') ?>
		</div>
	</div>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/bootstrap/js/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/ps/perfect-scrollbar.jquery.min.js"></script>
	<!--Wave Effects -->
	<script src="<?= base_url() ?>assets/template/adminwrap/horizontal/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="<?= base_url() ?>assets/template/adminwrap/horizontal/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="<?= base_url() ?>assets/template/adminwrap/horizontal/js/custom.min.js"></script>
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/toast-master/js/jquery.toast.js"></script>
	<!-- This is data table -->
	<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
</body>

</html>
