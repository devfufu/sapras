<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Login/index';
$route['404_override'] = 'Welcome/halaman_notFound';
$route['translate_uri_dashes'] = FALSE;

//Auth
$route['login'] = 'Login/index';
$route['proses_login'] = 'Login/proses_login';
$route['logout'] = 'Login/proses_logout';

//Front
$route['aset/detail/(:any)'] = 'Welcome/detailAset/(:any)';

//Dashboard
$route['home'] = 'Home/index';

//Statistik
$route['statistik'] = 'Statistik/index';

//Master
$route['barang'] = 'Barang/index';
$route['barang/tambah'] = 'Barang/tambahBarang';
$route['barang/simpan'] = 'Barang/simpanBarang';
$route['barang/edit/(:any)'] = 'Barang/editBarang/(:any)';
$route['barang/ubah'] = 'Barang/ubahBarang';
$route['barang/hapus/(:any)'] = 'Barang/hapusBarang/(:any)';

//Jenis Barang
$route['kategori'] = 'KategoriBarang/index';
$route['kategori/simpan'] = 'KategoriBarang/store';
$route['kategori/ubah'] = 'KategoriBarang/ubah';
$route['kategori/hapus/(:any)'] = 'KategoriBarang/hapus/(:any)';
//LokasiAset
$route['lokasi'] = 'LokasiAset/index';
$route['lokasi/simpan'] = 'LokasiAset/simpanLokasi';
$route['lokasi/ubah'] = 'LokasiAset/ubahLokasi';
$route['lokasi/hapus/(:any)'] = 'LokasiAset/hapusLokasi/(:any)';

//User
$route['users'] = 'User/users';
$route['users/tambah'] = 'User/tambahUser';
$route['users/hapus/(:any)'] = 'User/hapusUser/(:any)';
$route['users/editUsers/(:num)'] = 'User/editUsers/$1';
$route['users/update'] = 'User/updateUsers';
$route['pengaturan'] = 'User/pengaturan';
$route['users/ubah'] = 'User/updateUser';
$route['users/ubah_password'] = 'User/updatePassword';
$route['users/resetPassword/(:num)'] = 'User/resetPassword/$1';
$route['users/importUsers'] = 'User/importUsers';



//Aset
$route['aset_wujud'] = 'Aset/index';
$route['aset_wujud/tambah'] = 'Aset/tambahAset';
$route['aset_wujud/tambahDataBaru'] = 'Aset/tambahAsetBaru';
$route['aset_wujud/generateKodeAset'] = 'Aset/generateKodeAset';
$route['aset_wujud/simpanAsetBaru'] = 'Aset/simpanAsetBaru';
$route['aset_wujud/cari'] = 'Aset/cariAset';
$route['aset_wujud/simpan'] = 'Aset/simpanAset';
$route['aset_wujud/edit/(:any)'] = 'Aset/editAset/(:any)';
$route['aset_wujud/ubah'] = 'Aset/ubahAset';
$route['aset_wujud/detail/(:any)'] = 'Aset/detailAset/(:any)';
$route['aset_wujud/hapus/(:any)'] = 'Aset/hapusAset/(:any)';
$route['aset_wujud/filter'] = 'Aset/filterAset';
$route['aset_wujud/print/(:any)'] = 'Aset/printAset/$1';
$route['aset_wujud/print_multiple'] = 'Aset/printMultiple';

//Dihapuskan
$route['aset_dihapuskan'] = 'Aset/dihapuskanAset';
$route['aset_dihapuskan/detail/(:any)'] = 'Aset/detailDihapuskanAset/(:any)';
$route['aset_dihapuskan/filter'] = 'Aset/filterAsetDihapuskan';

//Keputusan Pengadaan
$route['kriteria'] = 'Pengadaan/index';
$route['spesifikasi/ubah'] = 'Pengadaan/ubahSpesifikasi';
$route['kualitas/ubah'] = 'Pengadaan/ubahKualitas';
$route['data_aset'] = 'Pengadaan/aset';
$route['data_aset/simpan'] = 'Pengadaan/simpanAset';
$route['data_aset/ubah'] = 'Pengadaan/ubahAset';
$route['data_aset/hapus/(:any)'] = 'Pengadaan/hapusAset/(:any)';
$route['penilaian/simpan'] = 'Pengadaan/simpanPenilaian';
$route['penilaian/ubah'] = 'Pengadaan/ubahPenilaian';
$route['penilaian/hapus/(:any)'] = 'Pengadaan/hapusPenilaian/(:any)';


