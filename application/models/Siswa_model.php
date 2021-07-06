<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
	public function simpanSiswa()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nama_wali' => $this->input->post('nama_wali'),
			'tahun_masuk' => $this->input->post('tahun_masuk'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('tb_data_siswa', $data);
	}
	public function ubahSiswa($id_siswa)
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nama_wali' => $this->input->post('nama_wali'),
			'tahun_masuk' => $this->input->post('tahun_masuk'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('id_siswa', $id_siswa);
		$this->db->update('tb_data_siswa', $data);
	}
}
