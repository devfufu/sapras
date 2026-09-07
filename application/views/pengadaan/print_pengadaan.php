<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <title>Print Pengadaan</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
        }

        table th {
            width: 200px;
            text-align: left;
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

    <tr>
        <th>Nama</th>
        <td><?=htmlspecialchars($pengadaan['nama_user']);?></td>
    </tr>

    <tr>
        <th>Penempatan</th>
        <td><?=htmlspecialchars($pengadaan['nama_lokasi']);?></td>
    </tr>

    <tr>
        <th>Nama Aset</th>
        <td><?=htmlspecialchars($pengadaan['nama_aset']);?></td>
    </tr>

    <tr>
        <th>Tahun Pengadaan</th>
        <td><?=htmlspecialchars($pengadaan['tahun_pengadaan']);?></td>
    </tr>

    <tr>
        <th>Status</th>

        <td>

            <?php if($pengadaan['status'] == '0'): ?>

                Belum Disetujui

            <?php elseif($pengadaan['status'] == '1'): ?>

                Disetujui

            <?php else: ?>

                Ditolak

            <?php endif; ?>

        </td>

    </tr>

</table>


<script>

window.onload = function() {

    window.print();

};

</script>

</body>
</html>