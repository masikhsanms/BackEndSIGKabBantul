<?php
 
class Desa_Wisata{

	private $mysqli;

	function __construct($con){
		$this->mysqli = $con;
	}

	public function tampil(){
		$db = $this->mysqli->con;
		$sql = "SELECT * FROM tb_wisata WHERE kategori ='2'";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	
	public function tambah($kat,$nm_wisata,$ket_wisata,$nm_alamat,$nm_fasilitas,$nm_tiket,$lat,$lng,$gbr_one,$gbr_two,$gbr_three){
		$db = $this->mysqli->con;
		$db->query("INSERT tb_wisata VALUES ('',$kat,'$nm_wisata','$ket_wisata','$nm_alamat','$nm_fasilitas','$nm_tiket',$lat,$lng,'$gbr_one','$gbr_two','$gbr_three')") or die($db->error); 
	}

	public function edit($sql){
		$db = $this->mysqli->con;
		$db->query($sql) or die($db->error);

	}
	public function hapus($id){
		$db = $this->mysqli->con;
		$db->query("DELETE FROM tb_wisata WHERE id ='$id'") or die ($db->error);
	}

	function __destruct(){
		$db = $this->mysqli->con;
		$db->close();
	}
}


 ?>