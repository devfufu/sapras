<link rel="stylesheet" href="<?= base_url() ?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aset Berwujud</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
                        <li class="breadcrumb-item active">Berwujud</li>
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
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Jenis Mode Tambah</label>
                            <select class="form-control" id="filterOption">
                                <option value="">-- Pilih Mode --</option>
                                <option value="<?= base_url('aset_wujud/tambah') ?>">Tambah Data Lama</option>
                                <option value="<?= base_url('aset_wujud/tambahDataBaru') ?>">Tambah Data Baru</option>
                            </select>
                        </div>
                    </div>
                </div>
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
                <?php if ($this->session->userdata('role') == '1') { ?>
                    <form action="<?= base_url('aset_wujud/filter') ?>" method="POST">
                        <div class="row">
                            <div class="col-3">
                                <select name="id_kategori" class="form-control">
                                    <option value="">- Pilih Kategori --</option>
                                    <?php foreach ($kategori as $row): ?>
                                        <option value="<?= $row['id_kategori']; ?>"><?= $row['kode_kategori']; ?> -
                                            <?= $row['nama_kategori']; ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="tahun_perolehan" class="form-control">
                                    <option value="">- Tahun Perolehan --</option>
                                    <?php
                                    for ($i = 2008; $i <= date('Y'); $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="jenis_bantuan" class="form-control">
                                    <option value="">- Pilih Sumber Dana --</option>
                                    <option value="Yayasan">Yayasan</option>
                                    <option value="Tk">TK</option>
                                    <option value="Sd">SD</option>
                                    <option value="Smk">SMK</option>
                                    <option value="BospTK">BOSP TK</option>
                                    <option value="BospSD">BOSP SD</option>
                                    <option value="BospSMK">BOSP SMK</option>
                                    <option value="Hibah">HIBAH</option>
                                    <option value="hibahUmum">HIBAH UMUM</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="kondisi" class="form-control">
                                    <option value="">- Kondisi --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Renovasi">Renovasi</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="col-3 mt-2">
                                <button type="submit" class="btn btn-block btn-outline-primary">Filter</button>
                            </div>
                            <div class="col-3 mt-2">
                                <button type="submit" class="btn btn-block btn-outline-danger">Reset</button>
                            </div>
                        </div>
                    </form>
                    <form action="<?= base_url('aset_wujud/print_multiple') ?>" method="POST" target="_blank"
                        id="formPrint">
                        <div class="mt-2">
                            <!-- Print Data Terpilih -->
                            <button type="submit" class="btn btn-primary btn-sm" id="btnPrintMultiple"
                                style="display: none;">
                                <i class="fas fa-print"></i> Print Data Terpilih
                            </button>

                            <!-- Pilih Semua -->
                            <button type="button" class="btn btn-secondary btn-sm" id="pilihSemua">
                                <i class="fas fa-check-square"></i> Pilih Semua
                            </button>

                            <!-- Hapus Pilihan -->
                            <button type="button" class="btn btn-warning btn-sm" id="hapusPilihan">
                                <i class="fas fa-times"></i> Hapus Pilihan
                            </button>

                        </div>
                    <?php } ?>
                    <br />
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Kode Aset</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Sumber Pembelian</th>
                                    <th>Volume</th>
                                    <th>Nilai Aset</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($aset as $row): ?>
                                    <tr>
                                        <td><input type="checkbox" name="id_aset[]" value="<?= $row['id_aset']; ?>"
                                                class="checkItem"></td>
                                        <td><?= $no++; ?></td>
                                        <td align="center">
                                            <?php if (!empty($row['foto_aset'])): ?>
                                                <img src="<?= base_url('src/img/aset/' . $row['foto_aset']) ?>" width="60"
                                                    height="60" style="object-fit: cover; cursor:pointer;" data-toggle="modal"
                                                    data-target="#modalFoto" onclick="showFoto(this.src)">
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $row['kode_aset'] ?? '-'; ?></td>
                                        <td><?= $row['nama_barang'] ?? '-'; ?></td>
                                        <td><?= $row['nama_lokasi'] ?? '-'; ?></td>
                                        <td><?= $row['jenis_bantuan'] ?? '-'; ?></td>
                                        <td align="center"><?= $row['volume'] ?? '-'; ?></td>
                                        <td><?= rupiah($row['harga']); ?></td>
                                        <td>
                                            <a href="<?= base_url('aset_wujud/detail/' . $row['id_aset']) ?>"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('aset_wujud/edit/' . $row['id_aset']) ?>"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('aset_wujud/hapus/' . $row['id_aset']) ?>"
                                                class="btn btn-danger btn-sm tombol-hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="<?= base_url('aset_wujud/print/' . $row['id_aset']) ?>"
                                                class="btn btn-primary btn-sm" target="_blank" title="Print">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Kode Aset</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Sumber Pembelian</th>
                                    <th>Volume</th>
                                    <th>Nilai Aset</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body text-center">
                        <img id="imgPreview" src="" style="width:100%; border-radius:10px;">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="<?= base_url() ?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            "language": {
                "sSearch": "Cari"
            }
        });
    });

    document.getElementById("filterOption").addEventListener("change", function () {
        var url = this.value;
        if (url) {
            window.location.href = url;
        }
    });

    function previewImg(src) {
        let win = window.open("");
        win.document.write('<img src="' + src + '" style="width:100%">');
    }

    function showFoto(src) {
        document.getElementById('imgPreview').src = src;
    }

    // ==========================================
    // CEK PILIHAN
    // ==========================================
    function cekPilihan() {

        var jumlah = $('.checkItem:checked').length;

        if (jumlah > 0) {
            $('#btnPrintMultiple').show();
        } else {
            $('#btnPrintMultiple').hide();
        }

    }


    // ==========================================
    // CHECKBOX INDIVIDUAL
    // ==========================================
    $('.checkItem').change(function () {

        cekPilihan();

        var total = $('.checkItem').length;
        var terpilih = $('.checkItem:checked').length;

        $('#checkAll').prop(
            'checked',
            total > 0 && total === terpilih
        );

    });


    // ==========================================
    // CHECK ALL
    // ==========================================
    $('#checkAll').click(function () {

        $('.checkItem').prop(
            'checked',
            $(this).prop('checked')
        );

        cekPilihan();

    });


    // ==========================================
    // PILIH SEMUA
    // ==========================================
    $('#pilihSemua').click(function () {

        $('.checkItem').prop('checked', true);

        $('#checkAll').prop('checked', true);

        cekPilihan();

    });


    // ==========================================
    // HAPUS PILIHAN
    // ==========================================
    $('#hapusPilihan').click(function () {

        $('.checkItem').prop('checked', false);

        $('#checkAll').prop('checked', false);

        cekPilihan();

    });


    // ==========================================
    // VALIDASI PRINT
    // ==========================================
    $('#formPrint').submit(function (e) {

        var jumlah = $('.checkItem:checked').length;

        if (jumlah == 0) {

            e.preventDefault();

            alert('Silakan pilih minimal 1 aset yang ingin dicetak.');

            return false;
        }

    });


    // Kondisi awal
    cekPilihan();
</script>