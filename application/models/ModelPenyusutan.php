<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPenyusutan extends CI_Model
{

	public function getAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getFilterAsetWujud($id_kategori = null, $tahun_perolehan = null)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');

		// Filter berdasarkan kategori
		if (!empty($id_kategori)) {
			$this->db->where('b.id_kategori', $id_kategori);
		}

		// Filter berdasarkan tahun perolehan
		if (!empty($tahun_perolehan)) {
			$this->db->where('b.tahun_perolehan', $tahun_perolehan);
		}

		// Hanya tampilkan aset dengan volume > 0
		$this->db->where('a.volume >', 0);

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
		return $query->row_array();
	}

	public function getDetailAsetWujud1($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function updateAset($id_aset, $data)
	{
		$this->db->where(array('id_aset' => $id_aset));
		$res = $this->db->update('asets', $data);
		return $res;
	}

	/**
	 * Mengambil data aset yang sudah melewati umur ekonomis
	 */
	public function getAsetLewatUmur()
	{

		$this->db->select('
        a.id_aset,
        a.kode_aset,
        a.harga,
        a.umur_ekonomis,
        b.tahun_perolehan,
        a.volume,
        b.nama_barang,
        c.nama_lokasi,
        d.nama_kategori
    ');

		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');

		$this->db->where('a.volume >', 0);
		$this->db->where('a.umur_ekonomis IS NOT NULL', null, false);

		/*
     * Rumus sama dengan yang digunakan pada view:
     *
     * usia = tahun sekarang - (tahun perolehan - 1)
     *
     * Contoh:
     * Tahun perolehan = 2020
     * Tahun sekarang  = 2026
     *
     * usia = 2026 - (2020 - 1)
     * usia = 7 tahun
     */
		$this->db->where(
			'(YEAR(CURDATE()) - (b.tahun_perolehan - 1)) > a.umur_ekonomis',
			null,
			false
		);

		$query = $this->db->get();

		return $query->result_array();
	}


	/**
	 * Mengecek apakah notifikasi tertentu sudah pernah berhasil dikirim
	 * pada tahun berjalan.
	 */
	public function sudahNotifikasi($id_aset, $tahun, $jenis)
	{
		$this->db->where('id_aset', $id_aset);
		$this->db->where('tahun_notifikasi', $tahun);
		$this->db->where('jenis_notifikasi', $jenis);
		$this->db->where('status', 'terkirim');

		return $this->db->count_all_results('notifikasi_aset') > 0;
	}

	public function getAsetBelumNotifikasi($tahun, $jenis)
	{
		$this->db->select('
		a.id_aset,
		a.kode_aset,
		a.harga,
		a.umur_ekonomis,
		b.tahun_perolehan,
		a.volume,
		b.nama_barang,
		c.nama_lokasi,
		d.nama_kategori
	');

		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');

		// Hubungkan dengan log notifikasi
		$this->db->join(
			'notifikasi_aset n',
			'n.id_aset = a.id_aset
		AND n.tahun_notifikasi = ' . (int) $tahun . '
		AND n.jenis_notifikasi = ' . $this->db->escape($jenis),
			'left',
			false
		);

		// Hanya aset yang masih aktif
		$this->db->where('a.volume >', 0);

		// Umur ekonomis harus tersedia
		$this->db->where('a.umur_ekonomis IS NOT NULL', null, false);

		// Rumus harus sama dengan view
		$this->db->where(
			'(YEAR(CURDATE()) - (b.tahun_perolehan - 1)) > a.umur_ekonomis',
			null,
			false
		);

		// Belum pernah berhasil dikirim
		$this->db->where(
			'(n.id_notifikasi IS NULL OR n.status != "terkirim")',
			null,
			false
		);

		$query = $this->db->get();

		return $query->result_array();
	}


	/**
	 * Menyimpan log notifikasi.
	 */
	public function simpanNotifikasi($data)
	{
		$this->db->where('id_aset', $data['id_aset']);
		$this->db->where('tahun_notifikasi', $data['tahun_notifikasi']);
		$this->db->where('jenis_notifikasi', $data['jenis_notifikasi']);

		$existing = $this->db
			->get('notifikasi_aset')
			->row();

		if ($existing) {

			$this->db->where(
				'id_notifikasi',
				$existing->id_notifikasi
			);

			return $this->db->update(
				'notifikasi_aset',
				$data
			);
		}

		return $this->db->insert(
			'notifikasi_aset',
			$data
		);
	}
}

/* End of file ModelPenyusutan.php */
/* Location: ./application/models/ModelPenyusutan.php */