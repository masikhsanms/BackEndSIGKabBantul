<?php 
include "model/m_desa_wisata.php";

$wst = new Desa_wisata($connection);

if (@$_GET['act'] == '') {
 ?>

<div class="row">
		<div class="col-lg-12">
			<h1>Desa Wisata <small>Data Desa Wisata Bantul</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i></a></li>
				<li><a href=""></i>Desa Wisata</a></li>
				<li class="active">Data Desa Wisata</li>
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
									<a id="edit_desa" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id; ?>" data-kategori="<?php echo $data->kategori; ?>" data-nama="<?php echo $data->nama; ?>" data-keterangan="<?php echo $data->keterangan; ?>" data-alamat="<?php echo $data->alamat; ?>" data-fasilitas="<?php echo $data->fasilitas; ?>" data-tiket="<?php echo $data->tiket; ?>" data-latt="<?php echo $data->latt; ?>" data-longi="<?php echo $data->longi; ?>" data-gbr1="<?php echo $data->gbr1; ?>" data-gbr2="<?php echo $data->gbr2; ?>" data-gbr3="<?php echo $data->gbr3; ?>">
										<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
									</a>
									<a href="?page=desawisata&act=del&id=<?php echo $data->id; ?>" onclick="return confirm('Yakin anda Menghapus Data ini?')">
									<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
									</a>
								</td>
							</tr>
							<?php } ?>
					</tbody>
				</table>
			</div>

				<!--  -->


					<div id="edit" class="modal fade" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Data Desa Wisata</h4>
							</div>
							<form id="form" enctype="multipart/form-data">
								<div class="modal-body" id="modal-edit">
								<div class="form-group">
									<label class="control-label" for="kat">Kategori</label>
									<input type="number" name="kat" class="form-control" id="kat" required>
									</div>
								<div class="form-group">
									<label class="control-label" for="nm_wisata">Nama Desa</label>
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
						$(document).on ("click", "#edit_desa", function (){					
						var idwisata = $(this).data('id');
						var katwisata = $(this).data('kategori');
						var nm_wisata = $(this).data('nama');
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
						$("#modal-edit #nm_wisata").val(nm_wisata);
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
									url: 'model/m_editdesawisata.php',
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

	header("location: ?page=desawisata");
} ?>