<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MataPelajaran_model extends CI_Model
{
	public function simpanMataPelajaran()
	{
		$data = [
			'kode_mapel' => $this->input->post('kode_mapel'),
			'mata_pelajaran' => $this->input->post('mata_pelajaran'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('tb_data_mata_pelajaran', $data);
	}
	public function ubahMataPelajaran($id_mapel)
	{
		$data = [
			'kode_mapel' => $this->input->post('kode_mapel'),
			'mata_pelajaran' => $this->input->post('mata_pelajaran'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('id_mapel', $id_mapel);
		$this->db->update('tb_data_mata_pelajaran', $data);
	}
}
