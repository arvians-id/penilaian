<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Guru</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('admin/guru') ?>">Kelola Guru</a></li>
				<li class="breadcrumb-item active">Buat/Ubah Guru</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Buat Data Guru</h4>
					<h6 class="card-subtitle">Data guru ini akan sekaligus membuat akun otomatis, dengan password sesuai tanggal lahir. </h6>
					<hr>
					<form class="mt-4" method="POST">
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" name="username" value="<?= set_value('username') ?>">
							<div class="invalid-feedback"><?= form_error('username') ?></div>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= set_value('nama') ?>">
							<div class="invalid-feedback"><?= form_error('nama') ?></div>
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="form-control <?= form_error('jenis_kelamin') ? 'is-invalid' : '' ?>" name="jenis_kelamin">
								<option value="" disabled selected>Pilih</option>
								<option value="Laki-laki" <?= set_value('jenis_kelamin') != 'Laki-laki' ?: 'selected' ?>>Laki-laki</option>
								<option value="Perempuan" <?= set_value('jenis_kelamin') != 'Perempuan' ?: 'selected' ?>>Perempuan</option>
							</select>
							<div class="invalid-feedback"><?= form_error('jenis_kelamin') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label><small class="text-danger"> *Catatan: Password akan sama dengan tanggal lahir</small>
							<input type="date" class="form-control <?= form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">
							<div class="invalid-feedback"><?= form_error('tanggal_lahir') ?></div>
						</div>
						<div class="form-group">
							<label>NIP</label>
							<input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" name="nip" value="<?= set_value('nip') ?>">
							<div class="invalid-feedback"><?= form_error('nip') ?></div>
						</div>
						<div class="form-group">
							<label>Pendidikan Terakhir</label>
							<input type="text" class="form-control <?= form_error('pendidikan_terakhir') ? 'is-invalid' : '' ?>" name="pendidikan_terakhir" value="<?= set_value('pendidikan_terakhir') ?>" placeholder="contoh: S1,S2">
							<div class="invalid-feedback"><?= form_error('pendidikan_terakhir') ?></div>
						</div>
						<div class="form-group">
							<label>Agama</label>
							<input type="text" class="form-control <?= form_error('agama') ? 'is-invalid' : '' ?>" name="agama" value="<?= set_value('agama') ?>">
							<div class="invalid-feedback"><?= form_error('agama') ?></div>
						</div>
						<div class="form-group">
							<label>No Handphone</label>
							<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" value="<?= set_value('no_hp') ?>">
							<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= set_value('alamat') ?>">
							<div class="invalid-feedback"><?= form_error('alamat') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
