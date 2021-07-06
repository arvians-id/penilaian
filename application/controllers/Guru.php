<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load Model
		// Parameter pertama load file model, Parameter kedua adalah nama alias dari model parameter pertama
		$this->load->model('Guru_model', 'guru_m');
		$this->load->model('Pengajaran_model', 'pengajaran_m');
		is_logged_not_in(); // Jika sudah login, lalu mengakses halaman login maka tidak akan bisa dan akan d alihkan ke halaman guru
	}
	public function index()
	{
		$data = [
			'judul' => 'Guru | Home',
			'viewUtama' => 'guru/contents/index',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
		];
		$this->load->view('guru/layouts/wrapperIndex', $data);
	}
	public function pengajaran()
	{
		$data = [
			'judul' => 'Guru | Pengajaran',
			'viewUtama' => 'guru/contents/pengajaran',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaranS' => $this->pengajaran_m->getPengajaran()
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function add_pengajaran()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('ta_id', 'Tahun Ajaran', 'required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|max_length[6]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman pengajaran
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Guru | Tambah Pengajaran',
				'viewUtama' => 'guru/contents/form_pengajaran',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
				'tahun_ajaranS' => $this->db->get('tb_data_tahun_ajaran')->result_array()
			];
			$this->load->view('guru/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->pengajaran_m->simpanPengajaran(); // Insert data pengajaran
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/pengajaran'); // redirect ke halaman pengajaran
		}
	}
}
