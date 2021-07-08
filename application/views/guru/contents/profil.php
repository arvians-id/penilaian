<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Profil</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Profil</li>
			</ol>
		</div>
	</div>
	<!-- Row -->
	<div class="row">
		<!-- Column -->
		<div class="col-lg-4 col-xlg-3 col-md-5">
			<div class="card">
				<div class="card-body">
					<center class="m-t-30">
						<h4 class="card-title m-t-10"><?= $cekUser['nama'] == null ? '-' : ucwords($cekUser['nama']) ?></h4>
						<h6 class="card-subtitle"><?= $cekUser['username'] ?></h6>
					</center>
				</div>
				<div>
					<hr>
				</div>
				<div class="card-body">
					<small class="text-muted">Username </small>
					<h6><?= ucwords($cekUser['username']) ?></h6>
					<small class="text-muted p-t-30 db">Nama Lengkap</small>
					<h6><?= ucwords($cekUser['nama']) ?></h6>
					<small class="text-muted p-t-30 db">Tanggal Lahir</small>
					<h6><?= $cekUser['tanggal_lahir'] ?></h6>
					<small class="text-muted p-t-30 db">Nomor Handphone</small>
					<h6><?= $cekUser['no_hp'] ?></h6>
					<small class="text-muted p-t-30 db">Jenis Kelamin</small>
					<h6><?= $cekUser['jenis_kelamin'] ?></h6>
					<small class="text-muted p-t-30 db">NIP</small>
					<h6><?= $cekUser['nip'] ?></h6>
					<small class="text-muted p-t-30 db">Pendidikan Terakhir</small>
					<h6><?= $cekUser['pendidikan_terakhir'] ?></h6>
					<small class="text-muted p-t-30 db">Agama</small>
					<h6><?= $cekUser['agama'] ?></h6>
					<small class="text-muted p-t-30 db">Alamat</small>
					<h6><?= $cekUser['alamat'] ?></h6>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-8 col-xlg-9 col-md-7">
			<div class="card">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs profile-tab" role="tablist">
					<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Ubah Profil</a> </li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<!--first tab-->
					<div class="tab-pane active" role="tabpanel">
						<div class="card-body">
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
							<form id="edit-profile" method="POST">
								<div class="form-group">
									<label>Username</label>
									<input type="text" class="form-control" value="<?= set_value('username', $cekUser['username']) ?>" readonly>
								</div>
								<div class="form-group">
									<label>Password</label><small class="text-info"> *Abaikan jika tidak ingin diubah</small>
									<input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" name="password">
									<div class="invalid-feedback"><?= form_error('') ?></div>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= set_value('nama', $cekUser['nama']) ?>">
									<div class="invalid-feedback"><?= form_error('nama') ?></div>
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select class="form-control <?= form_error('jenis_kelamin') ? 'is-invalid' : '' ?>" name="jenis_kelamin">
										<option value="" disabled selected>Pilih</option>
										<option value="Laki-laki" <?= set_value('jenis_kelamin', $cekUser['jenis_kelamin']) != 'Laki-laki' ?: 'selected' ?>>Laki-laki</option>
										<option value="Perempuan" <?= set_value('jenis_kelamin', $cekUser['jenis_kelamin']) != 'Perempuan' ?: 'selected' ?>>Perempuan</option>
									</select>
									<div class="invalid-feedback"><?= form_error('jenis_kelamin') ?></div>
								</div>
								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" class="form-control <?= form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" name="tanggal_lahir" value="<?= set_value('tanggal_lahir', $cekUser['tanggal_lahir']) ?>">
									<div class="invalid-feedback"><?= form_error('tanggal_lahir') ?></div>
								</div>
								<div class="form-group">
									<label>NIP</label>
									<input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" name="nip" value="<?= set_value('nip', $cekUser['nip']) ?>">
									<div class="invalid-feedback"><?= form_error('nip') ?></div>
								</div>
								<div class="form-group">
									<label>Pendidikan Terakhir</label>
									<input type="text" class="form-control <?= form_error('pendidikan_terakhir') ? 'is-invalid' : '' ?>" name="pendidikan_terakhir" value="<?= set_value('pendidikan_terakhir', $cekUser['pendidikan_terakhir']) ?>" placeholder="contoh: S1">
									<div class="invalid-feedback"><?= form_error('pendidikan_terakhir') ?></div>
								</div>
								<div class="form-group">
									<label>Agama</label>
									<input type="text" class="form-control <?= form_error('agama') ? 'is-invalid' : '' ?>" name="agama" value="<?= set_value('agama', $cekUser['agama']) ?>">
									<div class="invalid-feedback"><?= form_error('agama') ?></div>
								</div>
								<div class="form-group">
									<label>No Handphone</label>
									<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" value="<?= set_value('no_hp', $cekUser['no_hp']) ?>">
									<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= set_value('alamat', $cekUser['alamat']) ?>">
									<div class="invalid-feedback"><?= form_error('alamat') ?></div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<button class="btn btn-success" type="submit" id="btn-profile">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
	</div>
	<!-- Row -->
</div>
