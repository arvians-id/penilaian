<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Mata Pelajaran</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/pengguna">Admin</a></li>
				<li class="breadcrumb-item"><a href="<?= base_url('guru/pengajaran') ?>">Kelola Pengajaran</a></li>
				<li class="breadcrumb-item active">Mata Pelajaran</li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<!-- table responsive -->
			<div class="card ribbon-wrapper">
				<div class="ribbon ribbon-bookmark ribbon-default">Data Mata Pelajaran Anda</div>
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
							<h3>Semua Data Mata Pelajaran</h3>
							<hr>
							<div class="table-responsive">
								<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Mata Pelajaran</th>
											<th style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($mata_pelajaranS)) : ?>
											<tr id="alert-data">
												<td colspan="3">
													<div class="alert alert-danger" role="alert">
														Belum ada data mata pelajaran
													</div>
												</td>
											</tr>
										<?php else : ?>
											<?php $no = 1;
											foreach ($mata_pelajaranS as $mata_pelajaran) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $mata_pelajaran['kode_mapel'] ?></td>
													<td><?= $mata_pelajaran['mata_pelajaran'] ?></td>
													<td style="text-align:center">
														<form action="<?= base_url('guru/add_mapel/' . $mata_pelajaran['id_mapel']) ?>" method="POST">
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
							<h3>Mata Pelajaran Yang Diambil</h3>
							<hr>
							<div class="table-responsive">
								<table id="all-table" data-all="all" class="table display table-bordered table-striped no-wrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Mata Pelajaran</th>
											<th style="text-align:center"></th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($pengajaranMapelS)) : ?>
											<tr id="alert-data">
												<td colspan="4">
													<div class="alert alert-danger" role="alert">
														Belum ada mata pelajaran yang anda ambil
													</div>
												</td>
											</tr>
										<?php else : ?>
											<?php $no = 1;
											foreach ($pengajaranMapelS as $pengajaranMapel) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $pengajaranMapel['kode_mapel'] ?></td>
													<td><?= $pengajaranMapel['mata_pelajaran'] ?></td>
													<td style="text-align:center">
														<form action="<?= base_url('guru/remove_mapel/' . $pengajaranMapel['mapel_id']) ?>" method="POST" onsubmit="return confirm('Jika anda menghapus mata pelajaran ini, maka anda setuju akan hilangnya data nilai pada siswa yang bersangkutan dengan mata pelajaran ini. Namun anda tidak perlu khawatir, data mata pelajaran di dalam pengajaran lain tidak akan ikut terhapus.');">
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
