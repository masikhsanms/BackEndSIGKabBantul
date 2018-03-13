<?php 
require_once('config/koneksi.php');
require_once('model/database.php');

$connection = new Database ($host, $user, $pass, $database);


$sql = mysqli_query($connection->con, "SELECT id From tb_wisata WHERE kategori ='1'");
$hasil = mysqli_num_rows($sql);

$sql1 = mysqli_query($connection->con, "SELECT id From tb_wisata WHERE kategori ='2'");
$hasil1 = mysqli_num_rows($sql1);

$sql2 = mysqli_query($connection->con, "SELECT id From tb_hotel");
$hasil2 = mysqli_num_rows($sql2);

$sql3 = mysqli_query($connection->con, "SELECT id From tb_resto");
$hasil3 = mysqli_num_rows($sql3);

?>
	
	<div class="row">
		<div class="col-lg-12">
			<h1>Dashboard <small>Admin</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-dashboard"></i></a></li>
				<li><a href=""></i>Dashboard</a></li>
				<li class="active">Dashboard</li>
			</ol>
      <div class="text-center">
            <img src="assets/img/gambar/bantul.jpg" class="rounded" alt="gambar" width="304" height="100">
      </div>
<br>
      <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              	<b>Selamat Datang di Administrator Sistem Infromasi Geografi Wisata Alam di Kabupaten Bantul</b>
            </div>
		</div>
</div> <!-- ROW -->

	<!-- <div class="row">
		<div class="col-lg-12">
			<h1 style="text-align: center; font-style: bold;">Selamat Datang Di Halaman Administrator</h1>
		</div>
	</div> -->

 <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-map-marker fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?php echo $hasil; ?></p>
                    <p class="announcement-text">Jumlah Wisata Alam</p>
                  </div>
                </div>
              </div>
              <a href="?page=wisata">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Data Wisata Alam
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-home fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?php echo $hasil1; ?></p>
                    <p class="announcement-text">Jumlah Desa Wisata</p>
                  </div>
                </div>
              </div>
              <a href="?page=desawisata">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Data Desa Wisata
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-h-square fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?php echo $hasil2 ?></p>
                    <p class="announcement-text">Jumlah Data Hotel</p>
                  </div>
                </div>
              </div>
              <a href="?page=hotel">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                      Data Hotel
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-cutlery fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?php echo $hasil3; ?></p>
                    <p class="announcement-text">Jumlah Data Restoran</p>
                  </div>
                </div>
              </div>
              <a href="?page=restoran">
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-6">
                     Data Restoran
                    </div>
                    <div class="col-xs-6 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div><!-- /.row -->

