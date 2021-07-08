<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Mata Pelajaran</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('admin/mata_pelajaran') ?>">Kelola Mata Pelajaran</a></li>
				<li class="breadcrumb-item active">Buat/Ubah Mata Pelajaran</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Data Mata Pelajaran</h4>
					<h6 class="card-subtitle"> Data ini tidak akan bisa dihapus, maka dari itu perhatikan penulisan pada form. </h6>
					<hr>
					<form class="mt-4" method="POST">
						<div class="form-group">
							<label>Kode Mata Pelajaran</label>
							<input type="text" class="form-control <?= form_error('kode_mapel') ? 'is-invalid' : '' ?>" name="kode_mapel" value="<?= set_value('kode_mapel', isset($mata_pelajaran['kode_mapel']) ? $mata_pelajaran['kode_mapel'] : '') ?>" placeholder="contoh: BTQ">
							<div class="invalid-feedback"><?= form_error('kode_mapel') ?></div>
						</div>
						<div class="form-group">
							<label>Nama Mata Pelajaran</label>
							<input type="text" class="form-control <?= form_error('mata_pelajaran') ? 'is-invalid' : '' ?>" name="mata_pelajaran" value="<?= set_value('mata_pelajaran', isset($mata_pelajaran['mata_pelajaran']) ? $mata_pelajaran['mata_pelajaran'] : '') ?>" placeholder="contoh: Baca Tulis Qur'an">
							<div class="invalid-feedback"><?= form_error('mata_pelajaran') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
