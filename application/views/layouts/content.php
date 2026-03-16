  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- Breadcumb Saya Hapus
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><
        </div>
      </div>
      -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!--
        <div class="alert alert-info">
            <h5> 
              <?php

              date_default_timezone_set("Asia/Jakarta");

              $b = time();
              $hour = date("G",$b);

              if ($hour>=0 && $hour<=11){
                echo '<i class="icon fas fa-cloud-sun"></i>';
                echo " Selamat Pagi.. ".$this->session->userdata('nama_user');
              } else if ($hour >=12 && $hour<=14){
                echo '<i class="icon far fa-sun"></i>';
                echo " Selamat Siang.. ".$this->session->userdata('nama_user');
              } else if ($hour >=15 && $hour<=17){
                echo '<i class="icon far fa-sun"></i>';
                echo " Selamat Sore.. ".$this->session->userdata('nama_user');
              } else if ($hour >=17 && $hour<=18){
                echo '<i class="icon fas fa-cloud"></i>';
                echo " Selamat Petang.. ".$this->session->userdata('nama_user');
              } else if ($hour >=19 && $hour<=23){
                echo '<i class="icon fas fa-cloud-moon"></i>';
                echo " Selamat Malam.. ".$this->session->userdata('nama_user');
              }

              ?>

            </h5>
            Selamat Datang di Website Sistem Informasi Manajemen Aset 
          </div>
          -->
          <?php if ($this->session->userdata('role')=='1' || $this->session->userdata('role')=='2'): ?>
          <div class="row">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?=$wujud+$hapuskan;?></h3>

                  <p>Total Aset</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-home"></i>
                </div>
                <a href="#" class="small-box-footer">Aset Berwujud + Dihapuskan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?=$wujud;?></h3>

                  <p>Aset Berwujud</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-desktop"></i>
                </div>
                <a href="<?=base_url('aset_wujud')?>" class="small-box-footer">Selengkapnya 
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?=$hapuskan;?></h3>

                  <p>Aset Dihapuskan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-trash-a"></i>
                </div>
                <a href="<?=base_url('aset_dihapuskan')?>" class="small-box-footer">Selengkapnya 
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <?php endif ?>
        <!-- Small boxes (Stat box) -->
        <!-- /.row (main row) -->
        <img src="<?=base_url('src/aset.jpg')?>" width="100%" />
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->