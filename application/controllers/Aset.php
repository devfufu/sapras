<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged") <> 1) {
			redirect(site_url('login'));
		}

		//load model
		$this->load->model('ModelAset', 'ma');
		$this->load->model('ModelBarang', 'mb');
		$this->load->model('ModelLokasi', 'ml');
		$this->load->model('ModelKategori', 'mk');

		//load library
		$this->load->library('ciqrcode');
		$this->load->library('uuid');
	}

	public function index()
	{
		$idUser = $this->session->userdata('id_user');
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getAsetWujudByUser($idUser),
			'kategori' => $this->mk->getKategoriBarang()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('aset/v_wujud', $data);
		$this->load->view('layouts/footer');
	}

	public function printAset($id)
	{
		$data['aset'] = $this->ma->getDetailAsetPrint($id);

		if (!$data['aset']) {
			show_404();
		}

		$this->load->view('aset/print_aset', $data);
	}

	public function printMultiple()
	{
		$id_aset = $this->input->post('id_aset');

		if (empty($id_aset)) {
			echo "Tidak ada data yang dipilih.";
			return;
		}

		$data['aset'] = $this->ma->getAsetByIds($id_aset);

		if (empty($data['aset'])) {
			echo "Data aset tidak ditemukan.";
			return;
		}

		$this->load->view('aset/print_aset_multiple', $data);
	}

	public function tambahAset()
	{
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'brg' => $this->mb->getDataBarang(),
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('aset/c_wujud', $data);
		$this->load->view('layouts/footer');
	}

	public function tambahAsetBaru()
	{
		$data = array(
			'title' => 'Aset Berwujud Baru',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'brg' => $this->mb->getDataBarang(),
			'lokasi' => $this->ml->getLokasi(),
			'kategori' => $this->mb->getKategori()
		);

		$this->load->view('layouts/header', $data);
		$this->load->view('aset/c_wujudBaru', $data);
		$this->load->view('layouts/footer');
	}

	public function generateKodeAset()
	{
		$dana = $this->input->post('dana');
		$kategori = $this->input->post('kategori');

		$tahun = date('Y');
		$bulan = date('m');

		$nomor = $this->ma->getNomorAset($tahun);

		$kode = $tahun . '-' . $bulan . '/' . $dana . '/' . $kategori . '/' . $nomor;

		echo json_encode($kode);
	}

	public function simpanAsetBaru()
	{
		$this->form_validation->set_rules(
			'kode_aset',
			'Kode Aset',
			'required|trim|is_unique[asets.kode_aset]',
			array(
				'required' => "<p>Kode Aset tidak boleh kosong</p>",
				'is_unique' => "<p>Kode Aset sudah digunakan</p>",
			)
		);

		if ($this->form_validation->run() != FALSE) {

			// 🔥 generate ID aset (dipakai semua kondisi)
			$id = $this->uuid->v4();
			$id_aset = str_replace('-', '', $id);

			$generate = $this->input->post('generate');
			$kode_aset = $this->input->post('kode_aset');

			// 🔥 hitung
			$volume = $this->input->post('volume');
			$harga = $this->input->post('harga');
			$total = ($volume * $harga);

			$foto = null;

			if (!empty($_FILES['foto_aset']['name'])) {

				$ext = strtolower(pathinfo($_FILES['foto_aset']['name'], PATHINFO_EXTENSION));

				$config['upload_path'] = './src/img/aset/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 2048;
				$config['file_name'] = 'aset_' . $id_aset . '.' . $ext;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto_aset')) {
					$upload_data = $this->upload->data();
					$foto = $upload_data['file_name'];
				} else {
					$this->session->set_flashdata('gagal', $this->upload->display_errors());
					redirect('aset_wujud/tambah');
					return;
				}
			}

			$image_name = null;

			if ($generate) {

				$config['cacheable'] = true;
				$config['cachedir'] = './src/';
				$config['errorlog'] = './src/';
				$config['imagedir'] = './src/img/qrcode/';
				$config['quality'] = true;
				$config['size'] = '1024';
				$config['black'] = array(224, 255, 255);
				$config['white'] = array(70, 130, 180);

				$this->ciqrcode->initialize($config);

				$image_name = 'qr_' . $id_aset . '.png';

				$url = 'http://aset.smkfadilah.sch.id/ai/ai_aset/detail/' . $id_aset;

				$params['data'] = $url;
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = FCPATH . $config['imagedir'] . $image_name;

				$this->ciqrcode->generate($params);
			}

			$data = array(
				'id_aset' => $id_aset,
				'kode_aset' => $kode_aset,
				'id_barang' => $this->input->post('id_barang'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'volume' => $volume,
				'satuan' => $this->input->post('satuan'),
				'harga' => $harga,
				'total_harga' => $total,
				'status_aset' => 'Aktif',
				'kondisi' => $this->input->post('kondisi'),
				'umur_ekonomis' => $this->input->post('umur_ekonomis'),
				'jenis_bantuan' => $this->input->post('jenis_bantuan'),
				'foto_aset' => $foto,
				'qr_code' => $image_name
			);

			$result = $this->ma->storeAset($data);

			if ($result >= 1) {
				$this->session->set_flashdata('sukses', 'Disimpan');
				redirect('aset_wujud');
			} else {
				$this->session->set_flashdata('gagal', 'Disimpan');
				redirect('aset_wujud/tambah');
			}
		} else {

			$data = array(
				'title' => 'Aset Berwujud',
				'active_menu_open' => 'menu-open',
				'active_menu_aset' => 'active',
				'active_menu_wujud' => 'active',
				'aset' => $this->ma->getAsetWujud(),
				'brg' => $this->mb->getDataBarang(),
				'lokasi' => $this->ml->getLokasi()
			);

			$this->load->view('layouts/header', $data);
			$this->load->view('aset/c_wujud', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function simpanAset()
	{
		$this->form_validation->set_rules(
			'kode_aset',
			'Kode Aset',
			'required|trim|is_unique[asets.kode_aset]',
			array(
				'required' => "<p>Kode Aset tidak boleh kosong</p>",
				'is_unique' => "<p>Kode Aset sudah digunakan</p>",
			)
		);

		if ($this->form_validation->run() != FALSE) {

			// 🔥 generate ID aset (dipakai semua kondisi)
			$id = $this->uuid->v4();
			$id_aset = str_replace('-', '', $id);

			$generate = $this->input->post('generate');
			$kode_aset = $this->input->post('kode_aset');

			// 🔥 hitung
			$volume = $this->input->post('volume');
			$harga = $this->input->post('harga');
			$total = ($volume * $harga);

			$foto = null;

			if (!empty($_FILES['foto_aset']['name'])) {

				$ext = strtolower(pathinfo($_FILES['foto_aset']['name'], PATHINFO_EXTENSION));

				$config['upload_path'] = './src/img/aset/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 2048;
				$config['file_name'] = 'aset_' . $id_aset . '.' . $ext;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto_aset')) {
					$upload_data = $this->upload->data();
					$foto = $upload_data['file_name'];
				} else {
					$this->session->set_flashdata('gagal', $this->upload->display_errors());
					redirect('aset_wujud/tambah');
					return;
				}
			}

			$image_name = null;

			if ($generate) {

				$config['cacheable'] = true;
				$config['cachedir'] = './src/';
				$config['errorlog'] = './src/';
				$config['imagedir'] = './src/img/qrcode/';
				$config['quality'] = true;
				$config['size'] = '1024';
				$config['black'] = array(224, 255, 255);
				$config['white'] = array(70, 130, 180);

				$this->ciqrcode->initialize($config);

				$image_name = 'qr_' . $id_aset . '.png';

				$url = 'http://aset.smkfadilah.sch.id/ai/ai_aset/detail/' . $id_aset;

				$params['data'] = $url;
				$params['level'] = 'H';
				$params['size'] = 10;
				$params['savename'] = FCPATH . $config['imagedir'] . $image_name;

				$this->ciqrcode->generate($params);
			}

			$data = array(
				'id_aset' => $id_aset,
				'kode_aset' => $kode_aset,
				'id_barang' => $this->input->post('id_barang'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'volume' => $volume,
				'satuan' => $this->input->post('satuan'),
				'harga' => $harga,
				'total_harga' => $total,
				'status_aset' => 'Aktif',
				'kondisi' => $this->input->post('kondisi'),
				'umur_ekonomis' => $this->input->post('umur_ekonomis'),
				'jenis_bantuan' => $this->input->post('jenis_bantuan'),
				'foto_aset' => $foto,
				'qr_code' => $image_name
			);

			$result = $this->ma->storeAset($data);

			if ($result >= 1) {
				$this->session->set_flashdata('sukses', 'Disimpan');
				redirect('aset_wujud');
			} else {
				$this->session->set_flashdata('gagal', 'Disimpan');
				redirect('aset_wujud/tambah');
			}
		} else {

			$data = array(
				'title' => 'Aset Berwujud',
				'active_menu_open' => 'menu-open',
				'active_menu_aset' => 'active',
				'active_menu_wujud' => 'active',
				'aset' => $this->ma->getAsetWujud(),
				'brg' => $this->mb->getDataBarang(),
				'lokasi' => $this->ml->getLokasi()
			);

			$this->load->view('layouts/header', $data);
			$this->load->view('aset/c_wujud', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function editAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);

		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getDetailAsetWujud($id_aset),
			'brg' => $this->mb->getDataBarang(),
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('aset/u_wujud', $data);
		$this->load->view('layouts/footer');
	}

	public function ubahAset()
	{
		$this->form_validation->set_rules(
			'kode_aset',
			'Kode Aset',
			'required|trim',
			array(
				'required' => "<p>Kode Aset tidak boleh kosong</p>"
			)
		);

		$id_aset = $this->input->post('id_aset');

		if ($this->form_validation->run() != FALSE) {
			$generate = $this->input->post('generate');
			if ($generate) {

				$kode_aset = $this->input->post('kode_aset');

				$config['cacheable'] = true; //boolean, the default is true
				$config['cachedir'] = './src/'; //string, the default is application/cache/
				$config['errorlog'] = './src/'; //string, the default is application/logs/
				$config['imagedir'] = './src/img/qrcode/'; //direktori penyimpanan qr code
				$config['quality'] = true; //boolean, the default is true
				$config['size'] = '1024'; //interger, the default is 1024
				$config['black'] = array(224, 255, 255); // array, default is array(255,255,255)
				$config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);

				$id = $this->uuid->v4();
				$image = str_replace('-', '', $id);

				$image_name = 'qr_' . $id_aset . '.png'; //buat name dari qr code sesuai dengan nim

				$url = 'http://aset.smkfadilah.sch.id/ai/ai_aset/detail/' . $id_aset;

				$params['data'] = $url; //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
				$params['size'] = 10;
				$params['savename'] = FCPATH . $config['imagedir'] . $image_name;
				$this->ciqrcode->generate($params);

				$volume = $this->input->post('volume');
				$harga = $this->input->post('harga');
				$total = ($volume * $harga);

				$this->db->where('id_aset', $id_aset);
				$old = $this->db->get('asets')->row();
				$foto_lama = $old->foto_aset ?? null;

				$foto = $foto_lama;

				if (!empty($_FILES['foto_aset']['name'])) {

					$ext = strtolower(pathinfo($_FILES['foto_aset']['name'], PATHINFO_EXTENSION));

					$config['upload_path'] = './src/img/aset/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = 2048;
					$config['file_name'] = 'aset_' . $id_aset . '.' . $ext;
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('foto_aset')) {
						$upload_data = $this->upload->data();
						$foto = $upload_data['file_name'];
					} else {
						$this->session->set_flashdata('gagal', $this->upload->display_errors());
						redirect('aset_wujud/edit/' . $id_aset);
						return;
					}
				}

				$data = array(
					'kode_aset' => $kode_aset,
					'id_barang' => $this->input->post('id_barang'),
					'id_lokasi' => $this->input->post('id_lokasi'),
					'volume' => $volume,
					'satuan' => $this->input->post('satuan'),
					'harga' => $harga,
					'total_harga' => $total,
					'status_aset' => 'Aktif',
					'kondisi' => $this->input->post('kondisi'),
					'umur_ekonomis' => $this->input->post('umur_ekonomis'),
					'jenis_bantuan' => $this->input->post('jenis_bantuan'),
					'foto_aset' => $foto,
					'qr_code' => $image_name
				);

				unset($data['id_aset']);

				$result = $this->ma->updateAset($id_aset, $data);

				if ($result >= 1) {
					$this->session->set_flashdata('sukses', 'Diubah');
					redirect('aset_wujud');
				} else {
					$this->session->set_flashdata('gagal', 'Diubah');
					redirect('aset_wujud/edit/' . $id_aset);
				}
			} else {

				$this->db->where('id_aset', $id_aset);
				$get_image_file = $this->db->get('asets')->row();
				@unlink('src/img/qrcode/' . $get_image_file->qr_code);

				$volume = $this->input->post('volume');
				$harga = $this->input->post('harga');
				$total = ($volume * $harga);

				$this->db->where('id_aset', $id_aset);
				$old = $this->db->get('asets')->row();
				$foto_lama = $old->foto_aset ?? null;
				$foto = $foto_lama;

				if (!empty($_FILES['foto_aset']['name'])) {

					$ext = strtolower(pathinfo($_FILES['foto_aset']['name'], PATHINFO_EXTENSION));

					$config['upload_path'] = './src/img/aset/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = 2048;
					$config['file_name'] = 'aset_' . $id_aset . '.' . $ext;
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('foto_aset')) {
						$upload_data = $this->upload->data();
						$foto = $upload_data['file_name'];
					} else {
						$this->session->set_flashdata('gagal', $this->upload->display_errors());
						redirect('aset_wujud/edit/' . $id_aset);
						return;
					}
				}

				$data = array(
					'kode_aset' => $this->input->post('kode_aset'),
					'id_barang' => $this->input->post('id_barang'),
					'id_lokasi' => $this->input->post('id_lokasi'),
					'volume' => $volume,
					'satuan' => $this->input->post('satuan'),
					'harga' => $harga,
					'total_harga' => $total,
					'status_aset' => 'Aktif',
					'kondisi' => $this->input->post('kondisi'),
					'umur_ekonomis' => $this->input->post('umur_ekonomis'),
					'jenis_bantuan' => $this->input->post('jenis_bantuan'),
					'foto_aset' => $foto,
					'qr_code' => NULL
				);

				unset($data['id_aset']);

				$result = $this->ma->updateAset($id_aset, $data);

				if ($result >= 1) {
					$this->session->set_flashdata('sukses', 'Disimpan');
					redirect('aset_wujud');
				} else {
					$this->session->set_flashdata('gagal', 'Disimpan');
					redirect('aset_wujud/edit/' . $id_aset);
				}
			}
		} else {
			$data = array(
				'title' => 'Aset Berwujud',
				'active_menu_open' => 'menu-open',
				'active_menu_aset' => 'active',
				'active_menu_wujud' => 'active',
				'aset' => $this->ma->getDetailAsetWujud($id_aset),
				'brg' => $this->mb->getDataBarang(),
				'lokasi' => $this->ml->getLokasi()
			);
			$this->load->view('layouts/header', $data);
			$this->load->view('aset/u_wujud', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function detailAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getDetailAsetWujud($id_aset)
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('aset/d_wujud', $data);
		$this->load->view('layouts/footer');
	}

	public function hapusAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);

		// ambil data dulu
		$this->db->where('id_aset', $id_aset);
		$data = $this->db->get('asets')->row();
		if (!$data) {
			show_404();
		}

		/* Hapus QR Code */
		if (!empty($data->qr_code)) {
			$path_qr = './src/img/qrcode/' . $data->qr_code;
			if (file_exists($path_qr)) {
				unlink($path_qr);
			}
		}

		/* Hapus Foto Aset */
		if (!empty($data->foto_aset)) {
			$path_foto = './src/img/aset/' . $data->foto_aset;
			if (file_exists($path_foto)) {
				unlink($path_foto);
			}
		}

		/* Hapus Data DB */
		$this->db->where('id_aset', $id_aset);
		$this->db->delete('asets');

		$this->session->set_flashdata('sukses', 'Dihapus');
		redirect('aset_wujud');
	}

	public function filterAset()
	{
		$id_kategori = $this->input->post('id_kategori', true);
		$tahun_perolehan = $this->input->post('tahun_perolehan', true);
		$kondisi = $this->input->post('kondisi', true);
		$jenis_bantuan = $this->input->post('jenis_bantuan', true);

		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getFilterAsetWujud($id_kategori, $tahun_perolehan, $kondisi, $jenis_bantuan),
			'kategori' => $this->mk->getKategoriBarang()
		);

		$this->load->view('layouts/header', $data);
		$this->load->view('aset/v_wujud', $data);
		$this->load->view('layouts/footer');
	}

	public function dihapuskanAset()
	{
		$data = array(
			'title' => 'Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'aset' => $this->ma->getAsetDihapuskan()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('aset/v_dihapuskan', $data);
		$this->load->view('layouts/footer');
	}

	public function detailDihapuskanAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'aset' => $this->ma->getDetailAsetWujud($id_aset)
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('aset/d_dihapuskan', $data);
		$this->load->view('layouts/footer');
	}

	public function filterAsetDihapuskan()
	{
		$id_kategori = $this->input->post('id_kategori');
		$tgl_penghapusan = $this->input->post('tgl_penghapusan');

		$data = array(
			'title' => 'Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'aset' => $this->ma->getFilterAsetDihapuskan($id_kategori, $tgl_penghapusan)
		);
		if (count($data['aset']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('aset/v_dihapuskan', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('aset_dihapuskan');
		}
	}

	public function cariAset()
	{
		$bar = $this->input->get('bar');
		$query = $this->ma->searchAset($bar, 'nama_barang');

		echo json_encode($query);
	}
}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */