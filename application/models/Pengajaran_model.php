<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajaran_model extends CI_Model
{
	public function getPengajaran($pengajaran_id = null)
	{
		$this->db->select('*');
		$this->db->from('tb_pengajaran a');
		$this->db->join('tb_autentikasi b', 'b.id = a.guru_id');
		$this->db->join('tb_data_tahun_ajaran c', 'c.id_ta = a.ta_id');
		$this->db->where('a.guru_id', $this->session->userdata('id'));
		if ($pengajaran_id != null) {
			$this->db->where('a.id_pengajaran', $pengajaran_id);
		}
		return $this->db->get(); // tampilkan semua data
	}
	public function getPengajaranMapel($pengajaran_id)
	{
		$this->db->select('*');
		$this->db->from('tb_pengajaran_mapel a');
		$this->db->join('tb_pengajaran b', 'b.id_pengajaran = a.pengajaran_id');
		$this->db->join('tb_autentikasi c', 'c.id = b.guru_id');
		$this->db->join('tb_data_tahun_ajaran d', 'd.id_ta = b.ta_id');
		$this->db->join('tb_data_mata_pelajaran e', 'e.id_mapel = a.mapel_id');
		$this->db->where('b.guru_id', $this->session->userdata('id'));
		$this->db->where('a.pengajaran_id', $pengajaran_id);
		return $this->db->get()->result_array(); // tampilkan semua data
	}
	public function getPengajaranSiswa($pengajaran_id)
	{
		$this->db->select('*');
		$this->db->from('tb_pengajaran_siswa a');
		$this->db->join('tb_pengajaran b', 'b.id_pengajaran = a.pengajaran_id');
		$this->db->join('tb_autentikasi c', 'c.id = b.guru_id');
		$this->db->join('tb_data_tahun_ajaran d', 'd.id_ta = b.ta_id');
		$this->db->join('tb_data_siswa e', 'e.id_siswa = a.siswa_id');
		$this->db->where('b.guru_id', $this->session->userdata('id'));
		$this->db->where('a.pengajaran_id', $pengajaran_id);
		return $this->db->get()->result_array(); // tampilkan semua data
	}
	public function simpanPengajaran()
	{
		$data = [
			'guru_id' => $this->session->userdata('id'),
			'ta_id' => $this->input->post('ta_id'),
			'kelas' => $this->input->post('kelas'),
		];
		$this->db->insert('tb_pengajaran', $data);
	}
	public function simpanPengajaranMapel($mapel_id)
	{
		$data = [
			'pengajaran_id' => $this->input->post('pengajaran_id'),
			'mapel_id' => $mapel_id
		];
		$this->db->insert('tb_pengajaran_mapel', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function hapusPengajaranMapel($mapel_id)
	{
		$this->db->delete('tb_pengajaran_mapel', ['mapel_id' => $mapel_id, 'pengajaran_id' => $this->input->post('pengajaran_id')]);
	}
	public function simpanPengajaranSiswa($siswa_id)
	{
		$data = [
			'pengajaran_id' => $this->input->post('pengajaran_id'),
			'siswa_id' => $siswa_id
		];
		$this->db->insert('tb_pengajaran_siswa', $data);

		return ($this->db->affected_rows() != 1) ? false : true;
	}
	public function hapusPengajaranSiswa($siswa_id)
	{
		$this->db->delete('tb_pengajaran_siswa', ['siswa_id' => $siswa_id, 'pengajaran_id' => $this->input->post('pengajaran_id')]);
	}
	public function lihatNilai($pengajaran_id)
	{
		$this->db->select('*');
		$this->db->from('tb_nilai a');
		$this->db->join('tb_pengajaran b', 'b.id_pengajaran = a.pengajaran_id');
		$this->db->join('tb_data_siswa c', 'c.id_siswa = a.siswa_id');
		$this->db->join('tb_data_mata_pelajaran d', 'd.id_mapel = a.mapel_id');
		$this->db->where('b.guru_id', $this->session->userdata('id'));
		$this->db->where('a.pengajaran_id', $pengajaran_id);
		return $this->db->get()->result_array(); // tampilkan semua data
	}
}
