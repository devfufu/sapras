<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged") <> 1) {
			redirect(site_url('login'));
		}

		//load model
		$this->load->model('ModelLaporan', 'ml');
	}

	public function aset()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_ast' => 'active',
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('laporan/v_laporan', $data);
		$this->load->view('layouts/footer');
	}

	public function searchAsetRange()
	{
		$tahun_awal  = $this->input->post('tahun_awal');
		$tahun_akhir = $this->input->post('tahun_akhir');
		$jenis_bantuan = $this->input->post('jenis_bantuan', true);

		$data = array(
			'title' => 'Laporan Data Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_ast' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'aset' => $this->ml->getAsetRangeTahun($tahun_awal, $tahun_akhir, $jenis_bantuan),
			'range' => $tahun_awal . " - " . $tahun_akhir
		);

		if (count($data['aset']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('laporan/r_aset', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Data tidak ditemukan');
			redirect('laporan/aset');
		}
	}

	public function searchAset()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$jenis_bantuan = $this->input->post('jenis_bantuan', true);

		$data = array(
			'title' => 'Laporan Data Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_ast' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'lok' => $this->ml->getLokasiId($id_lokasi),
			'aset' => $this->ml->getAsetWujud($id_lokasi, $jenis_bantuan),
			'range' => '',
			'id_lokasi' => $id_lokasi,
			'jenis_bantuan' => $jenis_bantuan
		);

		if (count($data['aset']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('laporan/r_aset', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Data tidak ditemukan');
			redirect('laporan/aset');
		}
	}

	public function print_aset_range($tahun_awal, $tahun_akhir)
	{
		$jenis_bantuan = $this->input->get('jenis_bantuan');

		$data = array(
			'title' => 'Print Laporan Aset',
			'aset' => $this->ml->getAsetRangeTahun($tahun_awal, $tahun_akhir, $jenis_bantuan),
			'range' => $tahun_awal . " - " . $tahun_akhir
		);

		if (count($data['aset']) > 0) {
			$this->load->view('laporan/p_aset', $data);
		} else {
			$this->session->set_flashdata('gagal', 'Data tidak ditemukan');
			redirect('laporan/aset');
		}
	}

	public function export_aset_range($tahun_awal, $tahun_akhir)
	{
		$jenis_bantuan = $this->input->get('jenis_bantuan');
		$aset = $this->ml->getAsetRangeTahun($tahun_awal, $tahun_akhir, $jenis_bantuan);

		$spreadsheet = new Spreadsheet;
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->mergeCells('A1:F1');
		$sheet->setCellValue('A1', 'LAPORAN DATA ASET');
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1')->getFont()->setBold(true);

		$sheet->mergeCells('A2:F2');
		$sheet->setCellValue('A2', 'TAHUN ' . $tahun_awal . ' - ' . $tahun_akhir);
		$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A2')->getFont()->setBold(true);

		$sheet->setCellValue('A4', 'NO');
		$sheet->setCellValue('B4', 'NAMA');
		$sheet->setCellValue('C4', 'LOKASI');
		$sheet->setCellValue('D4', 'SUMBER PEMBELIAN');
		$sheet->setCellValue('E4', 'VOLUME');
		$sheet->setCellValue('F4', 'SATUAN');
		$sheet->setCellValue('G4', 'HARGA (Rp.)');
		$sheet->setCellValue('H4', 'JUMLAH (Rp.)');

		$sheet->getStyle('A4:H4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A4:H4')->getFont()->setBold(true);

		$row = 5;
		$no = 1;
		$total = 0;

		foreach ($aset as $item) {

			$sheet->setCellValue('A' . $row, $no);
			$sheet->setCellValue('B' . $row, $item['nama_barang']);
			$sheet->setCellValue('C' . $row, $item['nama_lokasi']);
			$sheet->setCellValue('D' . $row, $item['jenis_bantuan']);
			$sheet->setCellValue('E' . $row, $item['volume']);
			$sheet->setCellValue('F' . $row, $item['satuan']);
			$sheet->setCellValue('G' . $row, $item['harga']);
			$sheet->setCellValue('H' . $row, $item['total_harga']);

			$total += $item['total_harga'];

			$row++;
			$no++;
		}

		$sheet->mergeCells('A' . $row . ':G' . $row);
		$sheet->setCellValue('A' . $row, 'TOTAL');
		$sheet->setCellValue('H' . $row, $total);

		$sheet->getStyle('A' . $row . ':H' . $row)->getFont()->setBold(true);

		$sheet->getStyle('A5:A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('C5:H' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		$sheet->getStyle('E5:H' . $row)
			->getNumberFormat()
			->setFormatCode('#,##0');


		foreach (range('A', 'H') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}

		$sheet->getStyle('A4:H' . $row)->applyFromArray([
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		]);

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Aset_Tahun_' . $tahun_awal . '_' . $tahun_akhir . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function printAset()
	{
		$id_lokasi = $this->input->get('id_lokasi');
		$jenis_bantuan = $this->input->get('jenis_bantuan');

		$data['aset'] = $this->ml->getAsetWujud($id_lokasi, $jenis_bantuan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);
		$data['tahun'] = '';

		if (count($data['aset']) > 0) {
			$this->load->view('laporan/p_aset', $data);
		} else {
			$this->session->set_flashdata('gagal', 'Data Tidak Ditemukan');
			redirect('laporan/aset');
		}
	}

	public function export_aset()
	{
		$id_lokasi = $this->input->get('id_lokasi');
		$jenis_bantuan = $this->input->get('jenis_bantuan');

		$aset = $this->ml->getAsetWujudExcel($id_lokasi, $jenis_bantuan);
		$lokasi = $this->ml->getLokasiById($id_lokasi);

		$spreadsheet = new Spreadsheet;
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->mergeCells('A1:F1');
		$sheet->setCellValue('A1', 'LAPORAN DATA ASET');
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1')->getFont()->setBold(true);


		$sheet->mergeCells('A2:F2');
		$sheet->setCellValue('A2', 'LOKASI : ' . $lokasi->nama_lokasi);
		$sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A2')->getFont()->setBold(true);

		$sheet->setCellValue('A3', 'NO');
		$sheet->setCellValue('B3', 'KODE ASET');
		$sheet->setCellValue('C3', 'NAMA');
		$sheet->setCellValue('D3', 'LOKASI');
		$sheet->setCellValue('E3', 'SUMBER');
		$sheet->setCellValue('F3', 'VOLUME');
		$sheet->setCellValue('G3', 'SATUAN');
		$sheet->setCellValue('H3', 'HARGA');
		$sheet->setCellValue('I3', 'JUMLAH');

		$sheet->getStyle('A3:I3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A3:I3')->getFont()->setBold(true);

		$row = 4;
		$no = 1;
		$total = 0;

		foreach ($aset as $item) {

			$sheet->setCellValue('A' . $row, $no);
			$sheet->setCellValue('B' . $row, $item->kode_aset);
			$sheet->setCellValue('C' . $row, $item->nama_barang);
			$sheet->setCellValue('D' . $row, $item->nama_lokasi);
			$sheet->setCellValue('E' . $row, $item->jenis_bantuan);
			$sheet->setCellValue('F' . $row, $item->volume);
			$sheet->setCellValue('G' . $row, $item->satuan);
			$sheet->setCellValue('H' . $row, $item->harga);
			$sheet->setCellValue('I' . $row, $item->total_harga);

			$total += $item->total_harga;

			$row++;
			$no++;
		}

		$sheet->mergeCells('A' . $row . ':H' . $row);
		$sheet->setCellValue('A' . $row, 'TOTAL');
		$sheet->setCellValue('I' . $row, $total);

		$sheet->mergeCells('A1:I1');
		$sheet->mergeCells('A2:I2');

		$sheet->getStyle('A3:I3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A3:I3')->getFont()->setBold(true);

		foreach (range('A', 'I') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}

		$sheet->getStyle('A3:I' . $row)->applyFromArray([
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		]);

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Aset_Perlokasi.xlsx"');
		header('Cache-Control: max-age=0');


		$writer->save('php://output');
	}

	public function penghapusan()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_php' => 'active',
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('laporan/v_laporan_ph', $data);
		$this->load->view('layouts/footer');
	}

	public function searchPenghapusan()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_perolehan = $this->input->post('tahun_perolehan');

		$data = array(
			'title' => 'Laporan Data Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_php' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'lok' => $this->ml->getLokasiId($id_lokasi),
			'aset' => $this->ml->getAsetDihapuskan($id_lokasi, $tahun_perolehan)
		);

		if (count($data['aset']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('laporan/r_penghapusan', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('laporan/aset');
		}
	}

	public function printPenghapusan($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_perolehan = $this->uri->segment(4);

		$data['aset'] = $this->ml->getAsetDihapuskan($id_lokasi, $tahun_perolehan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		if (count($data['aset']) > 0) {
			$this->load->view('laporan/p_penghapusan', $data);
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('laporan/aset');
		}
	}

	public function export_penghapusan($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_perolehan = $this->uri->segment(4);

		$aset = $this->ml->getAsetDihapuskanExcel($id_lokasi, $tahun_perolehan);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'NO')
			->setCellValue('B1', 'NAMA')
			->setCellValue('C1', 'VOLUME')
			->setCellValue('D1', 'SATUAN')
			->setCellValue('E1', 'HARGA (Rp.)')
			->setCellValue('F1', 'JUMLAH (Rp.)');

		$kolom = 2;
		$nomor = 1;
		foreach ($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $item->nama_barang)
				->setCellValue('C' . $kolom, $item->volume)
				->setCellValue('D' . $kolom, $item->satuan)
				->setCellValue('E' . $kolom, $item->harga)
				->setCellValue('F' . $kolom, $item->total_harga);

			$kolom++;
			$nomor++;
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Aset Dihapuskan.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function qrcodeAset()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_qr' => 'active',
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('laporan/v_qrcode', $data);
		$this->load->view('layouts/footer');
	}

	public function printQrcode()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_perolehan = $this->input->post('tahun_perolehan');

		$data['aset'] = $this->ml->getAsetQr($id_lokasi, $tahun_perolehan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		if (count($data['aset']) > 0) {
			$this->load->view('laporan/p_qrcode', $data);
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('laporan/aset');
		}
	}

	public function pengadaan()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_lpnd' => 'active',
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('laporan/v_pengadaan', $data);
		$this->load->view('layouts/footer');
	}

	public function searchPengadaan()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_pengadaan = $this->input->post('tahun_pengadaan');

		$data = array(
			'title' => 'Laporan Pengadaan',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_lpnd' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'lok' => $this->ml->getLokasiId($id_lokasi),
			'pnd' => $this->ml->getPengadaan($id_lokasi, $tahun_pengadaan)
		);

		if (count($data['pnd']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('laporan/r_pengadaan', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('laporan/pengadaan');
		}
	}

	public function printPengadaan($id_lokasi, $tahun_pengadaan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_pengadaan = $this->uri->segment(4);

		$data['pnd'] = $this->ml->getPengadaan($id_lokasi, $tahun_pengadaan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		$this->load->view('laporan/p_pengadaan', $data);
	}

	public function export_pengadaan($id_lokasi, $tahun_pengadaan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_pengadaan = $this->uri->segment(4);

		$pnd = $this->ml->getPengadaanExcel($id_lokasi, $tahun_pengadaan);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'NO')
			->setCellValue('B1', 'NAMA')
			->setCellValue('C1', 'VOLUME')
			->setCellValue('D1', 'SATUAN')
			->setCellValue('E1', 'HARGA (Rp.)')
			->setCellValue('F1', 'JUMLAH (Rp.)');

		$kolom = 2;
		$nomor = 1;
		foreach ($pnd as $item) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $item->nama_aset)
				->setCellValue('C' . $kolom, $item->volume)
				->setCellValue('D' . $kolom, $item->satuan)
				->setCellValue('E' . $kolom, $item->harga_satuan)
				->setCellValue('F' . $kolom, ($item->volume * $item->harga_satuan));

			$kolom++;
			$nomor++;
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Pengadaan Aset.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function printLabel()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_print_label' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'aset' => $this->ml->getAsetLabelPrint()
		);

		$this->load->view('layouts/header', $data);
		$this->load->view('laporan/v_p_label', $data);
		$this->load->view('layouts/footer');
	}

	public function filterLabel()
	{
		$jenis_bantuan = $this->input->post('jenis_bantuan', true);

		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_print_label' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'aset' => $this->ml->getAsetLabelPrint($jenis_bantuan)
		);

		if (count($data['aset']) > 0) {
			$this->load->view('layouts/header', $data);
			$this->load->view('laporan/v_p_label', $data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Data tidak ditemukan');
			redirect('laporan/printLabel');
		}
	}

	public function printLabelAll()
	{
		$jenis_bantuan = $this->input->get('jenis_bantuan');

		$data['aset'] = $this->ml->getAsetLabelPrint($jenis_bantuan);

		$this->load->view('laporan/v_label_print_all', $data);
	}

	public function cetakLabel($id_aset, $ukuran)
	{
		$data['aset'] = $this->db
			->select('a.kode_aset, b.nama_barang, b.tahun_perolehan, a.qr_code')
			->from('asets a')
			->join('barang b', 'b.id_barang = a.id_barang')
			->where('a.id_aset', $id_aset)
			->get()
			->row_array();

		$data['ukuran'] = $ukuran;

		$this->load->view('laporan/v_label_print', $data);
	}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */