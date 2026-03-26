<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active">Data Aset</li>
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
        <h3 class="card-title">
          Cari Data Aset
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
            title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
            title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="card">
          <div class="card-body">

            <div class="form-group">
              <label>Pilih Jenis Mode</label>
              <select class="form-control" id="filterOption">
                <option value="">-- Pilih Filter --</option>
                <option value="lokasi">Lokasi</option>
                <option value="range">Range Tahun</option>
              </select>
            </div>

          </div>
        </div>
        <div class="card" id="formLokasi" style="display:none;">
          <div class="card-header bg-primary">
            Filter Berdasarkan Lokasi & Tahun
          </div>

          <form action="<?= base_url('laporan/search_aset') ?>" method="post">

            <div class="card-body">

              <div class="form-group">
                <label>Lokasi</label>
                <select name="id_lokasi" class="form-control" required>
                  <option value="">-- Pilih Lokasi --</option>

                  <?php foreach ($lokasi as $l) { ?>

                    <option value="<?= $l['id_lokasi'] ?>">
                      <?= $l['nama_lokasi'] ?>
                    </option>

                  <?php } ?>

                </select>
              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                Cari Data
              </button>
            </div>

          </form>
        </div>
        <div class="card" id="formRange" style="display:none;">
          <div class="card-header bg-success">
            Filter Berdasarkan Range Tahun
          </div>
          <form action="<?= base_url('laporan/search_asetRange') ?>" method="post">

            <div class="card-body">

              <div class="form-group">
                <label>Dari Tahun</label>
                <select name="tahun_awal" class="form-control" required>

                  <option value="">-- Pilih Tahun Awal --</option>

                  <?php
                  $tahun_sekarang = date('Y');
                  for ($i = $tahun_sekarang; $i >= 2000; $i--) {
                  ?>

                    <option value="<?= $i ?>"><?= $i ?></option>

                  <?php } ?>

                </select>
              </div>

              <div class="form-group">
                <label>Sampai Tahun</label>
                <select name="tahun_akhir" class="form-control" required>

                  <option value="">-- Pilih Tahun Akhir --</option>

                  <?php
                  $tahun_sekarang = date('Y');
                  for ($i = $tahun_sekarang; $i >= 2000; $i--) {
                  ?>

                    <option value="<?= $i ?>"><?= $i ?></option>

                  <?php } ?>

                </select>
              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-success">
                Cari Data
              </button>
            </div>

          </form>
        </div>
        <button type="button" class="btn btn-danger mt-4" disabled>
          <i class="fa fa-print" aria-hidden="true"></i> Print
        </button>
        <button type="button" class="btn btn-success mt-4" disabled>
          <i class="fa fa-file" aria-hidden="true"></i> Export Excel
        </button>
        <table class="table table-bordered mt-4">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Satuan</th>
              <th>Volume</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="5" align="center">Data tidak tersedia.. silahkan cari data</td>
            </tr>
          </tbody>
        </table>
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