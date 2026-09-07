<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Print Data Pengadaan</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
        }

        th {
            text-align: center;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {

            .no-print {
                display: none;
            }

        }

    </style>

</head>

<body>

<div class="no-print">

    <button onclick="window.print()">
        🖨️ Print
    </button>

</div>


<h2>DATA PENGADAAN ASET</h2>


<table>

    <thead>

        <tr>

            <th>No.</th>

            <th>Nama</th>

            <th>Penempatan</th>

            <th>Nama Aset</th>

            <th>Tahun</th>

            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        <?php $no = 1; ?>

        <?php foreach($pengadaan as $row): ?>

        <tr>

            <td align="center">
                <?=$no++;?>
            </td>

            <td>
                <?=htmlspecialchars($row['nama_user']);?>
            </td>

            <td>
                <?=htmlspecialchars($row['nama_lokasi']);?>
            </td>

            <td>
                <?=htmlspecialchars($row['nama_aset']);?>
            </td>

            <td align="center">
                <?=htmlspecialchars($row['tahun_pengadaan']);?>
            </td>

            <td>

                <?php if($row['status'] == '0'): ?>

                    Belum Disetujui

                <?php elseif($row['status'] == '1'): ?>

                    Disetujui

                <?php else: ?>

                    Ditolak

                <?php endif; ?>

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