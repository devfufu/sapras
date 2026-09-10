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
    }


    /* =========================
           TANDA TANGAN
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

    }
    </style>

</head>

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
        PENGAJUAN KEBUTUHAN BARANG
    </h2>
    <div class="isi-surat">

        <p>
            Dalam rangka menunjang kelancaran pelaksanaan kegiatan
            pembelajaran serta memenuhi kebutuhan sarana dan prasarana
            sekolah, dengan ini kami mengajukan kebutuhan barang yang
            diperlukan untuk mendukung kegiatan operasional dan proses
            pembelajaran di lingkungan SMK Fadilah.
        </p>

        <p>
            Adapun barang yang diajukan adalah sebagai berikut:
        </p>

    </div>
    <table class="data">
        <tr>
            <th>Nama</th>
            <th>Penempatan</th>
            <th>Nama Aset</th>
            <th>Tahun Pengadaan</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>
                <?= htmlspecialchars($pengadaan['nama_user']); ?>
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['nama_lokasi']); ?>
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['nama_aset']); ?>
            </td>
            <td>
                <?= htmlspecialchars($pengadaan['tahun_pengadaan']); ?>
            </td>
            <td>
                <?php if ($pengadaan['status'] == '0'): ?>

                Belum Disetujui

                <?php elseif ($pengadaan['status'] == '1'): ?>

                Disetujui

                <?php else: ?>

                Ditolak

                <?php endif; ?>
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
    <script>
    window.onload = function() {

        window.print();

    };
    </script>
</body>

</html>