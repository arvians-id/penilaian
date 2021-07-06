<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Siswa</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/pengguna">Admin</a></li>
				<li class="breadcrumb-item active">Kelola Siswa</li>
			</ol>
		</div>
		<div class="col-md-7 align-self-center text-right d-none d-md-block">
			<a href="<?= base_url('admin/add_siswa') ?>" class="btn btn-info">
				Buat Siswa
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Siswa</div>
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
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>Tanggal Lahir</th>
									<th>Nama Wali</th>
									<th>Tahun Masuk</th>
									<th>Dibuat</th>
									<th>Terakhir Diubah</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($siswaS as $siswa) : ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $siswa['nama'] ?></td>
										<td><?= $siswa['jenis_kelamin'] ?></td>
										<td><?= $siswa['tanggal_lahir'] ?></td>
										<td><?= $siswa['nama_wali'] ?></td>
										<td><?= $siswa['tahun_masuk'] ?></td>
										<td><?= $siswa['created_at'] ?></td>
										<td><?= $siswa['updated_at'] ?></td>
										<td><a href="<?= base_url('admin/update_siswa/' . $siswa['id_siswa']) ?>" class="btn btn-secondary btn-sm">Ubah</a></td>
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
