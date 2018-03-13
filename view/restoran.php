<?php 
include "model/m_resto.php";

$rst = new Resto($connection);

if (@$_GET['act'] == '') {
 ?>

<div class="row">
		<div class="col-lg-12">
			<h1>Restoran di Bantul <small>Data Restoran Bantul</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i></a></li>
				<li><a href=""></i>Restoran</a></li>
				<li class="active">Data Restoran</li>
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
								$tampil = $rst->tampil();

								while ($data =$tampil->fetch_object()) {
							 ?>
							<tr>
								<td align="center"><?php echo $no++; ?></td>
								<td><?php echo $data->nama; ?></td>
								<td><?php echo $data->keterangan; ?></td>
								<td><?php echo $data->latt; ?></td>
								<td><?php echo $data->longi; ?></td>
								
								<td align="center">
									<a id="edit_resto" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-kategori="<?php echo $data->kategori; ?>" data-nama="<?php echo $data->nama; ?>" data-keterangan="<?php echo $data->keterangan; ?>" data-latt="<?php echo $data->latt; ?>" data-longi="<?php echo $data->longi; ?>">
										<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
									</a>
									<a href="?page=restoran&act=del&id=<?php echo $data->id; ?>" onclick="return confirm('Yakin anda Menghapus Data ini?')">
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
								<h4 class="modal-title">Tambah Data Resto</h4>
							</div>
							<form method="post" enctype="multipart/form-data">
								<div class="modal-body">
								<div class="form-group">
									<label class="control-label" for="nm_resto">Nama Resto</label>
									<input type="text" name="nm_resto" class="form-control" id="nm_resto" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="ket_resto">Keterangan</label>
									<textarea cols="8" rows="5" type="text" name="ket_resto" class="form-control" id="ket_resto" ></textarea>
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
								$nm_resto = $connection->con->real_escape_string($_POST['nm_resto']);
								$ket_resto = $connection->con->real_escape_string($_POST['ket_resto']);
								$lat = $connection->con->real_escape_string($_POST['lat']);
								$lng = $connection->con->real_escape_string($_POST['lng']);
			
								$rst->tambah($nm_resto,$ket_resto,$lat,$lng);
															
								if ($rst) {
									echo "<script>window.location='?page=restoran';</script>";
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
								<h4 class="modal-title">Edit Data Resto</h4>
							</div>
							<form id="form" enctype="multipart/form-data">
								<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="nm_resto">Nama Resto</label>
									<input type="hidden"  id="id" name="id">
									<input type="text" name="nm_resto" class="form-control" id="nm_resto" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="ket_resto">Keterangan</label>
									<textarea cols="8" rows="5" type="text" name="ket_resto" class="form-control" id="ket_resto" required></textarea>
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
						$(document).on ("click", "#edit_resto", function (){					
						var idresto = $(this).data('id');
						// var katwisata = $(this).data('kategori');
						var nmresto = $(this).data('nama');
						var ketresto = $(this).data('keterangan');
						var latresto = $(this).data('latt');
						var lngresto = $(this).data('longi');
						// var gbrone = $(this).data('gbr1');
						// var gbrtwo = $(this).data('gbr2');
						// var gbrthree = $(this).data('gbr3');

						$("#modal-edit #id").val(idresto);
						// $("#modal-edit #kat").val(katwisata);
						$("#modal-edit #nm_resto").val(nmresto);
						$("#modal-edit #ket_resto").val(ketresto);
						$("#modal-edit #lat").val(latresto);
						$("#modal-edit #lng").val(lngresto);
						// $("#modal-edit #pict").attr("src", "assets/img/wisata/"+gbrone);
						// $("#modal-edit #pict1").attr("src", "assets/img/wisata/"+gbrtwo);
						// $("#modal-edit #pict2").attr("src", "assets/img/wisata/"+gbrthree);

						
					})

						$(document).ready(function(e){
							$("#form").on("submit", (function(e){
								e.preventDefault();
								$.ajax({
									url: 'model/m_editresto.php',
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
	$rst->tampil($_GET['id'])->fetch_object();
	// unlink("assets/img/wisata/".$gbr_awal);

	$rst->hapus($_GET['id']);
	header("location: ?page=restoran");
} ?>