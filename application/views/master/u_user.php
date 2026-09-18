<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
                        <li class="breadcrumb-item active">Ubah Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data-gagal" data-flashdatagagal="<?= $this->session->flashdata('gagal'); ?>"></div>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Ubah Data</h3>

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
                <form class="form-horizontal" action="<?= base_url('users/update') ?>" method="post" autocomplete="off">

                    <input type="hidden" name="id_user" value="<?= $users['id_user']; ?>">

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Nama User</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nama_user"
                                    value="<?= $users['nama_user']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Username</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="username"
                                    value="<?= $users['username']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <div class="col-sm-6">
                                <label>Ulangi Password</label>
                                <input type="password" class="form-control" name="password_confirm"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Jabatan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="jabatan" value="<?= $users['jabatan']; ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Role</label>
                            <div class="col-sm-12">
                                <select name="role" class="form-control" required>
                                    <option value="1" <?= $users['role'] == 1 ? 'selected' : '' ?>>Administrator
                                    </option>
                                    <option value="2" <?= $users['role'] == 2 ? 'selected' : '' ?>>Manager</option>
                                    <option value="3" <?= $users['role'] == 3 ? 'selected' : '' ?>>Staf</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Lokasi Aset</label>
                            <div class="col-sm-12">
                                <select name="id_lokasi" class="form-control">
                                    <option value="">- Pilih Lokasi Aset -</option>

                                    <?php foreach ($lokasi as $row): ?>
                                        <option value="<?= $row['id_lokasi']; ?>"
                                            <?= (isset($users['id_lokasi']) && $users['id_lokasi'] == $row['id_lokasi']) ? 'selected' : ''; ?>>
                                            <?= $row['nama_lokasi']; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('users') ?>" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
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
<!-- /.content-wrapper -->