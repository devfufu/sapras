<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Habis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Jika nanti membutuhkan model, load di sini
        // $this->load->model('ModelHabis', 'mh');
    }

    public function index()
    {
        $data = array(
            'title' => 'Habis Pakai Barang',
            'active_menu_open_hpb' => 'menu-open',
            'active_habis' => 'active',
            'active_menu_hpb' => 'active',

            'pesan' => 'Mohon maaf, halaman Habis Pakai Barang sedang dalam perbaikan. Kami sedang melakukan pembaruan sistem agar layanan menjadi lebih baik.',
            'estimasi' => 'Silakan coba kembali beberapa saat lagi.'
        );

        $this->load->view('layouts/header', $data);
        //$this->load->view('habis/v_data', $data);
        $this->load->view('layouts/maintenance', $data);
        $this->load->view('layouts/footer');
    }

    public function data()
    {
        $data = array(
            'title' => 'Data Habis Pakai',
            'active_menu_open_hpb' => 'menu-open',
            'active_habis' => 'active',
            'active_menu_hd' => 'active',

            'pesan' => 'Mohon maaf, halaman Habis Pakai Barang sedang dalam perbaikan. Kami sedang melakukan pembaruan sistem agar layanan menjadi lebih baik.',
            'estimasi' => 'Silakan coba kembali beberapa saat lagi.'
        );

        $this->load->view('layouts/header', $data);
        //$this->load->view('habis/v_data', $data);
        $this->load->view('layouts/maintenance', $data);
        $this->load->view('layouts/footer');
    }
}
