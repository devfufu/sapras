<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAset extends CI_Model
{

	public function getAsetWujud()
	{
		$this->db->select('a.*, b.nama_barang, c.nama_lokasi');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->where('a.volume >', 0);

		return $this->db->get()->result_array();
	}
	public function getAsetDihapuskan()
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function storeAset($data)
	{
		$query = $this->db->insert('asets', $data);
		return $query;
	}

	public function searchAset($bar, $column)
	{
		$this->db->select('*');
		$this->db->limit(10);
		$this->db->from('barang');
		$this->db->like('nama_barang', $bar);
		$this->db->order_by('id_barang', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDetailAsetWujud($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getFilterAsetWujud($id_kategori = null, $tahun_perolehan = null, $kondisi = null, $jenis_bantuan = null)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');

		if (!empty($id_kategori)) {
			$this->db->where('b.id_kategori', $id_kategori);
		}

		if (!empty($tahun_perolehan)) {
			$this->db->where('tahun_perolehan', $tahun_perolehan);
		}

		if (!empty($kondisi)) {
			$this->db->where('kondisi', $kondisi);
		}

		if (!empty($jenis_bantuan)) {
			$this->db->where('a.jenis_bantuan', $jenis_bantuan);
		}

		return $this->db->get()->result_array();
	}

	public function getFilterAsetDihapuskan($id_kategori, $tgl_penghapusan)
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->where('id_kategori', $id_kategori);
		$this->db->where('YEAR(`tgl_penghapusan`)', $tgl_penghapusan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function updateAset($id_aset, $data)
	{
		$this->db->where(array('id_aset' => $id_aset));
		$res = $this->db->update('asets', $data);
		return $res;
	}

	public function deleteBarang($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("asets");
		return $res;
	}

	public function totalAset()
	{
		$query = $this->db->get('asets');
		return $query->num_rows();
	}

	public function totalAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function totalAsetHapuskan()
	{
		$this->db->select('*');
		$this->db->from('penghapusan');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getNomorAset($tahun)
	{
		$this->db->like('kode_aset', $tahun, 'after');
		$this->db->order_by('kode_aset', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get('asets');

		if ($query->num_rows() > 0) {

			$data = $query->row();
			$kode = substr($data->kode_aset, -3);
			$kode = intval($kode) + 1;
		} else {

			$kode = 1;
		}

		return sprintf("%03s", $kode);
	}

	public function getAsetWujudByUser($idUser)
{
    $user = $this->db
                ->where('id_user', $idUser)
                ->get('users')
                ->row();

    $this->db->select('a.*, b.nama_barang, c.nama_lokasi');
    $this->db->from('asets a');
    $this->db->join('barang b', 'b.id_barang = a.id_barang');
    $this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');

    if (!empty($user->user_kategori)) {
        $this->db->where('b.id_kategori', $user->user_kategori);
    }

    $this->db->where('a.volume >', 0);

    return $this->db->get()->result_array();
}
}

/* End of file ModelAset.php */
/* Location: ./application/models/ModelAset.php */