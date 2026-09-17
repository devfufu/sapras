<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyusutan extends CI_Controller
{

	// Token API Fonnte
	private $token_fonnte = 'Re2jpcJhxm3DudvjV8zd';

	// Tujuan notifikasi
	private $email_tujuan = 'smkfadilahsapras@gmail.com';
	private $nomor_wa_tujuan = '6285777523577';
	private $cron_token = '$2y$10$hcRd56eU./AMDavKBpF2o.sK3C62PcmWRgGWLEKGBjS';

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged") <> 1) {
			redirect(site_url('login'));
		}

		$this->load->model('ModelPenyusutan', 'mp');
		$this->load->model('ModelKategori', 'mk');
	}

	public function index()
	{
		$data = array(
			'title' => 'Penyusutan',
			'active_menu_pys' => 'active',
			'pys' => $this->mp->getAsetWujud(),
			'kategori' => $this->mk->getKategoriBarang()
		);

		$this->load->view('layouts/header', $data);
		$this->load->view('penyusutan/v_penyusutan', $data);
		$this->load->view('layouts/footer');
	}

	public function detailPenyusutan($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Penyusutan',
			'active_menu_pys' => 'active',
			'd' => $this->mp->getDetailAsetWujud($id_aset),
			'item' => $this->mp->getDetailAsetWujud1($id_aset)
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('penyusutan/d_penyusutan', $data);
		$this->load->view('layouts/footer');
	}

	public function filterPenyusutan()
	{
		$id_kategori = $this->input->post('id_kategori');
		$tahun_perolehan = $this->input->post('tahun_perolehan');

		$data = array(
			'title' => 'Penyusutan',
			'active_menu_pys' => 'active',
			'pys' => $this->mp->getFilterAsetWujud($id_kategori, $tahun_perolehan),
			'kategori' => $this->mk->getKategoriBarang()
		);

		if (count($data['pys']) > 0) {

			$this->load->view('layouts/header', $data);
			$this->load->view('penyusutan/v_penyusutan', $data);
			$this->load->view('layouts/footer');
		} else {

			$this->session->set_flashdata(
				'gagal',
				'Data penyusutan tidak ditemukan.'
			);

			redirect('penyusutan');
		}
	}

	public function print()
	{
		$id_kategori = $this->input->get('id_kategori', true);
		$tahun_perolehan = $this->input->get('tahun_perolehan', true);

		// Jika tidak ada filter
		if (empty($id_kategori) && empty($tahun_perolehan)) {
			$data['pys'] = $this->mp->getAsetWujud();
		} else {
			// Jika ada filter
			$data['pys'] = $this->mp->getFilterAsetWujud(
				$id_kategori,
				$tahun_perolehan
			);
		}

		// Untuk menampilkan informasi filter di laporan
		$data['filter_digunakan'] =
			!empty($id_kategori) || !empty($tahun_perolehan);

		$data['nama_kategori'] = '';

		if (!empty($id_kategori)) {
			$kategori = $this->mk->getKategoriBarang();

			foreach ($kategori as $row) {
				if ($row['id_kategori'] == $id_kategori) {
					$data['nama_kategori'] =
						$row['kode_kategori'] . ' - ' . $row['nama_kategori'];
					break;
				}
			}
		}

		$data['tahun_perolehan'] = $tahun_perolehan;

		$this->load->view('penyusutan/v_print', $data);
	}

	public function prosesNotifikasiOtomatis()
	{
		if ($this->input->get('token') !== $this->cron_token) {
			show_404();
		}

		$aset_lewat = $this->mp->getAsetLewatUmur();

		// Tidak ada aset yang melewati umur ekonomis
		if (empty($aset_lewat)) {
			return;
		}

		$tahun_sekarang = (int) date('Y');

		foreach ($aset_lewat as $row) {

			$id_aset = $row['id_aset'];

			/*
         * ==========================
         * NOTIFIKASI WHATSAPP
         * ==========================
         */

			if (!$this->mp->sudahNotifikasi(
				$id_aset,
				$tahun_sekarang,
				'whatsapp'
			)) {

				$hasil_wa = $this->kirimWhatsAppAset($row);

				$this->mp->simpanNotifikasi(array(
					'id_aset' => $id_aset,
					'tahun_notifikasi' => $tahun_sekarang,
					'jenis_notifikasi' => 'whatsapp',
					'status' => $hasil_wa['status'] ? 'terkirim' : 'gagal',
					'tanggal_kirim' => $hasil_wa['status']
						? date('Y-m-d H:i:s')
						: null,
					'pesan' => $hasil_wa['message'],
					'response' => isset($hasil_wa['response'])
						? $hasil_wa['response']
						: null
				));
			}


			/*
         * ==========================
         * NOTIFIKASI EMAIL
         * ==========================
         */

			if (!$this->mp->sudahNotifikasi(
				$id_aset,
				$tahun_sekarang,
				'email'
			)) {

				$hasil_email = $this->kirimEmailAset($row);

				$this->mp->simpanNotifikasi(array(
					'id_aset' => $id_aset,
					'tahun_notifikasi' => $tahun_sekarang,
					'jenis_notifikasi' => 'email',
					'status' => $hasil_email ? 'terkirim' : 'gagal',
					'tanggal_kirim' => $hasil_email
						? date('Y-m-d H:i:s')
						: null,
					'pesan' => $hasil_email
						? 'Email berhasil dikirim'
						: 'Email gagal dikirim',
					'response' => null
				));
			}
		}
	}

	private function kirimWhatsAppAset($row)
	{
		$usia = (int) date('Y') - ($row['tahun_perolehan'] - 1);

		$pesan  = "⚠️ *PERINGATAN UMUR EKONOMIS ASET*\n\n";

		$pesan .= "Terdapat aset yang telah melewati umur ekonomis.\n\n";

		$pesan .= "📋 *DATA ASET*\n";
		$pesan .= "━━━━━━━━━━━━━━\n";

		$pesan .= "Nama Aset : *" . $row['nama_barang'] . "*\n";

		if (!empty($row['kode_aset'])) {
			$pesan .= "Kode Aset : " . $row['kode_aset'] . "\n";
		}

		$pesan .= "Kategori : " . $row['nama_kategori'] . "\n";
		$pesan .= "Lokasi : " . $row['nama_lokasi'] . "\n";
		$pesan .= "Tahun Perolehan : " . $row['tahun_perolehan'] . "\n";
		$pesan .= "Umur Ekonomis : " . $row['umur_ekonomis'] . " Tahun\n";
		$pesan .= "Usia Pemakaian : " . $usia . " Tahun\n";

		$pesan .= "━━━━━━━━━━━━━━\n\n";

		$pesan .= "⚠️ *STATUS: MASA MANFAAT TELAH TERLEWATI*\n\n";

		$pesan .= "Mohon dilakukan pemeriksaan dan tindak lanjut terhadap aset tersebut.\n\n";

		$pesan .= "🌐 *Sistem Sarpras*\n";
		$pesan .= "https://aset.smkfadilah.sch.id/";

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
				'target' => $this->nomor_wa_tujuan,
				'message' => $pesan,
				'countryCode' => '62'
			),

			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $this->token_fonnte
			),
		));

		$response = curl_exec($curl);

		if (curl_errno($curl)) {

			$error = curl_error($curl);

			curl_close($curl);

			log_message(
				'error',
				'FONNTE ERROR: ' . $error
			);

			return array(
				'status' => false,
				'message' => $error,
				'response' => null
			);
		}

		curl_close($curl);

		log_message(
			'info',
			'FONNTE RESPONSE: ' . $response
		);

		$hasil = json_decode($response, true);

		$berhasil = (
			isset($hasil['status']) &&
			$hasil['status'] == true
		);

		return array(
			'status' => $berhasil,
			'message' => $berhasil
				? 'WhatsApp berhasil dikirim'
				: 'WhatsApp gagal dikirim',
			'response' => $response
		);
	}

	private function kirimEmailAset($row)
	{
		$this->load->library('email');

		$usia = (int) date('Y') - ($row['tahun_perolehan'] - 1);

		$this->email->from(
			'smkfadilahsapras@gmail.com',
			'Sistem Sarpras'
		);

		$this->email->to($this->email_tujuan);

		$this->email->subject(
			'⚠️ Peringatan Aset Melewati Umur Ekonomis - ' .
				$row['nama_barang']
		);

		$message = '
    <html>
    <body>

    <h2 style="color:red;">
        ⚠️ Peringatan Umur Ekonomis Aset
    </h2>

    <p>
        Sistem Sarpras mendeteksi bahwa aset berikut
        telah melewati umur ekonomis:
    </p>

    <table border="1" cellpadding="8" cellspacing="0"
        style="border-collapse:collapse; width:100%;">

        <tr>
            <td><strong>Nama Aset</strong></td>
            <td>' . htmlspecialchars($row['nama_barang']) . '</td>
        </tr>

        <tr>
            <td><strong>Kode Aset</strong></td>
            <td>' . htmlspecialchars($row['kode_aset']) . '</td>
        </tr>

        <tr>
            <td><strong>Kategori</strong></td>
            <td>' . htmlspecialchars($row['nama_kategori']) . '</td>
        </tr>

        <tr>
            <td><strong>Lokasi</strong></td>
            <td>' . htmlspecialchars($row['nama_lokasi']) . '</td>
        </tr>

        <tr>
            <td><strong>Tahun Perolehan</strong></td>
            <td>' . $row['tahun_perolehan'] . '</td>
        </tr>

        <tr>
            <td><strong>Umur Ekonomis</strong></td>
            <td>' . $row['umur_ekonomis'] . ' Tahun</td>
        </tr>

        <tr>
            <td><strong>Usia Pemakaian</strong></td>
            <td style="color:red;">
                <strong>' . $usia . ' Tahun</strong>
            </td>
        </tr>

    </table>

    <br>

    <p style="color:red;">
        <strong>
            STATUS: MASA MANFAAT TELAH TERLEWATI
        </strong>
    </p>

    <p>
        Mohon dilakukan pemeriksaan dan tindak lanjut
        terhadap aset tersebut.
    </p>

    <p>
        <a href="https://aset.smkfadilah.sch.id/">
            Buka Sistem Sarpras
        </a>
    </p>

    <hr>

    <small>
        Email ini dikirim secara otomatis oleh Sistem Sarpras.
    </small>

    </body>
    </html>
    ';

		$this->email->set_mailtype('html');
		$this->email->message($message);

		if ($this->email->send()) {

			log_message(
				'info',
				'EMAIL ASET BERHASIL: ' .
					$row['nama_barang']
			);

			return true;
		} else {

			log_message(
				'error',
				'EMAIL ASET GAGAL: ' .
					$row['nama_barang'] . ' - ' .
					$this->email->print_debugger()
			);

			return false;
		}
	}

	// Kirim rekap aset yang sudah melewati umur ekonomis via WhatsApp & Email
	public function kirimNotifikasi()
	{
		$aset_lewat = $this->mp->getAsetLewatUmur();

		if (count($aset_lewat) < 1) {
			$this->session->set_flashdata(
				'gagal',
				'Tidak ada aset yang melewati umur ekonomis.'
			);
			redirect('penyusutan');
		}

		$kirim_wa = $this->kirimWhatsAppLewatUmur($aset_lewat);
		$kirim_email = $this->kirimEmailLewatUmur($aset_lewat);

		if ($kirim_wa && $kirim_email) {
			$this->session->set_flashdata(
				'sukses',
				'Notifikasi terkirim ke WhatsApp & Email (' . count($aset_lewat) . ' aset).'
			);
		} else {
			$this->session->set_flashdata(
				'gagal',
				'Notifikasi gagal dikirim. Cek log sistem.'
			);
		}

		redirect('penyusutan');
	}

	public function penghapusanAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data['status_aset'] = 'Dihapuskan';
		unset($data['id_aset']);
		$result = $this->mp->updateAset($id_aset, $data);
		if ($result >= 1) {
			$this->session->set_flashdata('sukses', 'Dihapuskan');
			redirect('penyusutan');
		} else {
			$this->session->set_flashdata('gagal', 'Dihapuskan');
			redirect('penyusutan');
		}
	}
}

/* End of file Penyusutan.php */
/* Location: ./application/controllers/Penyusutan.php */