<header class="topbar">
	<nav class="navbar top-navbar navbar-expand-md navbar-light">
		<a class="navbar-brand" href="/">
			<span class="text-secondary">
				<img src="<?= base_url() ?>assets/layout/logo.png" width="100" alt="Logo" class="light-logo" />
			</span>
		</a>
		<div class="navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<!-- This is  -->
				<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="icon-Bulleted-List"></i></a> </li>
				<li class="nav-item hidden-sm-down"><span></span></li>
			</ul>
			<ul class="navbar-nav my-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= ucfirst($cekUser['username']) ?> &nbsp;</a>
					<div class="dropdown-menu dropdown-menu-right">
						<ul class="dropdown-user">
							<li>
								<div class="dw-user-box">
									<div class="u-text">
										<p class="text-muted"><?= $cekUser['username'] ?></p>
									</div>
								</div>
							</li>
							<li role="separator" class="divider"></li>
							<li><a href="<?= base_url('guru/profil') ?>"><i class="icon-User"></i> Profil Saya</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?= base_url('login/logout') ?>"><i class="icon-Power-2"></i> Keluar</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</nav>
</header>
