<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Data Aset</title>
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


    /* Kolom Teks */

    .kop-text {
        width: calc(100% - 210px);
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
        font-size: 10px;
        line-height: 1.2;
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
        margin-bottom: 5px;
        text-decoration: underline;
    }

    .subjudul {
        text-align: center;
        font-size: 13px;
        font-weight: bold;
        margin-top: 0;
        margin-bottom: 25px;
    }

    /* =========================
       DATA ASET
    ========================= */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 15px;
    }

    .data-table th,
    .data-table td {
        border: 1px solid #000;
        padding: 7px 5px;
        vertical-align: middle;
        text-align: center;
        word-wrap: break-word;
    }

    .data-table th {
        font-size: 10px;
        font-weight: bold;
        background: #f2f2f2;
    }

    .data-table td {
        font-size: 10px;
    }

    /* =========================
       FOOTER / TANDA TANGAN
    ========================= */
    .ttd {
        width: 100%;
        margin-top: 50px;
        border-collapse: collapse;
    }

    .ttd td {
        width: 50%;
        text-align: center;
        vertical-align: top;
        border: none;
    }

    .jabatan {
        margin-bottom: 70px;
        line-height: 1.5;
    }

    .nama-pejabat {
        font-weight: bold;
        text-decoration: underline;
    }

    /* =========================
       TANGGAL CETAK
    ========================= */
    .tanggal-cetak {
        text-align: right;
        margin-top: 30px;
        margin-bottom: 0;
        font-size: 11px;
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

    /* =========================
       PRINT
    ========================= */
    @media print {

        .no-print {
            display: none;
        }

    }
    </style>
</head>

<body>
    <div class="container">
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
            DATA ASET BERWUJUD
        </h2>
        <div class="subjudul">
            INVENTARIS ASET
        </div>
        <table class="data-table">
            <!-- HEADER FIELD -->
            <tr>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Sumber Dana</th>
                <th>Tahun Perolehan</th>
                <th>Kondisi</th>
                <th>Volume</th>
                <th>Nilai Aset</th>
            </tr> <!-- ISI DATA -->
            <tr>
                <td> <?= htmlspecialchars($aset['kode_aset'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['nama_barang'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['nama_kategori'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['nama_lokasi'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['jenis_bantuan'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['tahun_perolehan'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['kondisi'] ?? '-'); ?> </td>
                <td> <?= htmlspecialchars($aset['volume'] ?? '-'); ?> </td>
                <td> <?= isset($aset['harga']) ? rupiah($aset['harga']) : '-'; ?> </td>
            </tr>
        </table>
        <div class="tanggal-cetak">

            Dicetak pada:
            <?= date('d-m-Y H:i'); ?>

        </div>
        <table class="ttd">
            <tr>
                <td>
                    <div class="jabatan">
                        Mengetahui,<br>
                        Kepala Sekolah
                    </div>
                    <div class="nama-pejabat">
                        Dr. Jayadih, M.Kom
                    </div>
                </td>
                <td>
                    <div class="jabatan">
                        <br>
                        Kepala Sapras
                    </div>
                    <div class="nama-pejabat">
                        Abdul Rohman, S.Kom
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <script>
    window.onload = function() {

        window.print();

    };
    </script>
</body>

</html>