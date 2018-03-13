<?php 
include "model/m_hotel.php";

$htl = new Hotel($connection);

if (@$_GET['act'] == '') {
 ?>

<div class="row">
		<div class="col-lg-12">
			<h1>Hotel di Bantul <small>Data Hotel Bantul</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i></a></li>
					<li><a href=""></i>Hotel</a></li>
				<li class="active">Data Hotel</li>
			</ol>
		</div>
</div> <!-- ROW -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="datatable">
					<thead>
					<tr>
						<th>No</th>
						<th>Nama wisata</th>
						<th>Alamat</th>
						<th>Latitude</th>
						<th>Longitude</th>
						<th>Aksi</th>
					</tr>
					</thead>
					<tbody>
							<?php 
								$no = 1;
								$tampil = $htl->tampil();

								while ($data =$tampil->fetch_object()) {
							 ?>
							<tr>
								<td align="center"><?php echo $no++; ?></td>
								<td><?php echo $data->nama; ?></td>
								<td><?php echo $data->keterangan; ?></td>
								<td><?php echo $data->latt; ?></td>
								<td><?php echo $data->longi; ?></td>
								
								<td align="center">
									<a id="edit_hotel" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-kategori="<?php echo $data->kategori; ?>" data-nama="<?php echo $data->nama; ?>" data-keterangan="<?php echo $data->keterangan; ?>" data-latt="<?php echo $data->latt; ?>" data-longi="<?php echo $data->longi; ?>">
										<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
									</a>
									<a href="?page=hotel&act=del&id=<?php echo $data->id; ?>" onclick="return confirm('Yakin anda Menghapus Data ini?')">
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
									</a>
								</td>
							</tr>
							<?php } ?>
					</tbody>
				</table>
			</div>

				<!-- Membuat pop up tambah data -->
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
				<div id="tambah" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Tambah Data Hotel</h4>
							</div>
							<form method="post" enctype="multipart/form-data">
								<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="nm_hotel">Nama Hotel</label>
									<input type="text" name="nm_hotel" class="form-control" id="nm_hotel" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="ket_hotel">Keterangan</label>
									<textarea cols="8" rows="5" type="text" name="ket_hotel" class="form-control" id="ket_hotel" ></textarea>
									</div>
								<div class="form-group">
									<label class="control-label" for="lat">Latitude</label>
									<input type="text" name="lat" class="form-control" id="lat" >
									</div>
								<div class="form-group">
									<label class="control-label" for="lng">Longitude</label>
									<input type="text" name="lng" class="form-control" id="lng" >
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
								// $kat = $connection->con->real_escape_string($_POST['kat']);
								$nm_hotel = $connection->con->real_escape_string($_POST['nm_hotel']);
								$ket_hotel = $connection->con->real_escape_string($_POST['ket_hotel']);
								$lat = $connection->con->real_escape_string($_POST['lat']);
								$lng = $connection->con->real_escape_string($_POST['lng']);
			
								$htl->tambah($nm_hotel,$ket_hotel,$lat,$lng);
															
								if ($htl) {
									echo "<script>window.location='?page=hotel';</script>";
								}else{
									echo "<script>alert('uploud gambar gagal')</script>";
								}

								

								}
							 ?>
							 <!-- logika pop up tambah data -->
						</div>
					</div>
				</div>


					<div id="edit" class="modal fade" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Data Hotel</h4>
							</div>
							<form id="form" enctype="multipart/form-data">
								<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="nm_hotel">Nama Hotel</label>
									<input type="hidden"  id="id" name="id">
									<input type="text" name="nm_hotel" class="form-control" id="nm_hotel" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="ket_hotel">Keterangan</label>
									<textarea cols="8" rows="5" type="text" name="ket_hotel" class="form-control" id="ket_hotel" required></textarea>
									</div>
								<div class="form-group">
									<label class="control-label" for="lat">Latitude</label>
									<input type="text" name="lat" class="form-control" id="lat" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="lng">Longitude</label>
									<input type="text" name="lng" class="form-control" id="lng" required>
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
						$(document).on ("click", "#edit_hotel", function (){					
						var idhotel = $(this).data('id');
						// var katwisata = $(this).data('kategori');
						var nmhotel = $(this).data('nama');
						var kethotel = $(this).data('keterangan');
						var lathotel = $(this).data('latt');
						var lnghotel = $(this).data('longi');
						// var gbrone = $(this).data('gbr1');
						// var gbrtwo = $(this).data('gbr2');
						// var gbrthree = $(this).data('gbr3');

						$("#modal-edit #id").val(idhotel);
						// $("#modal-edit #kat").val(katwisata);
						$("#modal-edit #nm_hotel").val(nmhotel);
						$("#modal-edit #ket_hotel").val(kethotel);
						$("#modal-edit #lat").val(lathotel);
						$("#modal-edit #lng").val(lnghotel);
						// $("#modal-edit #pict").attr("src", "assets/img/wisata/"+gbrone);
						// $("#modal-edit #pict1").attr("src", "assets/img/wisata/"+gbrtwo);
						// $("#modal-edit #pict2").attr("src", "assets/img/wisata/"+gbrthree);

						
					})

						$(document).ready(function(e){
							$("#form").on("submit", (function(e){
								e.preventDefault();
								$.ajax({
									url: 'model/m_edithotel.php',
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
	$htl->tampil($_GET['id'])->fetch_object();
	// unlink("assets/img/wisata/".$gbr_awal);

	$htl->hapus($_GET['id']);
	header("location: ?page=hotel");
} ?>