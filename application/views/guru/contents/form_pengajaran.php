<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Pengajaran</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">Guru</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item active">Buat Pengajaran</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Data Pengajaran</h4>
					<h6 class="card-subtitle"> Data ini tidak akan bisa dihapus, maka dari itu perhatikan penulisan pada form. </h6>
					<hr>
					<form class="mt-4" method="POST">
						<div class="form-group">
							<label>Nama Guru</label>
							<input type="text" class="form-control" value="<?= $cekUser['nama'] ?>">
						</div>
						<div class="form-group">
							<label>Tahun Ajaran</label>
							<select class="form-control <?= form_error('ta_id') ? 'is-invalid' : '' ?>" name="ta_id">
								<option value="" disabled selected>Pilih</option>
								<?php foreach ($tahun_ajaranS as $tahun_ajaran) : ?>
									<option value="<?= $tahun_ajaran['id_ta'] ?>" <?= set_value('ta_id') != $tahun_ajaran['id_ta'] ?: 'selected' ?>><?= $tahun_ajaran['tahun_ajaran'] . ' - Semester ' .  $tahun_ajaran['semester'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('ta_id') ?></div>
						</div>
						<div class="form-group">
							<label>Kelas</label>
							<input type="text" class="form-control <?= form_error('kelas') ? 'is-invalid' : '' ?>" name="kelas" value="<?= set_value('kelas', isset($tahun_ajaran['kelas']) ? $tahun_ajaran['kelas'] : '') ?>" placeholder="contoh: 1">
							<div class="invalid-feedback"><?= form_error('kelas') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
