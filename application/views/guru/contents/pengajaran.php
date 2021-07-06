<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Pengajaran</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/pengguna">Admin</a></li>
				<li class="breadcrumb-item active">Kelola Pengajaran</li>
			</ol>
		</div>
		<div class="col-md-7 align-self-center text-right d-none d-md-block">
			<a href="<?= base_url('guru/add_pengajaran') ?>" class="btn btn-info">
				Buat Pengajaran
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Pengajaran</div>
				<div class="card-body">
					<div class="table-responsive">
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
						<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Guru</th>
									<th>Tahun Ajaran</th>
									<th>Semester</th>
									<th style="text-align:center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($pengajaranS as $pengajaran) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $pengajaran['nama'] ?></td>
										<td><?= $pengajaran['tahun_ajaran'] ?></td>
										<td><?= $pengajaran['semester'] ?></td>
										<td style="text-align:center">
											<a href="<?= base_url('guru/detail/' . $pengajaran['id_pengajaran']) ?>" class="btn btn-secondary btn-sm">Detail</a>
											<a href="<?= base_url('guru/mapel/' . $pengajaran['id_pengajaran']) ?>" class="btn btn-secondary btn-sm">Input Mapel</a>
											<a href="<?= base_url('guru/siswa/' . $pengajaran['id_pengajaran']) ?>" class="btn btn-secondary btn-sm">Input Siswa</a>
											<a href="<?= base_url('guru/nilai/' . $pengajaran['id_pengajaran']) ?>" class="btn btn-secondary btn-sm">Input Nilai</a>
											<a href="<?= base_url('guru/laporan/' . $pengajaran['id_pengajaran']) ?>" class="btn btn-secondary btn-sm">Laporan</a>
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
		})
	});
</script>
