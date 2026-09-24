<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Aset</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
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
            margin: 5px 0;
            font-size: 15px;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            text-align: center;
            background: #eee;
        }

        table td {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .foto {
            width: 70px;
            height: 70px;
            object-fit: cover;
        }

        .btn-print {
            margin-bottom: 20px;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        @media print {
            .btn-print {
                display: none;
            }

            body {
                margin: 10mm;
            }
        }
    </style>
</head>

<body>

    <button class="btn-print" onclick="window.print()">
        🖨 Print
    </button>

    <div class="header">
        <h2>DATA ASET</h2>
    </div>

    <?php if (!empty($lokasi)) : ?>

        <div class="info">
            <strong>Lokasi :</strong>
            <?= $lokasi['nama_lokasi']; ?>
        </div>

    <?php else : ?>

        <div class="info">
            <strong>Lokasi :</strong>
            Semua Lokasi
        </div>

    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Foto</th>
                <th>Kode Aset</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Sumber Pembelian</th>
                <th>Volume</th>
                <th>Satuan</th>
            </tr>
        </thead>

        <tbody>

            <?php $no = 1; ?>

            <?php foreach ($aset as $row) : ?>

                <tr>

                    <td class="text-center">
                        <?= $no++; ?>
                    </td>

                    <td class="text-center">

                        <?php if (!empty($row['foto_aset'])) : ?>

                            <img src="<?= base_url('src/img/aset/' . $row['foto_aset']); ?>" class="foto">

                        <?php else : ?>

                            -

                        <?php endif; ?>

                    </td>

                    <td>
                        <?= $row['kode_aset']; ?>
                    </td>

                    <td>
                        <?= $row['nama_barang']; ?>
                    </td>

                    <td>
                        <?= $row['nama_lokasi']; ?>
                    </td>

                    <td>
                        <?= $row['jenis_bantuan']; ?>
                    </td>

                    <td class="text-center">
                        <?= $row['volume']; ?>
                    </td>

                    <td class="text-center">
                        <?= $row['satuan']; ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>