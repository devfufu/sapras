<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengadaan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged") <> 1) {
			redirect(site_url('login'));
		}

		//load model
		$this->load->model('ModelPengadaan', 'mp');
		$this->load->model('ModelLokasi', 'ml');
		$this->load->model('ModelMonitoring', 'mm');
	}

	public function index()
	{
		$data = array(
			'title' => 'Data Kriteria',
			'active_menu_kp' => 'menu-open',
			'active_menu_kpn' => 'active',
			'active_menu_dk' => 'active',
			'spek' => $this->mp->getSpesifikasi(),
			'klts' => $this->mp->getKualitas()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('pengadaan/v_kriteria', $data);
		$this->load->view('layouts/footer');
	}

	public function printPengadaan($id)
	{
		$data['pengadaan'] = $this->mp->getDetailPengadaan($id);

		if (!$data['pengadaan']) {
			show_404();
		}

		$this->load->view('pengadaan/print_pengadaan', $data);
	}

	public function printMultiple()
	{
		$id_pengadaan = $this->input->post('id_pengadaan');

		if (empty($id_pengadaan)) {
			echo "Tidak ada data yang dipilih.";
			return;
		}

		$data['pengadaan'] = $this->mp->getPengadaanByIds($id_pengadaan);

		$this->load->view('pengadaan/print_pengadaan_multiple', $data);
	}

	public function ubahSpesifikasi()
	{
		$id_spesifikasi = $this->input->post('id_spesifikasi');
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
			'nilai' => $this->input->post('nilai')
		);
		unset($data['id_spesifikasi']);
		$result = $this->mp->updateSpesifikasi($id_spesifikasi, $data);

		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('kriteria');
		} else {
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('kriteria');
		}
	}

	public function ubahKualitas()
	{
		$id_kualitas = $this->input->post('id_kualitas');
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
			'nilai' => $this->input->post('nilai')
		);
		unset($data['id_kualitas']);
		$result = $this->mp->updateKualitas($id_kualitas, $data);

		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('kriteria');
		} else {
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('kriteria');
		}
	}

	public function aset()
	{
		$data = array(
			'title' => 'Data Aset',
			'active_menu_kp' => 'menu-open',
			'active_menu_kpn' => 'active',
			'active_menu_da' => 'active',
			'aset' => $this->mp->getAset(),
			'spek' => $this->mp->getSpesifikasi(),
			'klts' => $this->mp->getKualitas(),
			'nilai' => $this->mp->getPenilaian()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('pengadaan/v_aset', $data);
		$this->load->view('layouts/footer');
	}

	public function simpanAset()
	{
		$data = $this->input->post(null, true);
		$result = $this->mp->storeAset($data);
		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('data_aset');
		} else {
			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('data_aset');
		}
	}

	public function ubahAset()
	{
		$id_aset = $this->input->post('id_aset');
		$data = $this->input->post(null, true);
		unset($data['id_aset']);
		$result = $this->mp->updateAset($id_aset, $data);

		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('data_aset');
		} else {
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('data_aset');
		}
	}

	public function hapusAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$where = array('id_aset' => $id_aset);
		$res = $this->mp->deleteAset($where);
		if ($res >= 1) {
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('data_aset');
		} else {
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('data_aset');
		}
	}

	public function simpanPenilaian()
	{
		$data = $this->input->post(null, true);
		$result = $this->mp->storePenilaian($data);
		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('data_aset');
		} else {
			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('data_aset');
		}
	}

	public function ubahPenilaian()
	{
		$id_nilai = $this->input->post('id_nilai');
		$data = $this->input->post(null, true);
		unset($data['id_nilai']);
		$result = $this->mp->updatePenilaian($id_nilai, $data);
		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('data_aset');
		} else {
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('data_aset');
		}
	}

	public function hapusPenilaian($id_nilai)
	{
		$id_nilai = $this->uri->segment(3);
		$where = array('id_nilai' => $id_nilai);
		$res = $this->mp->deletePenilaian($where);
		if ($res >= 1) {
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('data_aset');
		} else {
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('data_aset');
		}
	}

	public function spk()
	{
		$data = array(
			'title' => 'Data Aset',
			'active_menu_kp' => 'menu-open',
			'active_menu_kpn' => 'active',
			'active_menu_spk' => 'active',
			'nilai' => $this->mp->getPenilaian(),
			'maxspek' => $this->mp->getMaxSpesifikasi(),
			'maxkual' => $this->mp->getMaxKualitas(),
			'minharga' => $this->mp->getMinHarga()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('pengadaan/v_spk', $data);
		$this->load->view('layouts/footer');
	}

	//Pengadaan
	public function pengajuan()
	{
		$data = array(
			'title' => 'Pengajuan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pnd' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'nilai' => $this->mp->getPenilaian(),
			'maxspek' => $this->mp->getMaxSpesifikasi(),
			'maxkual' => $this->mp->getMaxKualitas(),
			'minharga' => $this->mp->getMinHarga(),
			'mt' => $this->mm->getMonitoring()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('pengadaan/c_pengadaan', $data);
		$this->load->view('layouts/footer');
	}

	public function pengadaan()
	{
		$id_user = $this->session->userdata('id_user');
		$data = array(
			'title' => 'Pengadaan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pgd' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'item' => $this->mp->getPengadaanAset(),
			'item_user' => $this->mp->getPengadaanAsetUser($id_user)
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('pengadaan/v_pengadaan', $data);
		$this->load->view('layouts/footer');
	}

	public function simpanPengadaan()
	{
		$id_user = $this->session->userdata('id_user');

		$data = array(
			'id_lokasi'        => $this->input->post('id_lokasi'),
			'id_user'          => $id_user,
			'nama_aset'        => $this->input->post('nama_aset'),
			'merek'             => $this->input->post('merek'),
			'tujuan_pengadaan' => $this->input->post('tujuan_pengadaan'),
			'sifat_pengadaan'  => $this->input->post('sifat_pengadaan'),
			'volume'            => $this->input->post('volume'),
			'satuan'            => $this->input->post('satuan'),
			'harga_satuan'      => $this->input->post('harga_satuan'),
			'tahun_pengadaan'   => $this->input->post('tahun_pengadaan'),
			'status'            => '0',
			'created_at'        => date('Y-m-d H:i:s')
		);

		$result = $this->mp->storePengadaan($data);

		if ($result >= 1) {

			$nama_user = $this->mp->getNamaUser($id_user);

			$email_tujuan = 'smkfadilahsapras@gmail.com';
			$nomor_wa = '6285777523577';

			$this->kirimEmailPengadaan($data, $email_tujuan, $nama_user);
			$this->kirimWhatsAppPengadaan($data, $nomor_wa, $nama_user);

			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('pengajuan');
		} else {

			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('pengajuan');
		}
	}

	private function kirimEmailPengadaan($data, $email_tujuan, $nama_user)
	{
		$this->load->library('email');

		$this->email->from(
			'fuadramadon12@gmail.com',
			'Sistem Sarpras'
		);

		$this->email->to($email_tujuan);

		$this->email->subject('Pengadaan Baru - Sistem Sarpras');

		$message = "
        <h3>🔔 PENGADAAN BARU</h3>

        <p>Ada pengajuan pengadaan baru yang masuk ke sistem.</p>

        <table border='1' cellpadding='8' cellspacing='0'>
            <tr>
                <td><strong>Nama User</strong></td>
                <td>{$nama_user}</td>
            </tr>
            <tr>
                <td><strong>Nama Aset</strong></td>
                <td>{$data['nama_aset']}</td>
            </tr>
            <tr>
                <td><strong>Merek</strong></td>
                <td>{$data['merek']}</td>
            </tr>
            <tr>
                <td><strong>Volume</strong></td>
                <td>{$data['volume']} {$data['satuan']}</td>
            </tr>
            <tr>
                <td><strong>Tujuan</strong></td>
                <td>{$data['tujuan_pengadaan']}</td>
            </tr>
            <tr>
                <td><strong>Sifat</strong></td>
                <td>{$data['sifat_pengadaan']}</td>
            </tr>
            <tr>
                <td><strong>Tahun</strong></td>
                <td>{$data['tahun_pengadaan']}</td>
            </tr>
        </table>

        <br>

        <p>
            Silakan login ke sistem untuk melihat dan memproses pengadaan tersebut.
        </p>
    ";

		$this->email->message($message);

		if ($this->email->send()) {

			log_message(
				'info',
				'EMAIL BERHASIL DIKIRIM KE: ' . $email_tujuan
			);

			return true;
		} else {

			log_message(
				'error',
				'EMAIL GAGAL: ' . $this->email->print_debugger()
			);

			return false;
		}
	}

	private function kirimWhatsAppPengadaan($data, $nomor_wa, $nama_user)
	{
		// Token API Fonnte
		$token_fonnte = 'Re2jpcJhxm3DudvjV8zd';

		// Isi pesan WhatsApp
		$pesan = "🔔 *PENGADAAN BARU*\n\n";

		$pesan .= "Ada pengajuan pengadaan baru yang masuk ke sistem.\n\n";

		$pesan .= "📦 *Detail Pengadaan*\n";
		$pesan .= "━━━━━━━━━━━━━━━━━━\n";

		$pesan .= "Nama User : " . $nama_user . "\n";
		$pesan .= "Nama Aset : " . $data['nama_aset'] . "\n";
		$pesan .= "Merek : " . $data['merek'] . "\n";
		$pesan .= "Volume : " . $data['volume'] . " " . $data['satuan'] . "\n";
		$pesan .= "Tujuan : " . $data['tujuan_pengadaan'] . "\n";
		$pesan .= "Sifat : " . $data['sifat_pengadaan'] . "\n";
		$pesan .= "Tahun : " . $data['tahun_pengadaan'] . "\n";

		$pesan .= "━━━━━━━━━━━━━━━━━━\n\n";

		$pesan .= "Silakan login ke sistem untuk melihat dan memproses pengadaan tersebut.";
		$pesan .= "🌐 *Akses Sistem:*\n";
		$pesan .= "https://aset.smkfadilah.sch.id/";

		// =====================================
		// CURL FONNTE
		// =====================================

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.fonnte.com/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',

			CURLOPT_POSTFIELDS => array(
				'target' => $nomor_wa,
				'message' => $pesan,
				'countryCode' => '62'
			),

			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $token_fonnte
			),
		));

		$response = curl_exec($curl);

		// Cek error CURL
		if (curl_errno($curl)) {

			log_message(
				'error',
				'Fonnte CURL Error: ' . curl_error($curl)
			);

			curl_close($curl);

			return false;
		}

		curl_close($curl);

		// Simpan response Fonnte ke log CI
		log_message(
			'info',
			'Fonnte Response: ' . $response
		);

		return $response;
	}

	public function detailPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$data = array(
			'title' => 'Pengadaan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pgd' => 'active',
			'item' => $this->mp->getDetailPengadaanAset($id_pengadaan)
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('pengadaan/d_pengadaan', $data);
		$this->load->view('layouts/footer');
	}

	public function setujuiPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$data['status'] = '1';
		unset($data['id_pengadaan']);
		$result = $this->mp->updatePengadaan($id_pengadaan, $data);
		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Disetujui');
			redirect('pengadaan');
		} else {
			$this->session->set_flashdata('gagal', 'Disetujui');
			redirect('pengadaan');
		}
	}

	public function tolakPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$data['status'] = '2';
		unset($data['id_pengadaan']);
		$result = $this->mp->updatePengadaan($id_pengadaan, $data);
		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Disetujui');
			redirect('pengadaan');
		} else {
			$this->session->set_flashdata('gagal', 'Disetujui');
			redirect('pengadaan');
		}
	}

	public function hapusPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$where = array('id_pengadaan' => $id_pengadaan);
		$res = $this->mp->deletePengadaan($where);
		if ($res >= 1) {
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('pengadaan');
		} else {
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('pengadaan');
		}
	}

	public function filterPengadaan()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_pengadaan = $this->input->post('tahun_pengadaan');

		$data = array(
			'title' => 'Pengadaan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pgd' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'item' => $this->mp->getFilterPengadaanAset($id_lokasi, $tahun_pengadaan)
		);

		if (count($data['item']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('pengadaan/v_pengadaan', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Data pengadaan tidak ditemukan');
			redirect('pengadaan');
		}
	}

	public function testpk()
	{
		$spk = $this->mp->getPenilaian();
		$maxspek = $this->mp->getMaxSpesifikasi();
		$maxkual = $this->mp->getMaxKualitas();
		$minharga = $this->mp->getMinHarga();

		$arr = array();
		$no = 1;
		foreach ($spk as $row) {
			$spek = ($row['nilai_spek'] / $maxspek['maks_spek']);
			$kual = ($row['nilai_kualitas'] / $maxkual['maks_kualitas']);
			$hrg = ($row['harga'] / $minharga['min_harga']);
			$nilai = round(($spek * 0.3) + ($kual * 0.3) + ($hrg * 0.4), 3);

			$arr[] = $nilai . ' yaitu V' . $no++ . ' dengan nama aset ' . $row['nama_aset'];
		}

		echo "<p>Dari hasil perhitungan ranking diatas, maka pemilihan aset terbaik untuk pengadaan dengan nilai tertinggi " . $output;
	}
}

/* End of file Pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */