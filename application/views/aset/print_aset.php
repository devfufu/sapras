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
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header h3 {
            margin: 5px 0 0;
            font-size: 14px;
        }

        .garis {
            border-top: 2px solid #000;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: middle;
        }

        .label {
            width: 30%;
            font-weight: bold;
            background: #f2f2f2;
        }

        .foto {
            text-align: center;
            padding: 15px;
        }

        .foto img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #000;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .no-print {
            margin-bottom: 20px;
        }

        .btn-print {
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- TOMBOL PRINT -->
    <div class="no-print">
        <button onclick="window.print()" class="btn-print">
            🖨 Print
        </button>
    </div>

    <!-- HEADER -->
    <div class="header">

        <h2>DATA ASET BERWUJUD</h2>

        <h3>INVENTARIS ASET</h3>

        <div class="garis"></div>

    </div>


    <!-- DATA ASET -->
    <table class="data-table">

        <tr>
            <td class="label">Kode Aset</td>
            <td><?= $aset['kode_aset'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Nama Aset</td>
            <td><?= $aset['nama_barang'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Kategori</td>
            <td><?= $aset['nama_kategori'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Lokasi</td>
            <td><?= $aset['nama_lokasi'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Sumber Dana</td>
            <td><?= $aset['jenis_bantuan'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Tahun Perolehan</td>
            <td><?= $aset['tahun_perolehan'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Kondisi</td>
            <td><?= $aset['kondisi'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Volume</td>
            <td><?= $aset['volume'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td class="label">Nilai Aset</td>
            <td>
                <?= isset($aset['harga']) ? rupiah($aset['harga']) : '-'; ?>
            </td>
        </tr>

        <tr>
            <td class="label">Foto Aset</td>
            <td class="foto">

                <?php if (!empty($aset['foto_aset'])): ?>

                    <img src="<?= base_url('src/img/aset/' . $aset['foto_aset']); ?>">

                <?php else: ?>

                    Tidak ada foto

                <?php endif; ?>

            </td>
        </tr>

    </table>


    <!-- FOOTER -->
    <div class="footer">

        <p>
            Dicetak pada:
            <?= date('d-m-Y H:i'); ?>
        </p>

        <br><br><br>

        <p>
            __________________________
        </p>

    </div>

</div>

</body>
</html>