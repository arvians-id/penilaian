<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{ // Jika user belum login
		is_logged_in();

		// Validasi form
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		// Jika Form validasi nya salah
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Login'
			];
			$this->load->view('login', $data);

			// Tapi jika sudah memenuhi aturan required
		} else {
			// Ambil inputan
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Jika usernya ada, cek ke database
			$cekUser = $this->db->get_where('tb_autentikasi', ['username' => $username, 'password' => md5($password)])->row_array();
			if ($cekUser) {
				// Lalu Bikin data untuk di masukkan ke session
				$setSession = [
					'id' => $cekUser['id'],
					'email' => $cekUser['email'],
					'username' => $cekUser['username'],
					'role' => $cekUser['role'],
				];
				// Set ke session data di atas
				$this->session->set_userdata($setSession);
				$cekUser['role'] == 'admin' ? redirect('admin') : redirect('guru');
			}
			$this->session->set_flashdata('error', 'Username atau password salah!');
			redirect('login');
		}
	}
	public function logout()
	{
		$data = ['id', 'email', 'username', 'role']; // data yang akan di masukkan ke userdata
		// Unset userdata/session
		$this->session->unset_userdata($data);
		// Kembalikan ke halaman login lagi setelah session dihapus
		$this->session->set_flashdata('success', 'Anda berhasil keluar.');
		redirect('login');
	}
}
