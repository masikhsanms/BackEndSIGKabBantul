<?php 
include "model/m_wisata.php";

$wst = new Wisata($connection);

if (@$_GET['act'] == '') {
 ?>

<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdu9p4CbPXXQDJyqaKdZLv_uYT8eDE8k4&sensor=false&callback=initialise"></script>

<div class="row">
		<div class="col-lg-12">
			<h1>Wisata di Bantul <small>Data Wisata Alam dan Budaya Bantul</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i></a></li>
				<li><a href=""></i>Wisata</a></li>
				<li class="active">Data Wisata</li>
			</ol>
		</div>
</div> <!-- ROW -->

	<button  style="margin-bottom: 20px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="datatable">

					<thead>
					<tr>
						<th>No</th>
						<th>Nama wisata</th>
<!-- 						<th>Keterangan</th>
 -->					<th>Alamat</th>
						<th>Fasilitas</th>
						<th>Tiket</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Gambar</th>
						<th>Gambar</th>
						<th>Gambar</th>
						<th>Aksi</th>
					</tr>
					</thead>
					<tbody>
							<?php 
								$no = 1;
								$tampil = $wst->tampil();

								while ($data =$tampil->fetch_object()) {
							 ?>
							<tr>
								<td align="center"><?php echo $no++; ?></td>
								<td><?php echo $data->nama; ?></td>
<!-- 								<td><?php //echo $data->keterangan; ?></td>
 -->							<td><?php echo $data->alamat; ?></td>
								<td><?php echo $data->fasilitas; ?></td>
								<td><?php echo $data->tiket; ?></td>
								<td><?php echo $data->latt; ?></td>
								<td><?php echo $data->longi; ?></td>
								<td align="center">
									<img src="assets/img/wisata/<?php echo $data->gbr1; ?>" width ="50px">
								</td>
								<td align="center">
									<img src="assets/img/wisata/<?php echo $data->gbr2; ?>" width ="50px">
								</td>
								<td align="center">
									<img src="assets/img/wisata/<?php echo $data->gbr3; ?>" width ="50px">
								</td>
								<td align="center">
									<a id="edit_wisata" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-kategori="<?php echo $data->kategori; ?>" data-nama="<?php echo $data->nama; ?>" data-keterangan="<?php echo $data->keterangan; ?>" data-alamat="<?php echo $data->alamat; ?>" data-fasilitas="<?php echo $data->fasilitas; ?>" data-tiket="<?php echo $data->tiket; ?>" data-latt="<?php echo $data->latt; ?>" data-longi="<?php echo $data->longi; ?>" data-gbr1="<?php echo $data->gbr1; ?>" data-gbr2="<?php echo $data->gbr2; ?>" data-gbr3="<?php echo $data->gbr3; ?>">
										<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
									</a>
									<a href="?page=wisata&act=del&id=<?php echo $data->id; ?>" onclick="return confirm('Yakin anda Menghapus Data ini?')">
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
									</a>
								</td>
							</tr>
							<?php } ?>
					</tbody>
				</table>
			</div>

				<!-- Membuat pop up tambah data -->
				
				<div id="tambah" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Tambah Data wisata</h4>
							</div>
							<form method="post" enctype="multipart/form-data">
								<div class="modal-body">
									 <select class="form-control" name="kat" id="kat" requireds>
									 	<option selected>Pilih Kategori</option>
								        <option value="1">Wisata Alam</option>
								        <option value="2">Desa Wisata</option>
								    </select>
								<!-- <div class="form-group">
									<label class="control-label" for="kat">Kategori</label>
									<input type="number" name="kat" class="form-control" id="kat" required>
									</div> -->
								<div class="form-group">
									<label class="control-label" for="nm_wisata">Nama Wisata</label>
									<input type="text" name="nm_wisata" class="form-control" id="nm_wisata" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="ket_wisata">Keterangan</label>
									<textarea cols="8" rows="5" type="text" name="ket_wisata" class="form-control" id="ket_wisata" ></textarea>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_alamat">Alamat</label>
									<input type="text" name="nm_alamat" class="form-control" id="nm_alamat" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_fasilitas">Fasilitas</label>
									<input type="text" name="nm_fasilitas" class="form-control" id="nm_fasilitas" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_tiket">Tiket</label>
									<input type="text" name="nm_tiket" class="form-control" id="nm_tiket" required>
									</div>
								<div id="map" style="width:500px;height: 300px;"></div>
								<div class="form-group">
									<label class="control-label" for="lat">Latitude</label>
									<input type="text" name="lat" class="form-control" id="lat" >
									</div>
								<div class="form-group">
									<label class="control-label" for="lng">Longitude</label>
									<input type="text" name="lng" class="form-control" id="lng" >
									</div>

								<div class="form-group">
									<label class="control-label" for="gbr_one">Gambar</label>
									<input type="file" name="gbr_one" class="form-control" id="gbr_one">
									</div>
								<div class="form-group">
									<label class="control-label" for="gbr_two">Gambar</label>
									<input type="file" name="gbr_two" class="form-control" id="gbr_two">
									</div>
								<div class="form-group">
									<label class="control-label" for="gbr_three">Gambar</label>
									<input type="file" name="gbr_three" class="form-control" id="gbr_three">
									</div>
								</div>

								<div class="modal-footer">
									<button type="reset" class="btn btn-danger">Reset</button>
									<input type="submit" class="btn btn-success" name="tambah" value="Simpan"></input>
								</div>
							</form> <!-- Membuat pop up tambah data -->
							
							<!-- logika pop up tambah data -->
							<?php 
							if (@$_POST['tambah']) {

								$kat = $connection->con->real_escape_string($_POST['kat']);				
								$nm_wisata = $connection->con->real_escape_string($_POST['nm_wisata']);
								$ket_wisata = $connection->con->real_escape_string($_POST['ket_wisata']);
								$nm_alamat = $connection->con->real_escape_string($_POST['nm_alamat']);
								$nm_fasilitas = $connection->con->real_escape_string($_POST['nm_fasilitas']);
								$nm_tiket = $connection->con->real_escape_string($_POST['nm_tiket']);

								$lat = $connection->con->real_escape_string($_POST['lat']);
								$lng = $connection->con->real_escape_string($_POST['lng']);
			
								//ambil data gambar dengan penamaan
								$extensi = explode(".", $_FILES['gbr_one']['name']);
								$gbr_one = "wst1-".round(microtime(true)).".".end($extensi);
								$sumber = $_FILES['gbr_one']['tmp_name'];
								$upload = move_uploaded_file($sumber, "assets/img/wisata/".$gbr_one);
								// die(var_dump($upload));
								//ambil data gambar dengan penamaan
								$extensi1 = explode(".", $_FILES['gbr_two']['name']);
								$gbr_two = "wst2-".round(microtime(true)).".".end($extensi1);
								$sumber1 = $_FILES['gbr_two']['tmp_name'];
								$upload1 = move_uploaded_file($sumber1, "assets/img/wisata/".$gbr_two);

								$extensi2 = explode(".", $_FILES['gbr_three']['name']);
								$gbr_three = "wst3-".round(microtime(true)).".".end($extensi2);
								$sumber2 = $_FILES['gbr_three']['tmp_name'];
								$upload2 = move_uploaded_file($sumber2, "assets/img/wisata/".$gbr_three);

								if ($upload) {
									$wst->tambah($kat,$nm_wisata,$ket_wisata,$nm_alamat,$nm_fasilitas,$nm_tiket,$lat,$lng,$gbr_one,$gbr_two,$gbr_three);
									echo "<script>window.location='?page=wisata';</script>";
								}else{
									echo "<script>alert('uploud gambar gagal')</script>";
								}

								

								}
							 ?>
							 <!-- logika pop up tambah data -->
						</div>
					</div>
				</div>

<script>
    document.getElementById('reset').onclick= function() {
        var field1= document.getElementById('lng');
 		var field2= document.getElementById('lat');
        if(typeof field1 !== 'undefined' && field1 !== null || typeof field2 !== 'undefined' && field2 != null) {
        field1.value= field1.defaultValue;
 field2.value= field2.defaultValue;
}
    };
</script>    
<script>
     function updateMarkerPosition(latLng) {
  document.getElementById('lat').value = [latLng.lat()];
  document.getElementById('lng').value = [latLng.lng()];
  }

    var myOptions = {
      zoom: 7,
        scaleControl: true,
      center:  new google.maps.LatLng(-7.8970997,110.2226662),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

 
    var map = new google.maps.Map(document.getElementById("map"),
        myOptions);

 var marker1 = new google.maps.Marker({
 position : new google.maps.LatLng(-7.8970997,110.2226662),
 title : 'lokasi',
 map : map,
 draggable : true
 });
 
 //updateMarkerPosition(latLng);

 google.maps.event.addListener(marker1, 'drag', function() {
  updateMarkerPosition(marker1.getPosition());
 });
</script>

</script>


					<div id="edit" class="modal fade" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Data Wisata</h4>
							</div>
							<form id="form" enctype="multipart/form-data">
								<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="kat">Kategori</label>
									<input type="number" name="kat" class="form-control" id="kat" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_wisata">Nama Wisata</label>
									<input type="text"  id="id" name="id">
									<input type="text" name="nm_wisata" class="form-control" id="nm_wisata" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="ket_wisata">Keterangan</label>
									<textarea cols="8" rows="5" type="number" name="ket_wisata" class="form-control" id="ket_wisata" ></textarea>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_alamat">Alamat</label>
									<input type="text" name="nm_alamat" class="form-control" id="nm_alamat" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_fasilitas">Fasilitas</label>
									<input type="text" name="nm_fasilitas" class="form-control" id="nm_fasilitas" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_tiket">Tiket</label>
									<input type="text" name="nm_tiket" class="form-control" id="nm_tiket" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="lat">Latitude</label>
									<input type="text" name="lat" class="form-control" id="lat" >
									</div>
								<div class="form-group">
									<label class="control-label" for="lng">Longitude</label>
									<input type="text" name="lng" class="form-control" id="lng" >
									</div>

								<div class="form-group">
									<label class="control-label" for="gbr_one">Gambar</label>
									<div style="padding-bottom: 5px"> 
											<img src="" width="50px" id="pict">
										</div>
									<input type="file" name="gbr_one" class="form-control" id="gbr_one">
									</div>
								<div class="form-group">
									<label class="control-label" for="gbr_two">Gambar</label>
									<div style="padding-bottom: 5px"> 
											<img src="" width="50px" id="pict1">
										</div>
									<input type="file" name="gbr_two" class="form-control" id="gbr_two">
									</div>
								<div class="form-group">
									<label class="control-label" for="gbr_three">Gambar</label>
									<div style="padding-bottom: 5px"> 
											<img src="" width="50px" id="pict2">
										</div>
									<input type="file" name="gbr_three" class="form-control" id="gbr_three">
									</div>
								</div>
								<div class="modal-footer">
									<input type="submit" class="btn btn-success" name="edit" value="Simpan"></input>
								</div>
							</form> <!-- Membuat pop up edit data -->
							
							
							</div>
						</div>
					</div>
					<!-- //jquaeri edit data -->
					<script src="assets/js/jquery-1.10.2.js"></script>
					<script type="text/javascript">
						$(document).on ("click", "#edit_wisata", function (){					
						var idwisata = $(this).data('id');
						var katwisata = $(this).data('kategori');
						var nmwisata = $(this).data('nama');
						var ketwisata = $(this).data('keterangan');
						var nmalamat = $(this).data('alamat');
						var nmfasilitas = $(this).data('fasilitas');
						var nmtiket = $(this).data('tiket');

						var latwisata = $(this).data('latt');
						var lngwisata = $(this).data('longi');
						var gbrone = $(this).data('gbr1');
						var gbrtwo = $(this).data('gbr2');
						var gbrthree = $(this).data('gbr3');

						$("#modal-edit #id").val(idwisata);
						$("#modal-edit #kat").val(katwisata);
						$("#modal-edit #nm_wisata").val(nmwisata);
						$("#modal-edit #ket_wisata").val(ketwisata);
						$("#modal-edit #nm_alamat").val(nmalamat);
						$("#modal-edit #nm_fasilitas").val(nmfasilitas);
						$("#modal-edit #nm_tiket").val(nmtiket);

						$("#modal-edit #lat").val(latwisata);
						$("#modal-edit #lng").val(lngwisata);
						$("#modal-edit #pict").attr("src", "assets/img/wisata/"+gbrone);
						$("#modal-edit #pict1").attr("src", "assets/img/wisata/"+gbrtwo);
						$("#modal-edit #pict2").attr("src", "assets/img/wisata/"+gbrthree);

						
					})

						$(document).ready(function(e){
							$("#form").on("submit", (function(e){
								e.preventDefault();
								$.ajax({
									url: 'model/m_editwisata.php',
									type : 'POST',
									data : new FormData(this),
									contentType : false,
									cache : false,
									processData : false,
									success : function(msg){
										$('.table').html(msg);
									}
								})
							}))
						})
				</script>
				

		</div>
	</div>
<?php 
}elseif (@$_GET['act'] == 'del') {
	$gbr_awal = $wst->tampil($_GET['id'])->fetch_object()->gbr1;
	unlink("assets/img/wisata/".$gbr_awal);

	$wst->hapus($_GET['id']);
	header("location: ?page=wisata");
} ?>