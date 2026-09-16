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
<?php
// Set timezone Indonesia (WIB) 
date_default_timezone_set('Asia/Jakarta');

$hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
$bulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
$tanggalSekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$namaHari = $hari[$tanggalSekarang->format('l')];
$angkaTanggal = (int) $tanggalSekarang->format('d');
$namaBulan = $bulan[(int) $tanggalSekarang->format('m')];
$angkaTahun = (int) $tanggalSekarang->format('Y');
function angkaKeHuruf($angka)
{
    $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
    if ($angka < 12) {
        return $huruf[$angka];
    } elseif ($angka < 20) {
        return angkaKeHuruf($angka - 10) . ' Belas';
    } elseif ($angka < 100) {
        return angkaKeHuruf(intdiv($angka, 10)) . ' Puluh ' . angkaKeHuruf($angka % 10);
    } elseif ($angka < 200) {
        return 'Seratus ' . angkaKeHuruf($angka - 100);
    } elseif ($angka < 1000) {
        return angkaKeHuruf(intdiv($angka, 100)) . ' Ratus ' . angkaKeHuruf($angka % 100);
    } elseif ($angka < 2000) {
        return 'Seribu ' . angkaKeHuruf($angka - 1000);
    } elseif ($angka < 1000000) {
        return angkaKeHuruf(intdiv($angka, 1000)) . ' Ribu ' . angkaKeHuruf($angka % 1000);
    }
    return '';
}
$tanggalHuruf = angkaKeHuruf($angkaTanggal);
$tahunHuruf = angkaKeHuruf($angkaTahun);
?>

<body>

    <!-- TOMBOL PRINT -->
    <div class="no-print">
        <button onclick="window.print()" class="btn-print">
            🖨 Print Semua Data
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
        BERITA ACARA SERAH TERIMA BARANG <br>
        NO: <?= $tanggal1; ?>/<?= $bulan1; ?>/BAST-BARANG/FDL/<?= $tahun1; ?>
    </h2>
    <p style="text-align: justify; line-height: 1.5; font-size: 15px;">
        Pada hari ini, <strong><?= $namaHari; ?></strong>, tanggal <strong><?= $tanggalHuruf; ?></strong>
        <strong><?= $namaBulan; ?></strong> Tahun
        <strong><?= $tahunHuruf; ?></strong>, kami yang bertanda tangan di
        bawah ini:
    </p>
    <div style="margin-left: 20px;">
        <span style="font-weight: bold; font-size: 15px;">Nama : </span> Dr. Jayadih, M.Kom
        <br>
        <span style="font-weight: bold; font-size: 15px;">Jabatan : </span> Kepala Sekolah
    </div>

    <p style="text-align: justify; line-height: 1.5; font-size: 15px;">
        Dalam hal ini bertindak untuk dan atas nama SMK Fadilah, yang selanjutnya disebut sebagai <span
            style="font-weight: bold;">PIHAK
            PERTAMA
            (Yang Menyerahkan).</span>
    </p>
    <div style="margin-left: 20px;">
        <span style="font-weight: bold; font-size: 15px;">Nama : </span> Fadel Ahmad Ath Thariq,
        S.E.
        <br>
        <span style="font-weight: bold; font-size: 15px;">Jabatan : </span> Perwakilan / Pengurus
        Yayasan Fadilah
    </div>

    <p style="text-align: justify; line-height: 1.5; font-size: 15px;">
        Dalam hal ini bertindak untuk dan atas nama Yayasan Fadilah, yang selanjutnya disebut sebagai <span
            style="font-weight: bold;">PIHAK
            KEDUA
            (Yang Menerima)</span>.
    </p>
    <p style="text-align: justify; line-height: 1.5; font-size: 15px;">
        PIHAK PERTAMA menyerahkan barang kepada PIHAK KEDUA, dan PIHAK KEDUA menyatakan telah menerima barang dari
        PIHAK PERTAMA dalam keadaan baik dan lengkap dengan rincian sebagai berikut:
    </p>
    <!-- DATA ASET -->
    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Merek</th>
                <th>Volume</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody><?php $no = 1; ?>
            <?php foreach ($aset as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td style="text-align: left;"> <?= htmlspecialchars($row['nama_barang'] ?? '-'); ?> </td>
                    <td> <?= htmlspecialchars($row['merek'] ?? '-'); ?> </td>
                    <td> <?= htmlspecialchars($row['volume'] ?? '-'); ?> </td>
                    <td> <?= htmlspecialchars($row['kondisi'] ?? '-'); ?> </td>
                    <td><?= htmlspecialchars($row['nama_lokasi'] ?? '-'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="penutup">
        <p>
            Demikian Berita Acara Serah Terima Barang ini dibuat dengan sebenarnya dalam rangkap 2 (dua) untuk
            dipergunakan sebagaimana mestinya.
        </p>
    </div>
    <table class="ttd">
        <tr>
            <td>
                <div class="jabatan">
                    Menyetujui/Menyetujui<br>
                    Ketua Yayasan Fadilah
                </div>

                <div class="nama-pejabat">
                    A.K. Jaelani, S.H,
                </div>
            </td>

            <td>
                <div class="jabatan">
                    <br>
                    Pihak Kedua,
                </div>

                <div class="nama-pejabat">
                    Fadel Ahmad Ath Thariq, S.E,
                </div>
            </td>

            <td>
                <div class="pemohon">
                    Tangerang Selatan, <?= $tanggal ?><br>
                    Pihak Pertama,
                </div>

                <div class="nama-pejabat">
                    Dr. Jayadih, M.Kom.
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