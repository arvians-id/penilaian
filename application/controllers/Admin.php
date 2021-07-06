<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load Model
		// Parameter pertama load file model, Parameter kedua adalah nama alias dari model parameter pertama
		$this->load->model('Guru_model', 'guru_m');
		$this->load->model('Siswa_model', 'siswa_m');
		$this->load->model('MataPelajaran_model', 'mapel_m');
		$this->load->model('TahunAjaran_model', 'ta_m');
		is_logged_not_in(); // Jika sudah login, lalu mengakses halaman login maka tidak akan bisa dan akan d alihkan ke halaman admin
	}
	public function index()
	{
		$data = [
			'judul' => 'Admin | Home',
			'viewUtama' => 'admin/contents/index',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
		];
		$this->load->view('admin/layouts/wrapperIndex', $data);
	}
	public function guru()
	{
		$data = [
			'judul' => 'Admin | Kelola Guru',
			'viewUtama' => 'admin/contents/guru',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'guruS' => $this->db->get_where('tb_autentikasi', ['role' => 'guru'])->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_guru()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_dash|max_length[25]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric|max_length[20]');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan', 'required|max_length[25]');
		$this->form_validation->set_rules('agama', 'Agama', 'required|max_length[25]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman guru
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_guru',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->simpanGuru(); // Insert data guru
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/guru'); // redirect ke halaman guru
		}
	}
	public function siswa()
	{
		$data = [
			'judul' => 'Admin | Kelola Siswa',
			'viewUtama' => 'admin/contents/siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'siswaS' => $this->db->get('tb_data_siswa')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_siswa()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nama_wali', 'Nama Wali', 'required|max_length[13]');
		$this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required|max_length[4]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman siswa
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_siswa',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->siswa_m->simpanSiswa(); // Insert data siswa
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/siswa'); // redirect ke halaman siswa
		}
	}
	public function update_siswa($id_siswa)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nama_wali', 'Nama Wali', 'required|max_length[13]');
		$this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required|max_length[4]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman siswa
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_siswa',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'siswa' => $this->db->get_where('tb_data_siswa', ['id_siswa' => $id_siswa])->row_array()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->siswa_m->ubahSiswa($id_siswa); // Insert data siswa
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/siswa'); // redirect ke halaman siswa
		}
	}
	public function mata_pelajaran()
	{
		$data = [
			'judul' => 'Admin | Kelola Mata Pelajaran',
			'viewUtama' => 'admin/contents/mata_pelajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'mataPelajaranS' => $this->db->get('tb_data_mata_pelajaran')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_mata_pelajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|max_length[10]|is_unique[tb_data_mata_pelajaran.kode_mapel]');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|max_length[25]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman mata_pelajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_mata_pelajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->mapel_m->simpanMataPelajaran(); // Insert data mata_pelajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/mata_pelajaran'); // redirect ke halaman mata_pelajaran
		}
	}
	public function update_mata_pelajaran($id_mapel)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|max_length[10]');
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'required|max_length[25]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman mata_pelajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_mata_pelajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'mata_pelajaran' => $this->db->get_where('tb_data_mata_pelajaran', ['id_mapel' => $id_mapel])->row_array()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->mapel_m->ubahMataPelajaran($id_mapel); // Insert data mata_pelajaran
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/mata_pelajaran'); // redirect ke halaman mata_pelajaran
		}
	}
	public function tahun_ajaran()
	{
		$data = [
			'judul' => 'Admin | Kelola Tahun Ajaran',
			'viewUtama' => 'admin/contents/tahun_ajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'tahunAjaranS' => $this->db->get('tb_data_tahun_ajaran')->result_array()
		];
		$this->load->view('admin/layouts/wrapperData', $data);
	}
	public function add_tahun_ajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|max_length[15]');
		$this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman tahun_ajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_tahun_ajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->ta_m->simpanTahunAjaran(); // Insert data tahun_ajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/tahun_ajaran'); // redirect ke halaman tahun_ajaran
		}
	}
	public function update_tahun_ajaran($id_ta)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required|max_length[15]');
		$this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman tahun_ajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/form_tahun_ajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'tahun_ajaran' => $this->db->get_where('tb_data_tahun_ajaran', ['id_ta' => $id_ta])->row_array()
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->ta_m->ubahTahunAjaran($id_ta); // Insert data tahun_ajaran
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/tahun_ajaran'); // redirect ke halaman tahun_ajaran
		}
	}
}
