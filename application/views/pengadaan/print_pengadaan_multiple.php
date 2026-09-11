<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Print Data Pengadaan</title>

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


        /* Kolom Logo */

        .logo {
            width: 105px;
            text-align: center;
        }

        .logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        /* Kolom Text Kop */
        .kop-text {
            width: calc(100% - 260px);
            text-align: center;
        }


        /* Kolom Penyeimbang */

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
            margin-top: 0;
            margin-bottom: 25px;
            text-decoration: underline;
        }

        .isi-surat {
            text-align: justify;
            line-height: 1.6;
            font-size: 15px;
            margin-bottom: 20px;
        }



        /* =========================
       TABEL DATA
    ========================= */

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table.data th,
        table.data td {
            border: 1px solid #000;
            padding: 7px;
            vertical-align: middle;
        }

        table.data th {
            text-align: center;
            font-weight: bold;
        }

        table.data td {
            text-align: left;
        }


        /* Kolom tertentu rata tengah */

        table.data td.no,
        table.data td.tahun,
        table.data td.status {
            text-align: center;
        }


        /* =========================
       TOMBOL PRINT
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

        .penutup {
            margin-top: 25px;
            text-align: justify;
            line-height: 1.6;
            font-size: 15px;
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
?>

<body>

    <!-- =========================
     TOMBOL PRINT
========================= -->

    <div class="no-print">

        <button onclick="window.print()" class="btn-print">
            🖨️ Print
        </button>
    </div>

    <!-- =========================
     KOP SURAT
========================= -->

    <table class="kop">

        <tr>

            <!-- LOGO -->

            <td class="logo">

                <img src="<?= base_url('src/img/logo/logo.png'); ?>" alt="Logo SMK Fadilah">

            </td>


            <!-- TEXT KOP -->

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
                    Jl. Pendidikan II No.80 RT 03/21 Kelurahan Parigi Kec. Pondok Aren, Kota Tangerang Selatan Provinsi
                    Banten Kode Pos 15227
                    Telp. (021) 22214499, sekolahfadilah.sch.id, email : sekolahfadilah@gmail.com
                </div>

            </td>


            <!-- PENYEIMBANG LOGO -->

            <td class="kop-spacer"></td>

        </tr>

    </table>

    <!-- =========================
     GARIS KOP
========================= -->

    <div class="garis-kop"></div>

    <!-- =========================
     JUDUL
========================= -->

    <h2>
        SURAT PENGAJUAN PENGADAAN BARANG/JASA (SP2BJ) <br>
        NO: ...../SP2BJ/SMKF/2026
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
        <span style="font-weight: bold; margin-left: 20px;">• Unit/Departemen Pengaju : </span> [Contoh: Laboratorium
        Komputer / Program
        Keahlian
        TKJ] <br>
        <span style="font-weight: bold; margin-left: 20px;">• Tujuan Pengadaan :</span> [Contoh: Peremajaan fasilitas
        unit sarana praktik
        siswa] <br>
        <span style="font-weight: bold; margin-left: 20px;">• Sifat Pengadaan :</span> [ ] Biasa / [ ] Mendesak
        </p>

        <p>
            Rincian Kebutuhan Barang / Jasa:
        </p>

    </div>

    <!-- =========================
     TABEL DATA PENGADAAN
========================= -->

    <table class="data">
        <thead>
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
        </thead>
        <tbody> <?php $no = 1; ?>

            <?php foreach ($pengadaan as $row): ?>

                <?php
                $total_harga = $row['volume'] * $row['harga_satuan'];
                ?>

                <tr>
                    <td class="no">
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['nama_aset']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['merek']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['volume']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($row['satuan']); ?>
                    </td>

                    <td>
                        <?= 'Rp ' . number_format($row['harga_satuan'], 0, ',', '.'); ?>
                    </td>

                    <td>
                        <?= 'Rp ' . number_format($total_harga, 0, ',', '.'); ?>
                    </td>

                    <td>

                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
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
                    (__________________)
                </div>
            </td>
        </tr>
    </table>

    <!-- =========================
     AUTO PRINT
========================= -->

    <script>
        window.onload = function () {

            window.print();

        };
    </script>

</body>

</html>