<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Input Nilai</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/pengguna">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/nilai/' . $pengajaran_id) ?>">Detail Pengajaran</a></li>
				<li class="breadcrumb-item active">Input Nilai</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-12">
			<div class="card">
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
					<h3>Data Siswa</h3>
					<table class="table">
						<tbody>
							<tr>
								<td>Nama Siswa</td>
								<td>:</td>
								<td><?= $siswa['nama'] ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td><?= $siswa['jenis_kelamin'] ?></td>
							</tr>
							<tr>
								<td>Tanggal Lahir</td>
								<td>:</td>
								<td><?= $siswa['tanggal_lahir'] ?></td>
							</tr>
							<tr>
								<td>Nama Wali</td>
								<td>:</td>
								<td><?= $siswa['nama_wali'] ?></td>
							</tr>
							<tr>
								<td>Tahun Masuk</td>
								<td>:</td>
								<td><?= $siswa['tahun_masuk'] ?></td>
							</tr>
						</tbody>
					</table>
					<form class="mt-4" method="POST">
						<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
							<?php
							$mapel = $pengajaranMapel['mapel_id'];
							$siswas = $siswa['id_siswa'];
							$query = "SELECT *
													FROM `tb_nilai`
													JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
													JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
													JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
													WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
													AND `tb_nilai`.`siswa_id` = $siswas
													AND `tb_nilai`.`mapel_id` = $mapel
													GROUP BY `tb_nilai`.`siswa_id`
												";
							$nilai = $this->db->query($query)->row_array();
							?>
							<input type="hidden" name="pengajaran_id" value="<?= $pengajaran_id ?>">
							<div class="form-group">
								<label><?= $pengajaranMapel['mata_pelajaran'] ?></label>
								<input type="text" name="<?= $pengajaranMapel['id_mapel'] ?>" class="form-control <?= form_error($pengajaranMapel['id_mapel']) ? 'is-invalid' : '' ?>" value="<?= set_value($pengajaranMapel['id_mapel'], $nilai['nilai']) ?>">
								<div class="invalid-feedback"><?= form_error($pengajaranMapel['id_mapel']) ?></div>
							</div>
						<?php endforeach ?>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
