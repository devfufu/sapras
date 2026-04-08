<!DOCTYPE html>
<html>

<head>
    <title>Print Label Aset</title>
    <style>
        body {
            margin: 0;
            padding: 10px;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            font-size: 0;
            /* hilangkan spasi antar inline-block */
        }

        .label {
            display: inline-block;
            width: 8cm;
            height: 2.1cm;
            border: 2px solid #000;
            padding: 2px;
            box-sizing: border-box;
            margin: 3px;
            vertical-align: top;
            font-size: 12px;
        }

        /* ❌ HAPUS transform */
        .label-kecil,
        .label-sedang,
        .label-besar {
            transform: none;
        }

        .row-label {
            display: flex;
            align-items: center;
            height: 100%;
        }

        /* layout */
        .logo {
            width: 60px;
            text-align: center;
        }

        .logo img {
            width: 45px;
        }

        .info {
            flex: 1;
            text-align: center;
            border-left: 2px solid black;
            border-right: 2px solid black;
            padding: 3px;
        }

        .barcode {
            width: 70px;
            text-align: center;
        }

        .barcode img {
            width: 60px;
        }

        .judul {
            font-weight: bold;
            font-size: 11px;
        }

        .nomor {
            font-size: 10px;
            font-weight: bold;
        }

        .nama_barang {
            font-size: 10px;
            font-weight: bold;
        }

        /* PRINT FIX */
        @media print {

            body {
                margin: 5mm;
            }

            .label {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }

        /* biar warna tetap */
        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        @page {
            size: A4;
            margin: 5mm;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">

        <?php foreach ($aset as $a): ?>
            <div class="label label-kecil">

                <div class="row-label">

                    <!-- LOGO -->
                    <div class="logo">
                        <img src="<?= base_url('src/img/logo/logo.png') ?>">
                    </div>

                    <!-- INFO -->
                    <div class="info">
                        <div class="judul"> <?= !empty($judul) ? $judul : 'Label Default' ?></div>
                        <div class="judul"> <?= !empty($jenis_bantuan) ? $jenis_bantuan : 'Label Default' ?></div>
                        <div class="nomor">No: <?= $a['kode_aset']; ?></div>
                        <div class="nama_barang"><?= $a['nama_barang']; ?></div>
                    </div>

                    <!-- BARCODE -->
                    <div class="barcode">
                        <img src="<?= base_url('src/img/qrcode/' . $a['qr_code']) ?>">
                    </div>

                </div>

            </div>
        <?php endforeach; ?>

    </div>
</body>
<script>
    window.onafterprint = function() {
        window.close();
        setTimeout(function() {
            window.location.href = "<?= base_url('laporan') ?>";
        }, 500);
    };
</script>


</html>