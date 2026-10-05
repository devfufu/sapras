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

            // Untuk membuka menu Habis Pakai
            'active_menu_open_hpb' => 'menu-open',

            // Untuk membuat menu Habis Pakai aktif
            'active_habis' => 'active',

            // Untuk membuat submenu Habis Pakai Barang aktif
            'active_menu_hpb' => 'active'
        );

        $this->load->view('layouts/header', $data);
        $this->load->view('habis/v_habis', $data);
        $this->load->view('layouts/footer');
    }

    public function data()
    {
        $data = array(
            'title' => 'Data Habis Pakai',

            // Untuk membuka menu Habis Pakai
            'active_menu_open_hpb' => 'menu-open',

            // Untuk membuat menu Habis Pakai aktif
            'active_habis' => 'active',

            // Untuk membuat submenu Lihat Data aktif
            'active_menu_hd' => 'active'
        );

        $this->load->view('layouts/header', $data);
        $this->load->view('habis/v_data', $data);
        $this->load->view('layouts/footer');
    }
}
