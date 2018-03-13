<?php 
require_once('../config/koneksi.php');
require_once('../model/database.php');
include "../model/m_resto.php";

$connection = new Database ($host, $user, $pass, $database);
$rst = new Resto($connection);

$id = $_POST['id'];
$nm_resto = $connection->con->real_escape_string($_POST['nm_resto']);
$ket_resto = $connection->con->real_escape_string($_POST['ket_resto']);
$lat= $connection->con->real_escape_string($_POST['lat']);
$lng= $connection->con->real_escape_string($_POST['lng']);
								
// 								//ambil data gambar dengan penamaan
// $pict = $_FILES['gbr_brg']['name'];
// $extensi = explode(".", $_FILES['gbr_brg']['name']);
// $gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
// $sumber = $_FILES['gbr_brg']['tmp_name'];
// $upload = move_uploaded_file($sumber, "assets/img/barang/".$gbr_brg);

// if ($pict == '') {
// 	$brg->edit("UPDATE tb_barang SET nama_brg ='$nm_brg', harga_brg ='$hrg_brg', stok_brg ='$stk_brg' WHERE id_brg ='$id_brg'");
// 	echo "<script>window.location= '?page=barang';</script>";
// }else{
// 	$gbr_awal = $brg->tampil($id_brg)->fetch_object()->gbr_brg;
// 	unlink("../assets/img/barang/" .$gbr_awal);

// 	$upload = move_uploaded_file($sumber, "../assets/img/barang/".$gbr_brg);

	
		$rst->edit("UPDATE tb_resto SET nama ='$nm_resto', keterangan ='$ket_resto', latt ='$lat', longi = '$lng' WHERE id ='$id'");
	if ($rst) {
		echo "<script>window.location='?page=restoran';</script>";
		
	}else{
		echo "<script>alert('uploud Data gagal')</script>";
		} 


 ?>
