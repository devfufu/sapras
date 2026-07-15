<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{

	public function getDataUser()
	{
		$this->db->select('
        users.*,
        kategori_barang.nama_kategori
    ');

		$this->db->from('users');

		$this->db->join(
			'kategori_barang',
			'kategori_barang.id_kategori = users.user_kategori',
			'left'
		);

		$this->db->order_by('users.id_user', 'DESC');

		return $this->db->get()->result_array();
	}

	public function getDetailUser($id_user)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function cekUsername($username)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function store_user($data)
	{
		$query = $this->db->insert('users', $data);
		return $query;
	}

	public function delete_user($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("users");
		return $res;
	}

	public function update_user($id_user, $data)
	{
		$this->db->where('id_user', $id_user);
		return $this->db->update('users', $data);
	}

	public function getUserById($id_user)
	{
		return $this->db->get_where('users', ['id_user' => $id_user])->row_array();
	}

}

/* End of file ModelUser.php */
/* Location: ./application/models/ModelUser.php */