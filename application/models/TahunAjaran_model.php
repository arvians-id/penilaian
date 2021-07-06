<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TahunAjaran_model extends CI_Model
{
	public function simpanTahunAjaran()
	{
		$data = [
			'tahun_ajaran' => $this->input->post('tahun_ajaran'),
			'semester' => $this->input->post('semester'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('tb_data_tahun_ajaran', $data);
	}
	public function ubahTahunAjaran($id_ta)
	{
		$data = [
			'tahun_ajaran' => $this->input->post('tahun_ajaran'),
			'semester' => $this->input->post('semester'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('id_ta', $id_ta);
		$this->db->update('tb_data_tahun_ajaran', $data);
	}
}
