<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Nilai Siswa</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/pengguna">Admin</a></li>
				<li class="breadcrumb-item active">Kelola Nilai Siswa</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Nilai</div>
				<div class="card-body">
					<div class="row mb-2">
						<div class="col-4">
							<h3>Nama Guru : <?= $pengajaran['nama'] ?></h3>
						</div>
						<div class="col-4">
							<h3>Tahun Ajaran : <?= $pengajaran['tahun_ajaran'] ?></h3>
						</div>
						<div class="col-4">
							<h3>Semester : <?= $pengajaran['semester'] ?></h3>
						</div>
					</div>
					<table class="table table-bordered">
						<tbody>
							<tr>
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
								<?php foreach ($pengajaranSiswaS as $pengajaranSiswa) : ?>
									<?php $siswa = $pengajaranSiswa['siswa_id']; ?>
									<tr>
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
										$cariTotal = $this->db->query($queryAs)->result_array();
										?>
										<?php foreach ($cariTotal as $cari) : ?>
											<td><?= $cari['jumlah'] ?></td>
											<td><?= round($cari['total'], 1) ?></td>
										<?php endforeach ?>
									</tr>
								<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
