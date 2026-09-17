<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Penyusutan</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul h2 {
            margin: 0;
            font-size: 18px;
        }

        .judul p {
            margin: 5px 0;
            font-size: 12px;
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
            background-color: #eee;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            body {
                margin: 10mm;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="no-print">
        <button onclick="window.print()" class="btn-info">
            🖨️ Print
        </button>
    </div>
    <div class="judul">
        <h2>LAPORAN PENYUSUTAN ASET</h2>
        <p>Data Penyusutan Aset</p>
        <?php if ($filter_digunakan): ?>

            <?php if (!empty($nama_kategori)): ?>
                <p>
                    <strong>Kategori:</strong>
                    <?= $nama_kategori; ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($tahun_perolehan)): ?>
                <p>
                    <strong>Tahun Perolehan:</strong>
                    <?= $tahun_perolehan; ?>
                </p>
            <?php endif; ?>

        <?php endif; ?>
        <p>Dicetak: <?= date('d-m-Y H:i'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Nama Aset</th>
                <th width="12%">Perolehan</th>
                <th width="15%">Masa Manfaat</th>
                <th width="15%">Pemakaian</th>
                <th width="18%">Penyusutan</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $no = 1;

            foreach ($pys as $row):
            ?>

                <tr>

                    <td class="text-center">
                        <?= $no++; ?>
                    </td>

                    <td>
                        <?= $row['nama_barang']; ?>
                    </td>

                    <td class="text-center">
                        <?= $row['tahun_perolehan']; ?>
                    </td>

                    <td class="text-center">
                        <?= $row['umur_ekonomis']; ?> Tahun
                    </td>

                    <td class="text-center">

                        <?php
                        $usia = date('Y') - ($row['tahun_perolehan'] - 1);

                        if ($usia > $row['umur_ekonomis']) {
                            echo $usia . " Tahun";
                        } else {
                            echo $usia . " Tahun";
                        }
                        ?>

                    </td>

                    <td class="text-right">

                        <?php

                        $i = 0;
                        $tahun_skrg = date("Y");
                        $rentang = ($tahun_skrg - $row['tahun_perolehan']) + 1;

                        $akumulasi_penyusutan = 0;

                        for ($x = 1; $x <= $rentang; $x++) {

                            // Rumus penyusutan
                            $tahun = $row['tahun_perolehan'] + $i;

                            $tarif_penyusutan =
                                (100 / 100) / $row['umur_ekonomis'];

                            $nilai_sisa =
                                $tarif_penyusutan * $row['harga'];

                            $penyusutan =
                                ($row['harga'] - $nilai_sisa)
                                / $row['umur_ekonomis'];

                            $akumulasi_penyusutan =
                                $penyusutan * $x;

                            $nilai_aset =
                                $row['harga']
                                - $akumulasi_penyusutan;

                            if ($nilai_aset < $nilai_sisa) {
                                break;
                            }
                        }

                        echo rupiah($akumulasi_penyusutan);

                        ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>

</body>

</html>