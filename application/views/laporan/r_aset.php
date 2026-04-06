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
              <label>Pilih Jenis Filter</label>
              <select class="form-control" id="filterOption">
                <option value="">-- Pilih Filter --</option>
                <option value="lokasi">Lokasi & Tahun</option>
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
                <select name="id_lokasi" class="form-control">
                  <option value="">-- Pilih Lokasi --</option>

                  <?php foreach ($lokasi as $l) { ?>

                    <option value="<?= $l['id_lokasi'] ?>">
                      <?= $l['nama_lokasi'] ?>
                    </option>

                  <?php } ?>

                </select>
              </div>
              <div class="form-group">
                <label>Sumber Pembelian</label>
                <select name="jenis_bantuan" class="form-control">
                  <option value="">- Pilih Sumber Pembelian --</option>
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


              <div class="form-group">
                <label>Sumber Pembelian</label>
                <select name="jenis_bantuan" class="form-control">
                  <option value="">- Pilih Sumber Pembelian --</option>
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


            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-success">
                Cari Data
              </button>
            </div>

          </form>
        </div>
        <?php if (isset($lok)) { ?>
          <a href="<?= base_url('laporan/print_aset?id_lokasi=' . $this->input->post('id_lokasi') . '&jenis_bantuan=' . $this->input->post('jenis_bantuan')) ?>"
            class="btn btn-danger mt-4">
            <i class="fa fa-print"></i> Print
          </a>
          <a href="<?= base_url('laporan/export_aset?id_lokasi=' . $id_lokasi . '&jenis_bantuan=' . $jenis_bantuan) ?>"
            class="btn btn-success mt-4">
            <i class="fa fa-file"></i> Export Excel
          </a>
        <?php } else { ?>
          <a href="<?= base_url('laporan/print_aset_range/'
                      . $this->input->post('tahun_awal') . '/'
                      . $this->input->post('tahun_akhir'))
                      . '?jenis_bantuan=' . $this->input->post('jenis_bantuan') ?>" class="btn btn-danger mt-4">
            <i class="fa fa-print"></i> Print
          </a>
          <a href="<?= base_url('laporan/export_aset_range/')
                      . $this->input->post('tahun_awal') . '/'
                      . $this->input->post('tahun_akhir')
                      . '?jenis_bantuan=' . $this->input->post('jenis_bantuan') ?>" class="btn btn-success mt-4">
            <i class="fa fa-file"></i> Export Excel
          </a>
        <?php } ?>
        <div class="mt-4">
          <div class="col">
            <?php if (isset($lok)) { ?>

              <b>Lokasi Aset :</b> <?= $lok['nama_lokasi'] ?>

            <?php } elseif (isset($range)) { ?>

              <b>Tahun Perolehan :</b> <?= $range ?>

            <?php } ?>
          </div>
        </div>
        <table class="table table-bordered mt-4">
          <thead>
            <tr>
              <th>NO.</th>
              <th>KODE ASET</th>
              <th>NAMA</th>
              <th>LOKASI</th>
              <th>SUMBER PEMBELIAN</th>
              <th>VOLUME</th>
              <th>SATUAN</th>
              <th>HARGA SATUAN(Rp.)</th>
              <th>JUMLAH (Rp.)</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sum = 0;
            foreach ($aset as $row):
              $sum += $row['total_harga'];
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['kode_aset'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['nama_lokasi'] ?></td>
                <td><?= $row['jenis_bantuan'] ?></td>
                <td><?= $row['volume'] ?></td>
                <td><?= $row['satuan'] ?></td>
                <td><?= laporan($row['harga']) ?></td>
                <td><?= laporan($row['total_harga']) ?></td>
              </tr>
            <?php endforeach ?>
            <tr>
              <td colspan="8"><b>JUMLAH TOTAL</b></td>
              <td><?= laporan($sum); ?></td>
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