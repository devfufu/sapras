<link rel="stylesheet" href="<?= base_url() ?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengadaan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pengadaan</a></li>
                        <li class="breadcrumb-item active">Lihat Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('sukses'); ?>"></div>
    <div class="flash-data-gagal" data-flashdatagagal="<?= $this->session->flashdata('gagal'); ?>"></div>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Data Pengadaan Aset
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <?php if ($this->session->userdata('role') == '1' || $this->session->userdata('role') == '2'): ?>
                <form action="<?= base_url('pengadaan/filter') ?>" method="POST" autocomplete="off">
                    <div class="row">

                        <div class="col-4">
                            <select name="id_lokasi" class="form-control">
                                <option value="">- Pilih Lokasi -</option>

                                <?php foreach ($lokasi as $row): ?>
                                <option value="<?= $row['id_lokasi']; ?>"
                                    <?= (!empty($filter['id_lokasi']) && $filter['id_lokasi'] == $row['id_lokasi']) ? 'selected' : ''; ?>>
                                    <?= $row['nama_lokasi']; ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-4">
                            <select name="tahun_pengadaan" class="form-control">
                                <option value="">- Pilih Tahun -</option>

                                <?php for ($tahun = 2008; $tahun <= date('Y'); $tahun++): ?>
                                <option value="<?= $tahun; ?>"
                                    <?= (!empty($filter['tahun_pengadaan']) && $filter['tahun_pengadaan'] == $tahun) ? 'selected' : ''; ?>>
                                    <?= $tahun; ?>
                                </option>
                                <?php endfor; ?>

                            </select>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-block btn-outline-primary">
                                Filter
                            </button>
                        </div>


                        <div class="col">
                            <button type="button" class="btn btn-block btn-outline-danger"
                                onclick="resetFilterPengadaan()">
                                Reset
                            </button>
                        </div>

                    </div>
                </form>
                <br />
                <?php endif ?>
                <div class="table-responsive">

                    <!-- FORM UNTUK PRINT BANYAK DATA -->
                    <form action="<?= base_url('pengadaan/print_multiple') ?>" method="post" target="_blank"
                        id="formPrint">

                        <div class="mb-3">

                            <!-- PROSES DATA TERPILIH -->
                            <?php if ($this->session->userdata('role') == '1'): ?>
                            <button type="button" class="btn btn-primary btn-sm" id="btnProsesMultiple"
                                style="display: none;">
                                <i class="fa fa-play"></i> Proses Data Terpilih
                            </button>
                            <?php endif; ?>

                            <!-- SETUJUI DATA TERPILIH -->
                            <?php if ($this->session->userdata('role') == '1'): ?>
                            <button type="button" class="btn btn-success btn-sm" id="btnSetujuiMultiple"
                                style="display: none;">
                                <i class="fa fa-check"></i> Setujui Data Terpilih
                            </button>

                            <!-- TOLAK DATA TERPILIH -->
                            <button type="button" class="btn btn-danger btn-sm" id="btnTolakMultiple"
                                style="display: none;">
                                <i class="fa fa-times"></i> Tolak Data Terpilih
                            </button>
                            <?php endif; ?>

                            <!-- PRINT -->
                            <button type="submit" class="btn btn-info btn-sm" id="btnPrintMultiple"
                                style="display: none;">
                                <i class="fas fa-print"></i> Print Data Terpilih
                            </button>

                            <!-- PILIH SEMUA -->
                            <button type="button" class="btn btn-secondary btn-sm" id="pilihSemua">
                                <i class="fas fa-check-square"></i> Pilih Semua
                            </button>

                            <!-- HAPUS PILIHAN -->
                            <button type="button" class="btn btn-warning btn-sm" id="hapusPilihan">
                                <i class="fas fa-times"></i> Hapus Pilihan
                            </button>

                        </div>

                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th width="40">
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Penempatan</th>
                                    <th>Nama Aset</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Sifat Pengadaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if ($this->session->userdata('role') == '1' || $this->session->userdata('role') == '2'): ?>

                                <?php $no = 1;
                                    foreach ($item as $row): ?>

                                <tr>

                                    <!-- CHECKBOX -->
                                    <td>
                                        <input type="checkbox" name="id_pengadaan[]"
                                            value="<?= $row['id_pengadaan']; ?>" data-status="<?= $row['status']; ?>"
                                            class="checkItem">
                                    </td>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['nama_user']; ?></td>

                                    <td><?= $row['nama_lokasi']; ?></td>

                                    <td><?= $row['nama_aset']; ?></td>

                                    <td><?= $row['tahun_pengadaan']; ?></td>

                                    <td>

                                        <?php $role = $this->session->userdata('role'); ?>

                                        <?php if ($role == '1'): ?>

                                        <!-- ================================= -->
                                        <!-- ADMINISTRATOR / ROLE 1 -->
                                        <!-- ================================= -->

                                        <?php if ($row['status'] == '0'): ?>

                                        <a class="btn btn-primary btn-sm"
                                            href="<?= base_url('pengadaan/proses/' . $row['id_pengadaan']) ?>">
                                            <i class="fa fa-play"></i> Proses
                                        </a>

                                        <?php elseif ($row['status'] == '1'): ?>

                                        <span class="badge badge-info">
                                            Diproses
                                        </span>

                                        <a class="btn btn-success btn-sm"
                                            href="<?= base_url('pengadaan/setujuiPengadaan/' . $row['id_pengadaan']) ?>">
                                            <i class="fa fa-check"></i> Setuju
                                        </a>

                                        <a class="btn btn-danger btn-sm"
                                            href="<?= base_url('pengadaan/tolakPengadaan/' . $row['id_pengadaan']) ?>">
                                            <i class="fa fa-times"></i> Tolak
                                        </a>


                                        <?php elseif ($row['status'] == '2'): ?>

                                        <span class="badge badge-success">
                                            Disetujui
                                        </span>

                                        <?php elseif ($row['status'] == '3'): ?>

                                        <span class="badge badge-danger">
                                            Ditolak
                                        </span>

                                        <?php endif; ?>


                                        <?php elseif ($role == '2'): ?>

                                        <!-- ================================= -->
                                        <!-- MANAGER / ROLE 2 -->
                                        <!-- ================================= -->

                                        <?php if ($row['status'] == '0'): ?>

                                        <span class="badge badge-secondary">
                                            Belum Diproses
                                        </span>

                                        <?php elseif ($row['status'] == '1'): ?>

                                        <span class="badge badge-warning">
                                            Menunggu
                                        </span>

                                        <?php elseif ($row['status'] == '2'): ?>

                                        <span class="badge badge-success">
                                            Disetujui
                                        </span>

                                        <?php elseif ($row['status'] == '3'): ?>

                                        <span class="badge badge-danger">
                                            Ditolak
                                        </span>

                                        <?php endif; ?>

                                        <?php endif; ?>

                                    </td>
                                    <td><?= $row['sifat_pengadaan']; ?></td>

                                    <td>

                                        <!-- DETAIL -->
                                        <a href="<?= base_url('pengadaan/detail/' . $row['id_pengadaan']) ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if ($this->session->userdata('role') == '1'): ?>
                                        <!-- PRINT SATU DATA -->
                                        <a href="<?= base_url('pengadaan/print/' . $row['id_pengadaan']) ?>"
                                            class="btn btn-info btn-sm" target="_blank" title="Print">
                                            <i class="fas fa-print"></i>
                                        </a>

                                        <!-- HAPUS -->
                                        <a href="<?= base_url('pengadaan/hapus/' . $row['id_pengadaan']) ?>"
                                            class="btn btn-danger btn-sm tombol-hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <?php endif ?>
                                    </td>

                                </tr>

                                <?php endforeach ?>

                                <?php else: ?>

                                <?php $no = 1;
                                    foreach ($item_user as $row): ?>

                                <tr>

                                    <td>
                                        <input type="checkbox" name="id_pengadaan[]"
                                            value="<?= $row['id_pengadaan']; ?>" class="checkItem">
                                    </td>

                                    <td><?= $no++; ?></td>

                                    <td><?= $row['nama_user']; ?></td>

                                    <td><?= $row['nama_lokasi']; ?></td>

                                    <td><?= $row['nama_aset']; ?></td>

                                    <td><?= $row['tahun_pengadaan']; ?></td>

                                    <td>

                                        <?php if ($row['status'] == '0') { ?>

                                        <span class="badge badge-secondary">
                                            Belum Diproses
                                        </span>

                                        <?php } elseif ($row['status'] == '1') { ?>

                                        <span class="badge badge-warning">
                                            Menunggu
                                        </span>

                                        <?php } elseif ($row['status'] == '2') { ?>

                                        <span class="badge badge-success">
                                            Disetujui
                                        </span>

                                        <?php } elseif ($row['status'] == '3') { ?>

                                        <span class="badge badge-danger">
                                            Ditolak
                                        </span>

                                        <?php } ?>

                                    </td>

                                    <td>

                                        <!-- DETAIL -->
                                        <a href="<?= base_url('pengadaan/detail/' . $row['id_pengadaan']) ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if ($this->session->userdata('role') == '1'): ?>
                                        <!-- PRINT -->
                                        <a href="<?= base_url('pengadaan/print/' . $row['id_pengadaan']) ?>"
                                            class="btn btn-info btn-sm" target="_blank" title="Print">
                                            <i class="fas fa-print"></i>
                                        </a>

                                        <!-- HAPUS -->
                                        <a href="<?= base_url('pengadaan/hapus/' . $row['id_pengadaan']) ?>"
                                            class="btn btn-danger btn-sm tombol-hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <?php endif ?>
                                    </td>

                                </tr>

                                <?php endforeach ?>

                                <?php endif ?>

                            </tbody>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Penempatan</th>
                                    <th>Nama Aset</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Sifat Pengadaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>

                        </table>

                    </form>

                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<script src="<?= base_url() ?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
