<?php if (!$aset) {
    echo "Data aset tidak ditemukan";
    exit;
} ?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Label Aset</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .label {
        width: 8cm;
        height: 2.1cm;
        border: 2px solid #000;
        padding: 2px;
        box-sizing: border-box;
    }

    .row-label {
        display: flex;
        align-items: center;
        height: 100%;
    }

    /* KECIL */

    .label-kecil {
        transform: scale(1);

    }

    /* SEDANG */

    .label-sedang {
        transform: scale(1.3);
    }

    /* BESAR */

    .label-besar {
        transform: scale(1.6);
    }


    /* layout */

    .row-label {
        display: flex;
        align-items: center;
    }

    .logo {
        width: 80px;
        text-align: center;
    }

    .logo img {
        width: 60px;
    }

    .info {
        flex: 1;
        text-align: center;
        border-left: 2px solid black;
        border-right: 2px solid black;
        padding: 5px;
    }

    .barcode {
        width: 90px;
        text-align: center;
    }

    .barcode img {
        width: 70px;
    }

    .judul {
        font-weight: bold;
        font-size: 14px;
    }

    .nomor {
        font-size: 12px;
        font-weight: bold;
    }

    .nama_barang {
        font-size: 11px;
        font-weight: bold;
    }

    @media print {

        body {
            margin: 0;
        }

        .label {
            page-break-inside: avoid;
        }

    }

    * {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    </style>
</head>

<body onload="window.print()">

    <div class="label label-<?= $ukuran ?>">

        <div class="row-label">

            <!-- LOGO -->
            <div class="logo">
                <img src="<?= base_url('src/img/logo/logo.png') ?>">
            </div>

            <!-- DATA ASET -->
            <div class="info">

                <div class="judul">
                    SMK FADILAH
                </div>

                <div class="nomor">
                    Nomor : <?= $aset['kode_aset']; ?>
                </div>

                <div class="nama_barang">
                    <?= $aset['nama_barang']; ?>
                </div>

            </div>

            <!-- BARCODE -->
            <div class="barcode">
                <img src="<?= base_url('src/img/qrcode/' . $aset['qr_code']) ?>">
            </div>

        </div>

    </div>
</body>
<script>
window.onafterprint = function() {
    window.location.href = "<?= base_url('laporan/printLabel') ?>";
};
</script>


</html>