<?php
 
class Hotel{

	private $mysqli;

	function __construct($con){
		$this->mysqli = $con;
	}

	public function tampil($id = null){
		$db = $this->mysqli->con;
		$sql = "SELECT * FROM tb_hotel";
		if ($id !=null) {
			$sql .= " WHERE id = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambah($nm_hotel,$ket_hotel,$lat,$lng){
		$db = $this->mysqli->con;
		$db->query("INSERT tb_hotel (id,nama,keterangan,latt,longi) VALUES ('','$nm_hotel','$ket_hotel',$lat,$lng)") or die($db->error); 
	}

	public function edit($sql){
		$db = $this->mysqli->con;
		$db->query($sql) or die($db->error);

	}
	public function hapus($id){
		$db = $this->mysqli->con;
		$db->query("DELETE FROM tb_hotel WHERE id='$id'") or die ($db->error);

	}
	function __destruct(){
		$db = $this->mysqli->con;
		$db->close();
	}
}


 ?>