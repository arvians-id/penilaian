<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Nilai</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Nilai</li>
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
					<table class="table display table-bordered table-striped no-wrap">
						<thead>
							<tr>
								<th scope="col">No</th>
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
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Nilai</div>
				<div class="card-body">
					<div class="text-center">
						<h3>DAFTAR HASIL TES BELAJAR DINIYYAH TARBIYYATUL FALAH TUGU</h3>
						<h3>SEMESTER <?= $pengajaran['semester'] ?> TAHUN AJARAN <?= $pengajaran['tahun_ajaran'] ?> </h3>
						<h3>KELAS <?= $pengajaran['kelas'] ?> </h3>
					</div>
					<table class="table table-bordered table-hover table-responsive-xl">
						<tbody>
							<tr>
								<td rowspan="2" style="vertical-align : middle;text-align:center;">No</td>
								<td rowspan="2" style="vertical-align : middle;text-align:center;">Nama Siswa</td>
								<td colspan="<?= count($pengajaranMapelS) ?>" style="text-align: center;">Bidang Pelajaran</td>
								<td colspan="2" style="text-align: center;">Total</td>
							</tr>
							<tr>
								<?php if (empty($pengajaranMapelS)) : ?>
									<td class="text-danger text-center">Mata pelajaran tidak ditemukan!</td>
								<?php else : ?>
									<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
										<td><?= $pengajaranMapel['mata_pelajaran'] ?></td>
									<?php endforeach ?>
								<?php endif ?>
								<td>Jumlah</td>
								<td>Nilai</td>
							</tr>
							<?php if (empty($pengajaranSiswaS)) : ?>
								<td class="text-danger text-center" colspan="15">Siswa tidak ditemukan!</td>
							<?php else : ?>
								<?php $no = 1;
								foreach ($pengajaranSiswaS as $pengajaranSiswa) : ?>
									<?php $siswa = $pengajaranSiswa['siswa_id']; ?>
									<tr>
										<td style="text-align: center;"><?= $no++ ?></td>
										<td><?= $pengajaranSiswa['nama'] ?></td>
										<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
											<?php
											$mapel = $pengajaranMapel['mapel_id'];
											$query = "SELECT *
													FROM `tb_nilai`
													JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
													JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
													JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
													WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
													AND `tb_nilai`.`siswa_id` = $siswa
													AND `tb_nilai`.`mapel_id` = $mapel
													GROUP BY `tb_nilai`.`siswa_id`
												";
											$nilai = $this->db->query($query)->row_array();
											?>
											<td><?= isset($nilai['nilai']) ? $nilai['nilai'] : '<span class="text-danger">Belum ada nilai!</span>' ?></td>
										<?php endforeach ?>
										<?php
										$queryAs = "SELECT SUM(nilai) as jumlah, AVG(nilai) as total
												FROM `tb_nilai`
												JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
												JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
												JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
												WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
												AND `tb_nilai`.`siswa_id` = $siswa
												GROUP BY `tb_nilai`.`siswa_id`
										";
										$cari = $this->db->query($queryAs)->row_array();
										?>
										<?php if (!empty($cari)) : ?>
											<td><?= $cari['jumlah'] ?></td>
											<td><?= round($cari['total'], 1) ?></td>
										<?php else : ?>
											<td><span class="text-danger">Belum ada total!</span></td>
											<td><span class="text-danger">Belum ada total!</span></td>
										<?php endif ?>
									</tr>
								<?php endforeach ?>
							<?php endif ?>

							<tr>
								<td colspan="2">Jumlah</td>
								<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
									<?php
									$mapel = $pengajaranMapel['mapel_id'];
									$queryJml = "SELECT SUM(nilai) as jumlah
												FROM `tb_nilai`
												JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
												JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
												WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
												AND `tb_nilai`.`mapel_id` = $mapel
												GROUP BY `tb_nilai`.`mapel_id`
										";
									$cariTotal = $this->db->query($queryJml)->result_array();
									?>
									<?php foreach ($cariTotal as $cari) : ?>
										<td><?= $cari['jumlah'] ?></td>
									<?php endforeach ?>
								<?php endforeach ?>
							</tr>
							<tr>
								<td colspan="2">Rata-Rata Kelas</td>
								<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
									<?php
									$mapel = $pengajaranMapel['mapel_id'];
									$queryJml = "SELECT AVG(nilai) as rata
												FROM `tb_nilai`
												JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
												JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
												WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
												AND `tb_nilai`.`mapel_id` = $mapel
												GROUP BY `tb_nilai`.`mapel_id`
										";
									$cariTotal = $this->db->query($queryJml)->result_array();
									?>
									<?php foreach ($cariTotal as $cari) : ?>
										<td><?= round($cari['rata'], 1) ?></td>
									<?php endforeach ?>
								<?php endforeach ?>
							</tr>
						</tbody>
					</table>
					<a href="<?= base_url('admin/excel/' . $pengajaran_id) ?>" class="btn btn-secondary btn-sm">Export to Excel</a>
				</div>
			</div>
		</div>
	</div>
</div>
