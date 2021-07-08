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
				<li> <a class="waves-effect waves-dark" href="<?= base_url('admin/pengajaran') ?>" aria-expanded="false"><i class="icon-Address-Book2"></i><span class="hide-menu">Pengajaran</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('admin/profil') ?>" aria-expanded="false"><i class="icon-User"></i><span class="hide-menu">Profil</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('login/logout') ?>" aria-expanded="false"><i class="icon-Power-2"></i><span class="hide-menu">Keluar</span></a></li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
