<link rel="stylesheet" href="<?= base_url() ?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Print Aset</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Print Aset</a></li>
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
                    Data Notifikasi Terkirim
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
                <br />
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Kode Aset</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Sumber Pembelian</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>

                            <?php foreach ($aset as $row) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <?php if (!empty($row['foto_aset'])) : ?>
                                            <img src="<?= base_url('src/img/aset/' . $row['foto_aset']); ?>" width="70"
                                                height="70" style="object-fit: cover;">
                                        <?php else : ?>
                                            <span>Tidak ada foto</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $row['kode_aset']; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td><?= $row['nama_lokasi']; ?></td>
                                    <td><?= $row['jenis_bantuan']; ?></td>
                                    <td><?= $row['volume']; ?></td>
                                    <td><?= $row['satuan']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Kode Aset</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Sumber Pembelian</th>
                                <th>Volume</th>
                                <th>Satuan</th>
                            </tr>
                        </tfoot>
                    </table>
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
            }
        });
    });
</script>