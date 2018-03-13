<?php 
require_once('../config/koneksi.php');
require_once('../model/database.php');
include "../model/m_hotel.php";

$connection = new Database ($host, $user, $pass, $database);
$htl = new Hotel($connection);

$id = $_POST['id'];
$nm_hotel = $connection->con->real_escape_string($_POST['nm_hotel']);
$ket_hotel = $connection->con->real_escape_string($_POST['ket_hotel']);
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

	
		$htl->edit("UPDATE tb_hotel SET nama ='$nm_hotel', keterangan ='$ket_hotel', latt ='$lat', longi = '$lng' WHERE id ='$id'");
	if ($htl) {
		echo "<script>window.location='?page=hotel';</script>";
		
	}else{
		echo "<script>alert('uploud Data gagal')</script>";
		}

 


 ?>
