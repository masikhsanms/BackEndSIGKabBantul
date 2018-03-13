<?php 
require_once('../config/koneksi.php');
require_once('../model/database.php');
include "../model/m_wisata.php";

$connection = new Database ($host, $user, $pass, $database);
$wst = new Wisata($connection);

		$kat = $connection->con->real_escape_string($_POST['kat']);
		$nm_wisata = $connection->con->real_escape_string($_POST['nm_wisata']);
		$ket_wisata = $connection->con->real_escape_string($_POST['ket_wisata']);
		$nm_alamat = $connection->con->real_escape_string($_POST['nm_alamat']);
		$nm_fasilitas = $connection->con->real_escape_string($_POST['nm_fasilitas']);
		$nm_tiket = $connection->con->real_escape_string($_POST['nm_tiket']);
		$lat = $connection->con->real_escape_string($_POST['lat']);
		$lng = $connection->con->real_escape_string($_POST['lng']);
		$id = $connection->con->real_escape_string($_POST['id']);
			
								//ambil data gambar dengan penamaan
		$pict = $_FILES['gbr_one']['name'];
		$extensi = explode(".", $_FILES['gbr_one']['name']);
		$gbr_one = "wst1-".round(microtime(true)).".".end($extensi);
		$sumber = $_FILES['gbr_one']['tmp_name'];
		$upload = move_uploaded_file($sumber, "../assets/img/wisata/".$gbr_one);

								//ambil data gambar dengan penamaan
		$pict1 = $_FILES['gbr_two']['name'];
		$extensi1 = explode(".", $_FILES['gbr_two']['name']);
		$gbr_two = "wst2-".round(microtime(true)).".".end($extensi1);
		$sumber1 = $_FILES['gbr_two']['tmp_name'];
		$upload1 = move_uploaded_file($sumber1, "../assets/img/wisata/".$gbr_two);

		$pict2 = $_FILES['gbr_three']['name'];
		$extensi2 = explode(".", $_FILES['gbr_three']['name']);
		$gbr_three = "wst3-".round(microtime(true)).".".end($extensi2);
		$sumber2 = $_FILES['gbr_three']['tmp_name'];
		$upload2 = move_uploaded_file($sumber2, "../assets/img/wisata/".$gbr_three);

								
if  ($pict == '' && $pict1=='' && $pict2=='') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata', alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat', longi ='$lng' WHERE id ='$id'");
	echo "<script>window.location= '?page=wisata';</script>";
}elseif ($pict =='' && $pict1 =='') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata',alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket'. latt ='$lat',longi ='$lng', gbr3='$gbr_three' WHERE id ='$id'");
	echo "<script>window.location= '?page=wisata';</script>";
}elseif ($pict =='' && $pict2 =='') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata',alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat',longi ='$lng', gbr2='$gbr_two' WHERE id ='$id'");
}elseif ($pict1 =='' && $pict2=='') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata',alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat',longi ='$lng', gbr1='$gbr_one' WHERE id ='$id'");
}elseif($pict == '') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata',alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat',longi ='$lng', gbr2='$gbr_two', gbr3='$gbr_three' WHERE id ='$id'");
}elseif ($pict1 == '') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata',alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat',longi ='$lng', gbr1='$gbr_one', gbr3='$gbr_three' WHERE id ='$id'");
	echo "<script>window.location= '?page=wisata';</script>";
}elseif ($pict2 == '') {
	$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata',alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat',longi ='$lng', gbr1='$gbr_one', gbr2='$gbr_two' WHERE id ='$id'");
	echo "<script>window.location= '?page=wisata';</script>";
}else{
	$gbr_awal = $wst->tampil($id)->fetch_object()->gbr1;
	unlink("../assets/img/wisata/" .$gbr_awal);
	$upload = move_uploaded_file($sumber, "../assets/img/wisata/".$gbr_one);

	if ($upload) {
		$wst->edit("UPDATE tb_wisata SET kategori ='$kat', nama ='$nm_wisata', keterangan ='$ket_wisata', alamat ='$nm_alamat', fasilitas ='$nm_fasilitas', tiket ='$nm_tiket', latt ='$lat', longi ='$lng', gbr1 ='$gbr_one', gbr2 ='$gbr_two', gbr3 ='$gbr_three' WHERE id ='$id'");

		echo "<script>window.location= '?page=wisata';</script>";
		
	}else{
		echo "<script>alert('uploud gambar gagal')</script>";
		}
	
}

 


 ?>
