<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>src/css/laporan.css">

    <title>Print Data Aset</title>
</head>
<style>
.judul {
    font-family: 'Times New Roman', Times, serif;
    font-weight: bold;
}

.table {
    width: 100% !important;
    table-layout: fixed;
    border-collapse: collapse !important;
}

.table th,
.table td {
    border: 1px solid #000 !important;
    padding: 5px;
    vertical-align: middle;
    word-wrap: break-word;
}

.table thead th {
    text-align: center !important;
    vertical-align: middle !important;
}

img {
    max-width: 80px;
    height: auto;
}

.ttd-table,
.ttd-table tr,
.ttd-table td {
    border: none !important;
}

.col-no {
    width: 3%;
}

.col-foto {
    width: 10%;
}

.col-kode {
    width: 10%;
}

.col-nama {
    width: 16%;
}

.col-lokasi {
    width: 10%;
}

.col-sumber {
    width: 15%;
}

.col-volume {
    width: 6%;
}

.col-satuan {
    width: 6%;
}

.col-harga {
    width: 11%;
}

.col-total {
    width: 12%;
}

@media print {

    @page {
        size: A4 portrait;
        margin: 10mm;
    }

    .container {
        max-width: 100% !important;
    }

    .table {
        width: 100% ! important;
        border-collapse: colla pse !important;
    }

    .table th,
    .table td {
        border: 1px solid #000 !important;
        padding: 3px !important;
        font-size: 10px;
        word-wrap: break-word;
    }

    .table img {
        max-width: 50px;
        height: auto;
    }
}
</style>

<body>
    <div class="container">
        <div class="row pt-4">


            <div class="col-md-10 text-center judul">
                <h2 style="font-size: 18;">YAYASAN FADILAH</h2>
                <h3>SMK FADILAH</h3>
                <p>Jl. Pendidikan II, Parigi, Kec.
                    Pd. Aren, Kota Tangerang Selatan, Banten 15227 </p>
            </div>
        </div>
        <hr style="border:1px solid
                    black;">
        <div class="row">
            <div class="col text-center">
                <strong class="judul">
                    LAPORAN DATA ASET <br>
                    <?php if (isset($lokasi)) { ?>
                    LOKASI : <?= $lokasi['nama_lokasi'] ?> <br>
                    TAHUN : <?= $tahun ?>
                    <?php } else { ?>
                    TAHUN <?= $range ?>
                    <?php } ?>
                </strong>
            </div>
        </div>
        <div class=" row pt-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th class="col-no">NO</th>
                            <th class="col-foto">FOTO</th>
                            <th class="col-kode">KODE ASET</th>
                            <th class="col-nama">NAMA</th>
                            <th class="col-lokasi">LOKASI</th>
                            <th class="col-sumber">SUMBER PEMBELIAN</th>
                            <th class="col-volume">VOLUME</th>
                            <th class="col-satuan">SATUAN</th>
                            <th class="col-harga">HARGA SATUAN <br>(Rp.)</th>
                            <th class="col-total">JUMLAH <br>(Rp.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $no = 1;

                        foreach ($aset as $row):

                            $sum += $row['total_harga'];
                            ?>

                        <tr>
                            <td class="text-center">
                                <?= $no++; ?>
                            </td>
                            <td class="text-center">
                                <img src="<?= base_url('src/img/aset/' . $row['foto_aset']) ?>" alt="Foto Aset"
                                    width="80">
                            </td>
                            <td>
                                <?= $row['kode_aset'] ?>
                            </td>
                            <td>
                                <?= $row['nama_barang'] ?>
                            </td>
                            <td>
                                <?= $row['nama_lokasi'] ?>
                            </td>
                            <td>
                                <?= $row['jenis_bantuan'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['volume'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['satuan'] ?>
                            </td>
                            <td>
                                <?= laporan($row['harga']) ?>
                            </td>
                            <td>
                                <?= laporan($row['total_harga']) ?>
                            </td>
                        </tr>

                        <?php endforeach; ?>

                        <tr>
                            <td colspan="9"><b>Total</b></td>
                            <td><b>
                                    <?= laporan($sum) ?>
                                </b></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-12">

                <table width="100%" class="ttd-table">
                    <tr>
                        <td width="50%" align="left" style="font-family: 'Times New Roman', Times, serif;">
                            Mengetahui,<br>
                            Kepala Sekolah
                            <br><br><br><br><br>

                            <b>Dr. Jayadih, M.Kom</b><br>
                            NIP.
                        </td>

                        <td width="50%" align="right" style="font-family: 'Times New Roman', Times, serif;">
                            Tangerang Selatan,
                            <?= tgl_indo(date('Y-m-d')) ?><br>
                            WK. Sapras
                            <br><br><br><br><br>

                            <b>Abdul Rohman, S.Kom</b><br>
                            NIP.
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <script>
    window.onload = function() {

        window.print();

    };

    window.onafterprint = function() {

        window.location.href = "<?= base_url('laporan/aset') ?>";

    };
    </script>

</body>

</html>