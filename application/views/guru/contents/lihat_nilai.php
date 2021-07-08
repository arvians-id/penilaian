<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Nilai</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">Guru</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/nilai/' . $pengajaran_id) ?>">Detail Pengajaran</a></li>
				<li class="breadcrumb-item active">Nilai</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
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
											<td><?= $nilai['nilai'] ?></td>
										<?php endforeach ?>
										<?php
										$queryAs = "SELECT *,SUM(nilai) as jumlah, AVG(nilai) as total
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
											<td></td>
											<td></td>
										<?php endif ?>
									</tr>
								<?php endforeach ?>
							<?php endif ?>

							<tr>
								<td colspan="2">Jumlah</td>
								<?php foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
									<?php
									$mapel = $pengajaranMapel['mapel_id'];
									$queryJml = "SELECT *,SUM(nilai) as jumlah
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
									$queryJml = "SELECT *,AVG(nilai) as rata
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
					<a href="<?= base_url('guru/excel/' . $pengajaran_id) ?>" class="btn btn-secondary btn-sm">Export to Excel</a>
				</div>
			</div>
		</div>
	</div>
</div>
