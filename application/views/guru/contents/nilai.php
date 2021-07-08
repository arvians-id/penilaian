<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Detail Pengajaran</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">Guru</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item active">Detail Pengajaran</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Detail Pengajaran</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-lg-3">
							<h3>Nama Guru : <?= $pengajaran['nama'] ?></h3>
						</div>
						<div class="col-12 col-lg-3">
							<h3>Tahun Ajaran : <?= $pengajaran['tahun_ajaran'] ?></h3>
						</div>
						<div class="col-12 col-lg-3">
							<h3>Semester : <?= $pengajaran['semester'] ?></h3>
						</div>
						<div class="col-12 col-lg-3">
							<h3>Kelas : <?= $pengajaran['kelas'] ?></h3>
						</div>
					</div>
					<hr>
					<h4>Mata Pelajaran Yang Diambil</h4>
					<hr>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Mata Pelajaran</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($pengajaranMapelS)) : ?>
								<tr id="alert-data">
									<td colspan="4">
										<div class="alert alert-danger" role="alert">
											Belum ada mata pelajaran yang anda ambil <a href="<?= base_url('guru/mapel/' . $pengajaran_id) ?>">Klik Disini</a> untuk menambahkan mata pelajaran
										</div>
									</td>
								</tr>
							<?php else : ?>
								<?php $no = 1;
								foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
									<tr>
										<td scope="row"><?= $no++ ?></td>
										<td><?= $pengajaranMapel['mata_pelajaran'] ?></td>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
					<h4>Data Siswa Yang Diambil</h4>
					<hr>
					<a href="<?= base_url('guru/lihat_nilai/' . $pengajaran_id) ?>" class="btn btn-secondary btn-sm mb-2">Lihat semua nilai</a>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>
					<div class="table-responsive">
						<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Siswa</th>
									<th>Jenis Kelamin</th>
									<th>Tanggal Lahir</th>
									<th>Nama Wali</th>
									<th>Tahun Masuk</th>
									<th style="text-align:center"></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($pengajaranSiswaS as $pengajaranSiswa) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $pengajaranSiswa['nama'] ?></td>
										<td><?= $pengajaranSiswa['jenis_kelamin'] ?></td>
										<td><?= $pengajaranSiswa['tanggal_lahir'] ?></td>
										<td><?= $pengajaranSiswa['nama_wali'] ?></td>
										<td><?= $pengajaranSiswa['tahun_masuk'] ?></td>
										<td style="text-align:center">
											<a href="<?= base_url('guru/input/' . $pengajaran_id . '/' . $pengajaranSiswa['id_siswa']) ?>" class="btn btn-secondary btn-sm">Input Nilai</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
<script>
	$(function() {
		$('#all-table').DataTable({
			"autoWidth": false,
			"responsive": true,
			"columnDefs": [{
				"targets": [-1],
				"orderable": false
			}]
		})
	});
</script>
