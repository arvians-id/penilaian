<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Siswa</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/pengguna">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item active">Siswa</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Siswa Anda</div>
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
					<div class="row">
						<div class="col-6">
							<h3>Semua Data Siswa</h3>
							<hr>
							<div class="table-responsive">
								<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Jenis Kelamin</th>
											<th>Wali</th>
											<th>Tahun Masuk</th>
											<th style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($siswaS)) : ?>
											<tr id="alert-data">
												<td colspan="6">
													<div class="alert alert-danger" role="alert">
														Belum ada data siswa
													</div>
												</td>
											</tr>
										<?php else : ?>
											<?php $no = 1;
											foreach ($siswaS as $siswa) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $siswa['nama'] ?></td>
													<td><?= $siswa['jenis_kelamin'] ?></td>
													<td><?= $siswa['nama_wali'] ?></td>
													<td><?= $siswa['tahun_masuk'] ?></td>
													<td style="text-align:center">
														<form action="<?= base_url('guru/add_siswa/' . $siswa['id_siswa']) ?>" method="POST">
															<input type="hidden" name="pengajaran_id" value="<?= $pengajaran_id ?>">
															<button type="submit" class="btn btn-secondary btn-sm">+</button>
														</form>
													</td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-6">
							<h3>Siswa Yang Diambil</h3>
							<hr>
							<div class="table-responsive">
								<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Jenis Kelamin</th>
											<th>Wali</th>
											<th>Tahun Masuk</th>
											<th style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($pengajaranSiswaS)) : ?>
											<tr id="alert-data">
												<td colspan="6">
													<div class="alert alert-danger" role="alert">
														Belum ada siswa yang anda ambil
													</div>
												</td>
											</tr>
										<?php else : ?>
											<?php $no = 1;
											foreach ($pengajaranSiswaS as $pengajaranSiswa) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $pengajaranSiswa['nama'] ?></td>
													<td><?= $pengajaranSiswa['jenis_kelamin'] ?></td>
													<td><?= $pengajaranSiswa['nama_wali'] ?></td>
													<td><?= $pengajaranSiswa['tahun_masuk'] ?></td>
													<td style="text-align:center">
														<form action="<?= base_url('guru/remove_siswa/' . $pengajaranSiswa['id_siswa']) ?>" method="POST" onsubmit="return confirm('Jika anda menghapus siswa ini, maka anda setuju akan hilangnya data siswa dan nilai-nilai yang bersangkutan dengan siswa ini. Namun anda tidak perlu khawatir, data siswa di dalam pengajaran lain tidak akan ikut terhapus.');">
															<input type="hidden" name="pengajaran_id" value="<?= $pengajaran_id ?>">
															<button type="submit" class="btn btn-secondary btn-sm">-</button>
														</form>
													</td>
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
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