$(function() {
    $("#example1").DataTable({
        "language": {
            "sSearch": "Cari"
        },
        "stateSave": true,
        "stateDuration": -1
    });
});

function resetFilterPengadaan() {

    // Hapus state DataTables
    if ($.fn.DataTable.isDataTable('#example1')) {
        $('#example1').DataTable().state.clear();
    }

    // Hapus filter session
    window.location.href = "<?= base_url('pengadaan/reset_filter'); ?>";
}

$(document).ready(function() {
    function cekPilihan() {

        var checked = $('.checkItem:checked');

        var jumlah = checked.length;

        // Sembunyikan semua tombol aksi terlebih dahulu
        $('#btnProsesMultiple').hide();
        $('#btnSetujuiMultiple').hide();
        $('#btnTolakMultiple').hide();
        $('#btnPrintMultiple').hide();

        if (jumlah === 0) {
            return;
        }

        // Ambil status semua data yang dicentang
        var semuaStatus = [];

        checked.each(function() {
            semuaStatus.push($(this).data('status').toString());
        });

        // Cek apakah semua status sama
        var statusPertama = semuaStatus[0];

        var statusSama = semuaStatus.every(function(status) {
            return status === statusPertama;
        });

        // Kalau status campuran
        if (!statusSama) {
            return;
        }

        if (statusPertama === '0') {

            $('#btnProsesMultiple').show();

        } else if (statusPertama === '1') {

            $('#btnSetujuiMultiple').show();
            $('#btnTolakMultiple').show();

        }

        $('#btnPrintMultiple').show();
    }

    $('#btnProsesMultiple').click(function() {

        var ids = $('.checkItem:checked').map(function() {
            return $(this).val();
        }).get();

        if (ids.length === 0) {
            alert('Silakan pilih data terlebih dahulu.');
            return;
        }

        if (!confirm(
                'Apakah Anda yakin ingin memproses ' +
                ids.length +
                ' data pengadaan?'
            )) {
            return;
        }

        kirimAksiMultiple(
            "<?= base_url('pengadaan/proses_multiple'); ?>",
            ids
        );
    });

    function kirimAksiMultiple(url, ids) {

        var form = $('<form>', {
            method: 'POST',
            action: url
        });

        $.each(ids, function(index, id) {

            $('<input>', {
                type: 'hidden',
                name: 'id_pengadaan[]',
                value: id
            }).appendTo(form);

        });

        form.appendTo('body');
        form.submit();
    }


    $('#btnSetujuiMultiple').click(function() {

        var ids = $('.checkItem:checked').map(function() {
            return $(this).val();
        }).get();

        if (ids.length === 0) {
            alert('Silakan pilih data terlebih dahulu.');
            return;
        }

        if (!confirm(
                'Apakah Anda yakin ingin menyetujui ' +
                ids.length +
                ' data pengadaan?'
            )) {
            return;
        }

        kirimAksiMultiple(
            "<?= base_url('pengadaan/setujui_multiple'); ?>",
            ids
        );
    });


    $('#btnTolakMultiple').click(function() {

        var ids = $('.checkItem:checked').map(function() {
            return $(this).val();
        }).get();

        if (ids.length === 0) {
            alert('Apakah Anda yakin ingin menolak ' +
                ids.length +
                ' data pengadaan?');
            return;
        }

        if (!confirm(
                'Apakah Anda yakin ingin menolak ' +
                ids.length +
                ' data pengadaan?'
            )) {
            return;
        }

        kirimAksiMultiple(
            "<?= base_url('pengadaan/tolak_multiple'); ?>",
            ids
        );
    });

    $('.checkItem').change(function() {

        // Cek tombol print
        cekPilihan();

        // Cek apakah semua checkbox terpilih
        var total = $('.checkItem').length;
        var terpilih = $('.checkItem:checked').length;

        $('#checkAll').prop(
            'checked',
            total > 0 && total === terpilih
        );

    });

    $('#checkAll').click(function() {

        $('.checkItem').prop(
            'checked',
            $(this).prop('checked')
        );

        // Tampilkan / sembunyikan tombol print
        cekPilihan();

    });

    $('#pilihSemua').click(function() {

        $('.checkItem').prop('checked', true);

        $('#checkAll').prop('checked', true);

        // Tampilkan tombol print
        cekPilihan();

    });


    $('#hapusPilihan').click(function() {

        $('.checkItem').prop('checked', false);

        $('#checkAll').prop('checked', false);

        // Sembunyikan tombol print
        cekPilihan();

    });

    $('#formPrint').submit(function(e) {

        var jumlah = $('.checkItem:checked').length;

        if (jumlah == 0) {

            e.preventDefault();

            alert('Silakan pilih minimal 1 data yang ingin dicetak.');

            return false;
        }

    });

    cekPilihan();

});
</script>