//spk
$route['spk'] = 'Pengadaan/spk';
$route['test'] = 'Pengadaan/testpk';

//Pengadaan
$route['pengajuan'] = 'Pengadaan/pengajuan';
$route['pengadaan'] = 'Pengadaan/pengadaan';
$route['pengadaan/simpan'] = 'Pengadaan/simpanPengadaan';
$route['pengadaan/detail/(:any)'] = 'Pengadaan/detailPengadaan/(:any)';
$route['pengadaan/setujui/(:any)'] = 'Pengadaan/setujuiPengadaan/(:any)';
$route['pengadaan/tolak/(:any)'] = 'Pengadaan/tolakPengadaan/(:any)';
$route['pengadaan/hapus/(:any)'] = 'Pengadaan/hapusPengadaan/(:any)';
$route['pengadaan/filter'] = 'Pengadaan/filterPengadaan';
$route['pengadaan/print/(:any)'] = 'Pengadaan/printPengadaan/$1';
$route['pengadaan/print_multiple'] = 'Pengadaan/printMultiple';


//Monitoring
$route['monitoring'] = 'Monitoring/index';
$route['monitoring/tambah'] = 'Monitoring/tambahMonitoring';
$route['monitoring/simpan'] = 'Monitoring/simpanMonitoring';
$route['monitoring/detail/(:any)'] = 'Monitoring/detailMonitoring/(:any)';
$route['monitoring/edit/(:any)'] = 'Monitoring/editMonitoring/(:any)';
$route['monitoring/ubah'] = 'Monitoring/ubahMonitoring';
$route['monitoring/hapus/(:any)'] = 'Monitoring/hapusMonitoring/(:any)';

//Penyusutan
$route['penyusutan'] = 'Penyusutan/index';
$route['penyusutan/detail/(:any)'] = 'Penyusutan/detailPenyusutan/(:any)';
$route['penyusutan/hapuskan/(:any)'] = 'Penyusutan/penghapusanAset/(:any)';
$route['penyusutan/filter'] = 'Penyusutan/filterPenyusutan';
$route['penyusutan/print'] = 'Penyusutan/print';

//Penghapusan
$route['penghapusan'] = 'Penghapusan/index';
$route['penghapusan/simpan'] = 'Penghapusan/simpanPenghapusan';

//Laporan
$route['laporan/aset'] = 'Laporan/aset';
$route['laporan/search_aset'] = 'Laporan/searchAset';
$route['laporan/search_asetRange'] = 'Laporan/searchAsetRange';
$route['laporan/print_aset'] = 'Laporan/printAset';
$route['laporan/export_aset'] = 'Laporan/export_aset';
$route['laporan/print_aset_range/(:num)/(:num)'] = 'laporan/print_aset_range/$1/$2';
$route['laporan/export_aset_range/(:num)/(:num)'] = 'laporan/export_aset_range/$1/$2';

//Laporan Penghapusan
$route['laporan/penghapusan'] = 'Laporan/penghapusan';
$route['laporan/search_penghapusan'] = 'Laporan/searchPenghapusan';
$route['laporan/print_penghapusan/(:any)/(:any)'] = 'Laporan/printPenghapusan/(:any)/(:any)';
$route['laporan/export_penghapusan/(:any)/(:any)'] = 'Laporan/export_penghapusan/(:any)/(:any)';

//Laporan QR Code
$route['laporan/qr_code'] = 'Laporan/qrcodeAset';
$route['laporan/print_qrcode'] = 'Laporan/printQrcode';

//Laporan Pengadaan
$route['laporan/pengadaan'] = 'Laporan/pengadaan';
$route['laporan/search_pengadaan'] = 'Laporan/searchPengadaan';
$route['laporan/print_pengadaan/(:any)/(:any)'] = 'Laporan/printPengadaan/(:any)/(:any)';
$route['laporan/export_pengadaan/(:any)/(:any)'] = 'Laporan/export_pengadaan/(:any)/(:any)';

//Laporan Print Label All data
$route['laporan/printLabel'] = 'Laporan/printLabel';
$route['laporan/filterLabel'] = 'Laporan/filterLabel';
$route['laporan/printLabelAll'] = 'Laporan/printLabelAll';
$route['laporan/cetakLabel/(:any)/(:any)'] = 'Laporan/cetakLabel/$1/$2';

//Laporan Notifikasi
$route['laporan/notifikasi'] = 'Laporan/notifikasi';

//Settingan 
$route['(:any)'] = 'errors/show_404';
$route['(:any)/(:any)'] = 'errors/show_404';
$route['(:any)/(:any)/(:any)'] = 'errors/show_404';
