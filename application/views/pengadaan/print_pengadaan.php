<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Print Pengadaan</title>

    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 13px;
            color: #000;
            margin: 0;
        }

        /* =========================
           KOP SURAT
        ========================= */

        .kop {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .kop td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        /* Kolom logo */
        .logo {
            width: 105px;
            text-align: center;
        }

        .logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        /* Kolom teks */
        .kop-text {
            width: calc(100% - 210px);
            text-align: center;
        }

        /* Kolom penyeimbang */
        .kop-spacer {
            width: 105px;
        }

        .yayasan {
            font-size: 15px;
            margin-bottom: 1px;
        }

        .sekolah {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 1px;
        }

        .akreditasi {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 1px;
        }

        .program {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;
            line-height: 1.3;
            margin: 0 auto 5px auto;
        }

        .alamat {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10 px;
            line-height: 1;
            text-align: center;
        }

        /* =========================
       GARIS KOP
    ========================= */

        .garis-kop {
            border-top: 3px solid #000;
            margin-top: 2px;
            margin-bottom: 25px;
        }

        /* =========================
           JUDUL
        ========================= */
        h2 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 25px;
            text-decoration: underline;
        }

        /* =========================
           ISI SURAT
        ========================= */
        .isi-surat {
            text-align: justify;
            line-height: 1.6;
            font-size: 15px;
            margin-bottom: 20px;
        }

        /* =========================
           TABEL
        ========================= */

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 9px 6px;
            text-align: center;
            vertical-align: middle;
        }

        table.data th {
            background: #f2f2f2;
            font-weight: bold;
        }


        /* =========================
           PENUTUP
        ========================= */

        .penutup {
            margin-top: 25px;
            text-align: justify;
            line-height: 1.6;
            font-size: 15px;
        }


        /* =========================
           TANDA TANGAN
        ========================= */

        .ttd {
            width: 100%;
            margin-top: 50px;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .ttd td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            border: none;
        }

        .jabatan,
        .pemohon {
            margin-bottom: 70px;
            line-height: 1.5;
        }

        .nama-pejabat {
            font-weight: bold;
            text-decoration: underline;
        }

        /* =========================
           PRINT
        ========================= */

        .no-print {
            margin-bottom: 20px;
        }

        .btn-print {
            padding: 8px 15px;
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        @media print {

            .no-print {
                display: none;
            }

            @page {
                size: A4;
                margin: 15mm;
            }

            .no-print {
                display: none !important;
            }

            html,
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>

</head>
<?php
$bulan = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

$tanggal = date('j') . ' ' . $bulan[(int) date('n')] . ' ' . date('Y');
$tanggal1 = date('d');
$bulan1 = date('m');
$tahun1 = date('Y');
?>

<body>
    <div class="no-print">
        <button onclick="window.print()" class="btn-print">
            🖨️ Print
        </button>
    </div>
    <table class="kop">
        <tr>
            <td class="logo">
                <img src="<?= base_url('src/img/logo/logo.png'); ?>" alt="Logo SMK Fadilah">
            </td>
            <td class="kop-text">
                <div class="yayasan">
                    YAYASAN FADILAH
                </div>
                <div class="sekolah">
                    SMK FADILAH
                </div>
                <div class="akreditasi">
                    STATUS : TERAKREDITASI "A", NPSN : 20615746
                </div>
                <div class="program">
                    PROGRAM KEAHLIAN : DESAIN KOMUNIKASI VISUAL, TEKNIK JARINGAN KOMPUTER DAN<br>
                    TELEKOMUNIKASI, TEKNIK OTOMOTIF DAN PERHOTELAN
                </div>
                <div class="alamat">
                    Jl. Pendidikan II No.80 RT 03/21 Kelurahan Parigi Kec. Pondok Aren,
                    Kota Tangerang Selatan Provinsi Banten Kode Pos 15227
                    Telp. (021) 22214499
                </div>
                <div class="alamat">
                    sekolahfadilah.sch.id, email : sekolahfadilah@gmail.com
                </div>
            </td>
            <!-- PENYEIMBANG LOGO -->
            <td class="kop-spacer"></td>
        </tr>
    </table>
    <div class="garis-kop"></div>
    <h2>
        SURAT PENGAJUAN PENGADAAN BARANG/JASA (SP2BJ) <br>
        NO: <?= $tanggal1; ?>/<?= $bulan1; ?>/SP2BJ/FDL/<?= $tahun1; ?>

    </h2>
    <div class="isi-surat">

        <span style="font-weight: bold;">Kepada Yth.</span> <br>
        <span style="font-weight: bold;">Kabag Sapras / Ketua Yayasan Fadilah</span> <br>
        <span> di Tempat</span>

        <p>
            Dengan hormat,
            Sehubungan dengan upaya peningkatan mutu layanan pendidikan dan pemenuhan kebutuhan operasional kegiatan
            belajar mengajar (KBM) di SMK Fadilah, bersama surat ini kami mengajukan permintaan pengadaan barang/jasa
            dengan rincian sebagai berikut:

        </p>

        <span style="font-weight: bold; margin-left: 20px;">• Unit/Departemen Pengaju : </span>
        <?= htmlspecialchars($pengadaan['nama_lokasi']); ?> <br>
        <span style="font-weight: bold; margin-left: 20px;">• Tujuan Pengadaan :</span>
        <?= htmlspecialchars($pengadaan['tujuan_pengadaan']); ?><br>
        <span style="font-weight: bold; margin-left: 20px;">• Sifat Pengadaan :</span>
        <?= htmlspecialchars($pengadaan['sifat_pengadaan']); ?>

        <p>
            Rincian Kebutuhan Barang / Jasa:
        </p>

    </div>
    <table class="data">
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Merek</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Est.Harga Satuan</th>
            <th>Est.Total Harga</th>
            <th>Keterangan/alasan</th>
        </tr>
        <tr>
            <?php
            $total_harga = $pengadaan['volume'] * $pengadaan['harga_satuan'];
            ?>

            <td>
                1
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['nama_aset']); ?>
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['merek']); ?>
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['volume']); ?>
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['satuan']); ?>
            </td>
            <td>
                <?= number_format($pengadaan['harga_satuan'], 0, ',', '.'); ?>
            </td>
            <td>
                <?= number_format($total_harga, 0, ',', '.'); ?>
            </td>
            <td>

            </td>
        </tr>
    </table>
    <div class="penutup">
        <p>
            Demikian pengajuan kebutuhan barang ini kami sampaikan.
            Besar harapan kami agar pengajuan tersebut dapat dipertimbangkan
            dan disetujui guna menunjang kegiatan pembelajaran serta
            meningkatkan kelancaran pelaksanaan kegiatan di lingkungan
            sekolah.
        </p>

        <p>
            Atas perhatian dan persetujuan Bapak/Ibu, kami ucapkan
            terima kasih.
        </p>
    </div>
    <table class="ttd">
        <tr>
            <td>
                <div class="jabatan">
                    Menyetujui,<br>
                    Kepala Sekolah
                </div>

                <div class="nama-pejabat">
                    Dr. Jayadih, M.Kom
                </div>
            </td>

            <td>
                <div class="jabatan">
                    Mengetahui,<br>
                    Kepala Sapras
                </div>

                <div class="nama-pejabat">
                    Abdul Rohman, S.Kom
                </div>
            </td>

            <td>
                <div class="pemohon">
                    Tangerang Selatan, <?= $tanggal ?><br>
                    Pemohon
                </div>

                <div class="nama-pejabat">
                    <?= htmlspecialchars($pengadaan['nama_user']); ?>
                </div>
            </td>
        </tr>
    </table>
    <script>
        window.onload = function() {

            window.print();

        };
    </script>
</body>

</html>