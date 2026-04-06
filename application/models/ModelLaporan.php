<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelLaporan extends CI_Model
{

	public function getAsetWujud($id_lokasi = null, $jenis_bantuan = null)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');

		$this->db->where('a.volume >', 0);

		if (!empty($id_lokasi)) {
			$this->db->where('a.id_lokasi', $id_lokasi);
		}

		if (!empty($jenis_bantuan)) {
			$this->db->where('a.jenis_bantuan', $jenis_bantuan);
		}

		return $this->db->get()->result_array();
	}

	public function getAsetWujudExcel($id_lokasi, $jenis_bantuan)
	{
		$this->db->select('a.*, b.nama_barang, l.nama_lokasi');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset l', 'l.id_lokasi = a.id_lokasi');

		$this->db->where('a.volume >', 0);

		if (!empty($id_lokasi)) {
			$this->db->where('a.id_lokasi', $id_lokasi);
		}

		if (!empty($jenis_bantuan)) {
			$this->db->where('a.jenis_bantuan', $jenis_bantuan);
		}

		return $this->db->get()->result();
	}

	public function getAsetDihapuskan($id_lokasi, $tahun_perolehan)
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->where('tahun_perolehan', $tahun_perolehan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAsetDihapuskanExcel($id_lokasi, $tahun_perolehan)
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->where('tahun_perolehan', $tahun_perolehan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAsetQr($id_lokasi, $tahun_perolehan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->where('tahun_perolehan', $tahun_perolehan);
		$this->db->where('qr_code !=', NULL);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getLokasi()
	{
		$query = $this->db->get('lokasi_aset');
		return $query->result_array();
	}

	public function getLokasiId($id_lokasi)
	{
		$this->db->select('*');
		$this->db->from('lokasi_aset');
		$this->db->where('id_lokasi', $id_lokasi);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getPengadaan($id_lokasi, $tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('pengadaan');
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$this->db->where('status', '1');
		$res = $this->db->get();
		return $res->result_array();
	}

	public function getPengadaanExcel($id_lokasi, $tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('pengadaan');
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$res = $this->db->get();
		return $res->result();
	}

	public function getAsetRangeTahun($tahun_awal = null, $tahun_akhir = null, $jenis_bantuan = null)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->where('volume >', 0);

		if (!empty($tahun_awal)) {
			$this->db->where('tahun_perolehan >=', $tahun_awal);
		}
		if (!empty($tahun_akhir)) {
			$this->db->where('tahun_perolehan <=', $tahun_akhir);
		}
		if (!empty($jenis_bantuan)) {
			$this->db->where('a.jenis_bantuan', $jenis_bantuan);
		}

		return $this->db->get()->result_array();
	}

	public function getAsetLabelPrint($jenis_bantuan = null)
	{
		$this->db->select('a.*, b.nama_barang, b.merek, b.tahun_perolehan');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->where('a.volume >', 0);

		if (!empty($jenis_bantuan)) {
			$this->db->where('a.jenis_bantuan', $jenis_bantuan);
		}

		return $this->db->get()->result_array();
	}

	public function getLokasiById($id_lokasi)
	{
		return $this->db
			->get_where('lokasi_aset', ['id_lokasi' => $id_lokasi])
			->row();
	}
}

/* End of file ModelLaporan.php */
/* Location: ./application/models/ModelLaporan.php */