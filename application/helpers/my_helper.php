<?php

// fungsi untuk mengecek apakah sudah login atau belum
// Jika sudah login maka akan dialhikan ke halaman admin
function is_logged_in()
{
	$ths = &get_instance();
	// Cek jika user udah login, tapi mau balik ke halaman login
	if ($ths->session->userdata('username')) {
		// Redirect in aja ke admin
		redirect('admin');
	}
}

// fungsi untuk mengecek apakah sudah login atau belum
// Jika belum login maka akan dialhikan ke halaman login
function is_logged_not_in()
{
	$ths = &get_instance();
	if ($ths->session->userdata('role') == 'guru' && $ths->uri->segment(1) == 'admin') {
		redirect('guru');
	}
	if ($ths->session->userdata('role') == 'admin' && $ths->uri->segment(1) == 'guru') {
		redirect('admin');
	}
	if (!$ths->session->userdata('username')) {
		$ths->session->set_flashdata('error', 'Login terlebih dahulu');
		redirect('login');
	}
}

// Untuk mengaktifkan menu di home
function activeMenu($arrayMenu)
{
	$ths = &get_instance();
	return !in_array($ths->uri->segment(2), $arrayMenu) ?: 'class="active"';
}
