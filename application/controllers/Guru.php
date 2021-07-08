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
			'pengajaranS' => $this->pengajaran_m->getPengajaran()->result_array()
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
	public function hapus($id_pengajaran)
	{
		$this->db->delete('tb_pengajaran', ['id_pengajaran' => $id_pengajaran]);
		$this->session->set_flashdata('success', 'Pengajaran berhasil dihapus.'); // Membuat pesan notif jika insert data berhasil
		redirect('guru/pengajaran'); // redirect ke halaman pengajaran
	}
	public function mapel($pengajaran_id)
	{
		$data = [
			'judul' => 'Guru | Mata Pelajaran',
			'viewUtama' => 'guru/contents/mapel',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'mata_pelajaranS' => $this->db->get('tb_data_mata_pelajaran')->result_array(),
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function add_mapel($mapel_id)
	{
		$pengajaran_id = $this->input->post('pengajaran_id');

		if ($this->pengajaran_m->simpanPengajaranMapel($mapel_id) == false) { // Insert data pengajaran
			$this->session->set_flashdata('error', 'Mata pelajaran sudah dimasukkan'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/mapel/' . $pengajaran_id); // redirect ke halaman pengajaran
		}
		$this->session->set_flashdata('success', 'Mata pelajaran berhasil dibuat'); // Membuat pesan notif jika insert data berhasil
		redirect('guru/mapel/' . $pengajaran_id); // redirect ke halaman pengajaran
	}
	public function remove_mapel($mapel_id)
	{
		$pengajaran_id = $this->input->post('pengajaran_id');

		$this->pengajaran_m->hapusPengajaranMapel($mapel_id); // Delete data pengajaran
		$this->session->set_flashdata('success', 'Mata pelajaran berhasil dihapus'); // Membuat pesan notif jika delete data berhasil
		redirect('guru/mapel/' . $pengajaran_id); // redirect ke halaman pengajaran
	}
	public function siswa($pengajaran_id)
	{
		$data = [
			'judul' => 'Guru | Siswa',
			'viewUtama' => 'guru/contents/siswa',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'siswaS' => $this->db->get('tb_data_siswa')->result_array(),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function add_siswa($siswa_id)
	{
		$pengajaran_id = $this->input->post('pengajaran_id');

		if ($this->pengajaran_m->simpanPengajaranSiswa($siswa_id) == false) { // Insert data pengajaran
			$this->session->set_flashdata('error', 'Siswa sudah dimasukkan'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/siswa/' . $pengajaran_id); // redirect ke halaman pengajaran
		}
		$this->session->set_flashdata('success', 'Siswa berhasil dibuat'); // Membuat pesan notif jika insert data berhasil
		redirect('guru/siswa/' . $pengajaran_id); // redirect ke halaman pengajaran
	}
	public function remove_siswa($siswa_id)
	{
		$pengajaran_id = $this->input->post('pengajaran_id');

		$this->pengajaran_m->hapusPengajaranSiswa($siswa_id); // Delete data pengajaran
		$this->session->set_flashdata('success', 'Siswa berhasil dihapus'); // Membuat pesan notif jika delete data berhasil
		redirect('guru/siswa/' . $pengajaran_id); // redirect ke halaman pengajaran
	}
	public function nilai($pengajaran_id)
	{
		$data = [
			'judul' => 'Guru | Detail Pengajaran',
			'viewUtama' => 'guru/contents/nilai',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaran' => $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array(),
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
	public function input($pengajaran_id, $siswa_id)
	{
		$pengajaranMapelS = $this->pengajaran_m->getPengajaranMapel($pengajaran_id);
		$siswa = $this->db->get_where('tb_data_siswa', ['id_siswa' => $siswa_id])->row_array();
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		foreach ($pengajaranMapelS as $pengajaranMapel) {
			$this->form_validation->set_rules($pengajaranMapel['id_mapel'], 'Input', 'numeric|greater_than_equal_to[0]|less_than_equal_to[100]');
		}

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman pengajaran
		if ($this->form_validation->run() == FALSE) {
			$pengajaran_siswa = $this->db->get_where('tb_pengajaran_siswa', ['pengajaran_id' => $pengajaran_id, 'siswa_id' => $siswa_id])->row_array();
			if ($pengajaran_siswa) {
				$data = [
					'judul' => 'Guru | Input Nilai',
					'viewUtama' => 'guru/contents/input',
					'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
					'pengajaran' => $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array(),
					'pengajaranMapelS' => $pengajaranMapelS,
					'siswa' => $siswa,
					'pengajaran_id' => $pengajaran_id
				];
				$this->load->view('guru/layouts/wrapperForm', $data);
			}
		} else {
			foreach ($pengajaranMapelS as $pengajaranMapel) {
				$data = [
					'pengajaran_id' => $pengajaran_id,
					'siswa_id' => $siswa_id,
					'mapel_id' => $pengajaranMapel['mapel_id'],
					'nilai' => $this->input->post($pengajaranMapel['id_mapel'])
				];
				$this->db->replace('tb_nilai', $data); // Insert data pengajaran
			}
			$this->session->set_flashdata('success', 'Nilai ' . $siswa['nama'] . ' berhasil di input.'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/nilai/' . $pengajaran_id); // redirect ke halaman pengajaran
		}
	}
	public function lihat_nilai($pengajaran_id)
	{
		$data = [
			'judul' => 'Guru | Nilai',
			'viewUtama' => 'guru/contents/lihat_nilai',
			'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'pengajaran' => $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array(),
			'pengajaranMapelS' => $this->pengajaran_m->getPengajaranMapel($pengajaran_id),
			'pengajaranSiswaS' => $this->pengajaran_m->getPengajaranSiswa($pengajaran_id),
			'lihat_nilai' => $this->pengajaran_m->lihatNilai($pengajaran_id),
			'pengajaran_id' => $pengajaran_id
		];
		$this->load->view('guru/layouts/wrapperData', $data);
	}
}
