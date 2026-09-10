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

        .no-print {
            margin-bottom: 20px;
        }

        .btn-print {
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .aset {
            width: 100%;
            min-height: 260mm;
            page-break-after: always;
        }

        .aset:last-child {
            page-break-after: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
        }

        .header h3 {
            margin: 5px 0 0;
            font-size: 14px;
            font-weight: normal;
        }

        .garis {
            border-top: 2px solid #000;
            margin-top: 10px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            border: 1px solid #000;
            padding: 10px;
            vertical-align: middle;
        }

        .label {
            width: 30%;
            font-weight: bold;
            background: #f2f2f2;
        }

        .footer {
            margin-top: 60px;
            text-align: right;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

<!-- TOMBOL PRINT -->
<div class="no-print">
    <button onclick="window.print()" class="btn-print">
        🖨 Print Semua Data
    </button>
</div>


<?php foreach ($aset as $row): ?>

    <div class="aset">

        <!-- HEADER -->
        <div class="header">

            <h2>DATA ASET BERWUJUD</h2>

            <h3>INVENTARIS ASET</h3>

            <div class="garis"></div>

        </div>


        <!-- DATA ASET -->
        <table class="data-table">

            <tr>
                <td class="label">Nama Barang</td>
                <td>
                    <?= $row['nama_barang'] ?? '-'; ?>
                </td>
            </tr>

            <tr>
                <td class="label">Merek</td>
                <td>
                    <?= $row['merek'] ?? '-'; ?>
                </td>
            </tr>

            <tr>
                <td class="label">Jumlah</td>
                <td>
                    <?= $row['volume'] ?? '-'; ?>
                </td>
            </tr>

            <tr>
                <td class="label">Kondisi</td>
                <td>
                    <?= $row['kondisi'] ?? '-'; ?>
                </td>
            </tr>

            <tr>
                <td class="label">Lokasi</td>
                <td>
                    <?= $row['nama_lokasi'] ?? '-'; ?>
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

<?php endforeach; ?>

</body>
</html>