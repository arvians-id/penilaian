<?php
defined('BASEPATH') or exit('No direct script access allowed');
// memanggil autoload library phpoffice
require('./application/third_party/phpoffice/vendor/autoload.php');

// Memanggil namespace class yang berada di library phpoffice
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
	public function profil()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[25]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric|max_length[20]');
		$this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan', 'required|max_length[25]');
		$this->form_validation->set_rules('agama', 'Agama', 'required|max_length[25]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[100]');
		$this->form_validation->set_rules('password', 'Password', 'min_length[5]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman profil
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Guru | Tambah Pengajaran',
				'viewUtama' => 'guru/contents/profil',
				'cekUser' => $this->db->get_where('tb_autentikasi', ['username' => $this->session->userdata('username')])->row_array(),
			];
			$this->load->view('guru/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->guru_m->ubahProfil();
			$this->session->set_flashdata('success', 'Profil berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('guru/profil'); // redirect ke halaman profil
		}
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
		$this->pengajaran_m->simpanPengajaranSiswa($siswa_id, $pengajaran_id);

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
	public function excel($pengajaran_id)
	{
		$pengajaran =  $this->pengajaran_m->getPengajaran($pengajaran_id)->row_array();
		$pengajaranMapelS = $this->pengajaran_m->getPengajaranMapel($pengajaran_id);
		$pengajaranSiswaS = $this->pengajaran_m->getPengajaranSiswa($pengajaran_id);
		// Ini Instance untuk export Excel
		$excel = new Spreadsheet();

		$excel->getProperties()->setCreator('Muhammad Alfansa Yazib')
			->setLastModifiedBy('Muhammad Alfansa Yazib')
			->setTitle('SEKOLAH DINIYYAH TARBIYYATUL FALAAH TUGU')
			->setSubject("DAFTAR HASIL TES BELAJAR DINIYYAH TARBIYYATUL FALAAH TUGU")
			->setCategory("Daftar Nilai");

		$excel->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nama Murid');

		$no = 67;
		foreach ($pengajaranMapelS as $pengajaranMapel) {
			$excel->setActiveSheetIndex(0)
				->setCellValue(chr($no++) . '1', $pengajaranMapel['mata_pelajaran']);
		}
		$excel->setActiveSheetIndex(0)
			->setCellValue(chr($no++) . '1', 'Jumlah')
			->setCellValue(chr($no++) . '1', 'Nilai');
		$column = 2;
		$urutan = 1;
		$noB = 67;
		if (is_array($pengajaranSiswaS)) {
			foreach ($pengajaranSiswaS as $pengajaranSiswa) {
				$siswa = $pengajaranSiswa['siswa_id'];
				$excel->setActiveSheetIndex(0)
					->setCellValue('A' . $column, $urutan++)
					->setCellValue('B' . $column, $pengajaranSiswa['nama']);
				foreach ($pengajaranMapelS as $pengajaranMapel) {
					$mapel = $pengajaranMapel['mapel_id'];
					$query = "SELECT *
								FROM `tb_nilai`
								JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
								JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
								JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
								WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
								AND `tb_nilai`.`siswa_id` = $siswa
								AND `tb_nilai`.`mapel_id` = $mapel
								GROUP BY `tb_nilai`.`siswa_id`
							";
					$nilai = $this->db->query($query)->row_array();
					$excel->setActiveSheetIndex(0)
						->setCellValue(chr($noB++) . $column, $nilai['nilai']);
				}
				$queryAs = "SELECT *,SUM(nilai) as jumlah, AVG(nilai) as total
								FROM `tb_nilai`
								JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
								JOIN `tb_data_siswa` ON `tb_data_siswa`.`id_siswa` = `tb_nilai`.`siswa_id`
								JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
								WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
								AND `tb_nilai`.`siswa_id` = $siswa
								GROUP BY `tb_nilai`.`siswa_id`
							";
				$cariTotal = $this->db->query($queryAs)->row_array();
				$excel->setActiveSheetIndex(0)
					->setCellValue(chr($noB++) . $column, $cariTotal['jumlah'])
					->setCellValue(chr($noB++) . $column, round($cariTotal['total'], 1));
				$noB = 67;
				$column++;
			}

			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . $column, 'Jumlah');
			foreach ($pengajaranMapelS as $pengajaranMapel) {
				$mapel = $pengajaranMapel['mapel_id'];
				$queryJml = "SELECT *,SUM(nilai) as jumlah
							FROM `tb_nilai`
							JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
							JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
							WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
							AND `tb_nilai`.`mapel_id` = $mapel
							GROUP BY `tb_nilai`.`mapel_id`
					";
				$cariS = $this->db->query($queryJml)->result_array();
				foreach ($cariS as $cari) {
					$excel->setActiveSheetIndex(0)
						->setCellValue(chr($noB++) . $column, $cari['jumlah']);
				}
			}
			$noB = 67;
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 1), 'Rata-Rata Kelas');
			foreach ($pengajaranMapelS as $pengajaranMapel) {
				$mapel = $pengajaranMapel['mapel_id'];
				$queryJml = "SELECT *,AVG(nilai) as rata
							FROM `tb_nilai`
							JOIN `tb_pengajaran` ON `tb_pengajaran`.`id_pengajaran` = `tb_nilai`.`pengajaran_id`
							JOIN `tb_data_mata_pelajaran` ON `tb_data_mata_pelajaran`.`id_mapel` = `tb_nilai`.`mapel_id`
							WHERE `tb_nilai`.`pengajaran_id` = $pengajaran_id
							AND `tb_nilai`.`mapel_id` = $mapel
							GROUP BY `tb_nilai`.`mapel_id`
					";
				$cariR = $this->db->query($queryJml)->result_array();
				foreach ($cariR as $cari) {
					$excel->setActiveSheetIndex(0)
						->setCellValue(chr($noB++) . ($column + 1), round($cari['rata'], 1));
				}
			}
			$noB = 67;
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 3), 'DAFTAR HASIL TES BELAJAR DINIYYAH TARBIYYATUL FALAH TUGU');
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 4), 'SEMESTER ' . $pengajaran['semester'] . ' TAHUN AJARAN ' . $pengajaran['tahun_ajaran']);
			$excel->setActiveSheetIndex(0)
				->setCellValue('A' . ($column + 5), 'KELAS ' . $pengajaran['kelas']);
		}
		$writer = new Xlsx($excel);
		$fileName = bin2hex(random_bytes(12));

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
		exit;
	}
}
