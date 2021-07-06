<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-devider"></li>
				<li class="nav-small-cap">Admin</li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('admin') ?>" aria-expanded="false"><i class="icon-Home"></i><span class="hide-menu">Beranda</span></a></li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Big-Data"></i><span class="hide-menu">Master Data</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/guru') ?>">Guru</a></li>
						<li><a href="<?= base_url('admin/siswa') ?>">Siswa</a></li>
						<li><a href="<?= base_url('admin/mata_pelajaran') ?>">Mata Pelajaran</a></li>
						<li><a href="<?= base_url('admin/tahun_ajaran') ?>">Tahun Ajaran</a></li>
					</ul>
				</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Mail-Read"></i><span class="hide-menu">Kelola Laporan</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/laporan_siswa') ?>">Nilai Siswa</a></li>
					</ul>
				</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Security-Settings"></i><span class="hide-menu">Lainnya</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/profil') ?>">Profil</a></li>
						<li><a href="<?= base_url('login/logout') ?>">Keluar</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
