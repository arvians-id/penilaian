<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-devider"></li>
				<li class="nav-small-cap">Admin</li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('guru') ?>" aria-expanded="false"><i class="icon-Home"></i><span class="hide-menu">Beranda</span></a></li>
				<li> <a class="waves-effect waves-dark" href="<?= base_url('guru/pengajaran') ?>" aria-expanded="false"><i class="icon-Address-Book2"></i><span class="hide-menu">Pengajaran</span></a></li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Security-Settings"></i><span class="hide-menu">Lainnya</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('guru/profil') ?>">Profil</a></li>
						<li><a href="<?= base_url('login/logout') ?>">Keluar</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
