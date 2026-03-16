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
</style>

<body>
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-2">
                <img src="<?= base_url() ?>src/img/logo/logo.png" class="kiri" alt="logo">
            </div>

            <div class="col-md-10 text-center judul">
                <h2 style="font-size: 18;">YAYASAN FADILAH</h2>
                <h3>SMK FADILAH</h3>
                <p>Jl. Pendidikan II, Parigi, Kec. Pd. Aren, Kota
                    Tangerang Selatan, Banten 15227
                </p>
            </div>
        </div>
        <hr style="border:1px solid black;">
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
        <div class="row pt-3">
            <div class="col">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>VOLUME</th>
                            <th>SATUAN</th>
                            <th>HARGA SATUAN (Rp.)</th>
                            <th>JUMLAH (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $no  = 1;

                        foreach ($aset as $row):

                            $sum += $row['total_harga'];
                        ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama_barang'] ?></td>
                                <td><?= $row['volume'] ?></td>
                                <td><?= $row['satuan'] ?></td>
                                <td><?= laporan($row['harga']) ?></td>
                                <td><?= laporan($row['total_harga']) ?></td>
                            </tr>

                        <?php endforeach; ?>

                        <tr>
                            <td colspan="5"><b>Total</b></td>
                            <td><b><?= laporan($sum) ?></b></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-12">

                <table width="100%">
                    <tr>
                        <td width="50%" align="left" style="font-family: 'Times New Roman', Times, serif;">
                            Mengetahui,<br>
                            Kepala Sekolah
                            <br><br><br><br><br>

                            <b>D. Jayadih, M.Kom</b><br>
                            NIP.
                        </td>

                        <td width="50%" align="right" style="font-family: 'Times New Roman', Times, serif;">
                            Tangerang Selatan, <?= tgl_indo(date('Y-m-d')) ?><br>
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