<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pengadaan</a></li>
            <li class="breadcrumb-item active">Lihat Data</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('sukses');?>"></div>
  <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          Data Pengadaan Aset
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
        </div>
          <div class="card-body">
            <?php if ($this->session->userdata('role')=='1' || $this->session->userdata('role')=='2'): ?>
            <form action="<?=base_url('pengadaan/filter')?>" method="POST" autocomplete="off">
              <div class="row">
                <div class="col-4">
                  <select name="id_lokasi" class="form-control" required>
                    <option value="">- Pilih Lokasi --</option>
                    <?php foreach ($lokasi as $row): ?>
                      <option value="<?=$row['id_lokasi'];?>"><?=$row['nama_lokasi'];?></option>
                    <?php endforeach ?>      
                  </select>
                </div>
                <div class="col-4">
                  <input type="text" name="tahun_pengadaan" class="form-control" placeholder="Tahun Pengadaan" required>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-block btn-outline-primary">Filter</button>
                </div>
                <div class="col">
                  <button type="reset" class="btn btn-block btn-outline-danger">Reset</button>
                </div>              
              </div>
            </form> 
            <br/> 
            <?php endif ?>
            <div class="table-responsive">

        <!-- FORM UNTUK PRINT BANYAK DATA -->
        <form action="<?=base_url('pengadaan/print_multiple')?>" method="post" target="_blank" id="formPrint">

            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-sm" id="btnPrintMultiple" style="display: none;">
                    <i class="fas fa-print"></i> Print Data Terpilih
                </button>

                <button type="button" class="btn btn-secondary btn-sm" id="pilihSemua">
                    <i class="fas fa-check-square"></i> Pilih Semua
                </button>

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
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($this->session->userdata('role')=='1' || $this->session->userdata('role')=='2'): ?>

                    <?php $no=1; foreach ($item as $row): ?>

                    <tr>

                        <!-- CHECKBOX -->
                        <td>
                            <input 
                                type="checkbox" 
                                name="id_pengadaan[]" 
                                value="<?=$row['id_pengadaan'];?>"
                                class="checkItem">
                        </td>

                        <td><?=$no++;?></td>

                        <td><?=$row['nama_user'];?></td>

                        <td><?=$row['nama_lokasi'];?></td>

                        <td><?=$row['nama_aset'];?></td>

                        <td><?=$row['tahun_pengadaan'];?></td>

                        <td>

                            <?php if ($row['status']=='0'): ?>

                                <a class="btn btn-primary btn-sm"
                                href="<?=base_url('pengadaan/setujui/'.$row['id_pengadaan'])?>">
                                    <i class="fa fa-check"></i> Setujui
                                </a>

                                <a class="btn btn-danger btn-sm"
                                href="<?=base_url('pengadaan/tolak/'.$row['id_pengadaan'])?>">
                                    <i class="fa fa-times"></i> Tolak
                                </a>

                            <?php else: ?>

                                <?php if ($row['status']=='1'): ?>

                                    <span class="badge badge-success">
                                        Disetujui
                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-danger">
                                        Ditolak
                                    </span>

                                <?php endif ?>

                            <?php endif ?>

                        </td>

                        <td>

                            <!-- DETAIL -->
                            <a href="<?=base_url('pengadaan/detail/'.$row['id_pengadaan'])?>"
                            class="btn btn-success btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- PRINT SATU DATA -->
                            <a href="<?=base_url('pengadaan/print/'.$row['id_pengadaan'])?>"
                            class="btn btn-info btn-sm"
                            target="_blank"
                            title="Print">
                                <i class="fas fa-print"></i>
                            </a>

                            <!-- HAPUS -->
                            <a href="<?=base_url('pengadaan/hapus/'.$row['id_pengadaan'])?>"
                            class="btn btn-danger btn-sm tombol-hapus">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>

                    </tr>

                    <?php endforeach ?>

                <?php else: ?>

                    <?php $no=1; foreach ($item_user as $row): ?>

                    <tr>

                        <!-- CHECKBOX -->
                        <td>
                            <input 
                                type="checkbox" 
                                name="id_pengadaan[]" 
                                value="<?=$row['id_pengadaan'];?>"
                                class="checkItem">
                        </td>

                        <td><?=$no++;?></td>

                        <td><?=$row['nama_user'];?></td>

                        <td><?=$row['nama_lokasi'];?></td>

                        <td><?=$row['nama_aset'];?></td>

                        <td><?=$row['tahun_pengadaan'];?></td>

                        <td>

                            <?php if ($row['status']=='0'){ ?>

                                <span class="badge badge-danger">
                                    Belum Disetujui
                                </span>

                            <?php }else if ($row['status']=='1'){ ?>

                                <span class="badge badge-success">
                                    Disetujui
                                </span>

                            <?php }else{ ?>

                                <span class="badge badge-danger">
                                    Ditolak
                                </span>

                            <?php } ?>

                        </td>

                        <td>

                            <!-- DETAIL -->
                            <a href="<?=base_url('pengadaan/detail/'.$row['id_pengadaan'])?>"
                            class="btn btn-success btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- PRINT SATU DATA -->
                            <a href="<?=base_url('pengadaan/print/'.$row['id_pengadaan'])?>"
                            class="btn btn-info btn-sm"
                            target="_blank"
                            title="Print">
                                <i class="fas fa-print"></i>
                            </a>

                            <!-- HAPUS -->
                            <a href="<?=base_url('pengadaan/hapus/'.$row['id_pengadaan'])?>"
                            class="btn btn-danger btn-sm tombol-hapus">
                                <i class="fas fa-trash"></i>
                            </a>

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
<script src="<?=base_url()?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
$(function () {
    $("#example1").DataTable({
        "language": {
            "sSearch": "Cari"
        }
    });
});

$(document).ready(function(){

    // ==========================================
    // FUNGSI SHOW / HIDE TOMBOL PRINT
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
    $('.checkItem').change(function(){

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


    // ==========================================
    // CHECK ALL
    // ==========================================
    $('#checkAll').click(function(){

        $('.checkItem').prop(
            'checked',
            $(this).prop('checked')
        );

        // Tampilkan / sembunyikan tombol print
        cekPilihan();

    });


    // ==========================================
    // PILIH SEMUA
    // ==========================================
    $('#pilihSemua').click(function(){

        $('.checkItem').prop('checked', true);

        $('#checkAll').prop('checked', true);

        // Tampilkan tombol print
        cekPilihan();

    });


    // ==========================================
    // HAPUS SEMUA PILIHAN
    // ==========================================
    $('#hapusPilihan').click(function(){

        $('.checkItem').prop('checked', false);

        $('#checkAll').prop('checked', false);

        // Sembunyikan tombol print
        cekPilihan();

    });


    // ==========================================
    // VALIDASI SEBELUM PRINT
    // ==========================================
    $('#formPrint').submit(function(e){

        var jumlah = $('.checkItem:checked').length;

        if(jumlah == 0){

            e.preventDefault();

            alert('Silakan pilih minimal 1 data yang ingin dicetak.');

            return false;
        }

    });


    // ==========================================
    // KONDISI AWAL
    // ==========================================
    cekPilihan();

});
</script>

