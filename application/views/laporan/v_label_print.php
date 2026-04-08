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
        border: 2px solid #000;
        padding: 2px;
        box-sizing: border-box;
        overflow: hidden;
    }

    .row-label {
        display: flex;
        align-items: center;
        height: 100%;
        overflow: hidden;
    }

    .info {
        flex: 1;
        text-align: center;
        border-left: 2px solid black;
        border-right: 2px solid black;
        padding: 1px;
        overflow: hidden;
    }

    .label-kecil {
        width: 8cm;
        height: 2.1cm;
    }

    .label-sedang {
        width: 10cm;
        height: 2.8cm;
    }

    .label-besar {
        width: 12cm;
        height: 3.5cm;
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
        padding: 1px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
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
        font-size: 12px;
    }

    .nomor {
        font-size: 11px;
    }

    .nama_barang {
        font-size: 10px;
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

    * {
        box-sizing: border-box;
    }
    </style>
    <style>
    /* =========================
   FONT PER UKURAN LABEL
========================= */

    /* KECIL */
    .label-kecil .judul {
        font-size: 12px;
    }

    .label-kecil .nomor {
        font-size: 11px;
    }

    .label-kecil .nama_barang {
        font-size: 10px;
    }

    /* SEDANG */
    .label-sedang .judul {
        font-size: 16px;
    }

    .label-sedang .nomor {
        font-size: 14px;
    }

    .label-sedang .nama_barang {
        font-size: 13px;
    }

    /* BESAR */
    .label-besar .judul {
        font-size: 20px;
    }

    .label-besar .nomor {
        font-size: 18px;
    }

    .label-besar .nama_barang {
        font-size: 16px;
    }

    /* =========================
   LOGO & QR IKUT BESAR
========================= */

    /* SEDANG */
    .label-sedang .logo img {
        width: 70px;
    }

    .label-sedang .barcode img {
        width: 80px;
    }

    /* BESAR */
    .label-besar .logo img {
        width: 85px;
    }

    .label-besar .barcode img {
        width: 89px;
    }
    </style>
</head>

<body onload="window.print()">
    <div class="label label-<?= $ukuran ?>">
        <div class="row-label">
            <div class="logo">
                <img src="<?= base_url('src/img/logo/logo.png') ?>">
            </div>
            <div class="info">
                <div class="judul"> <?= !empty($judul) ? $judul : 'Label Default' ?></div>
                <div class="judul"> <?= !empty($jenis_bantuan) ? $jenis_bantuan : 'Label Default' ?></div>
                <div class="nomor">Nomor : <?= $aset['kode_aset']; ?> </div>
                <div class="nama_barang"><?= $aset['nama_barang']; ?></div>
            </div>
            <div class="barcode">
                <img src="<?= base_url('src/img/qrcode/' . $aset['qr_code']) ?>">
            </div>
        </div>
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