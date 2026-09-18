<link rel="stylesheet" href="<?= base_url() ?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notifikasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Notifikas</a></li>
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
                    <!-- FORM UNTUK PRINT BANYAK DATA -->
                    <form action="<?= base_url('') ?>" method="post" target="_blank" id="formPrint">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Aset</th>
                                    <th>Tahun Notifikasi</th>
                                    <th>Jenis Notifikasi</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>

                                <?php if (!empty($notifikasi)) : ?>

                                    <?php foreach ($notifikasi as $row) : ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['kode_aset']); ?></td>
                                            <td><?= htmlspecialchars($row['tahun_notifikasi']); ?></td>
                                            <td><?= htmlspecialchars($row['jenis_notifikasi']); ?></td>
                                            <td><?= htmlspecialchars($row['status']); ?></td>
                                            <td><?= htmlspecialchars($row['tanggal_kirim']); ?></td>
                                            <td><?= htmlspecialchars($row['pesan']); ?></td>
                                        </tr>

                                    <?php endforeach; ?>

                                <?php else : ?>

                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Belum ada data notifikasi terkirim.
                                        </td>
                                    </tr>

                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Aset</th>
                                    <th>Tahun Notifikasi</th>
                                    <th>Jenis Notifikasi</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Pesan</th>
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
            }
        });
    });
</script>