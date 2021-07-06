<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajaran_model extends CI_Model
{
	public function getPengajaran()
	{
		$this->db->select('*');
		$this->db->from('tb_pengajaran a');
		$this->db->join('tb_autentikasi b', 'b.id = a.guru_id');
		$this->db->join('tb_data_tahun_ajaran c', 'c.id_ta = a.ta_id');
		$this->db->where('a.guru_id', $this->session->userdata('id'));
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
}
