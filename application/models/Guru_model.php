<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
	public function simpanGuru()
	{
		$data = [
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('tanggal_lahir')),
			'role' => 'guru',
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'nip' => $this->input->post('nip'),
			'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
			'agama' => $this->input->post('agama'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('tb_autentikasi', $data);
	}
}
