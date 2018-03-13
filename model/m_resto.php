<?php
 
class Resto{

	private $mysqli;

	function __construct($con){
		$this->mysqli = $con;
	}

	public function tampil($id = null){
		$db = $this->mysqli->con;
		$sql = "SELECT * FROM tb_resto";
		if ($id !=null) {
			$sql .= " WHERE id = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tambah($nm_resto,$ket_resto,$lat,$lng){
		$db = $this->mysqli->con;
		$db->query("INSERT tb_resto (id,nama,keterangan,latt,longi) VALUES ('','$nm_resto','$ket_resto','$lat','$lng')") or die($db->error); 
	}

	public function edit($sql){
		$db = $this->mysqli->con;
		$db->query($sql) or die($db->error);

	}
	public function hapus($id){
		$db = $this->mysqli->con;
		$db->query("DELETE FROM tb_resto WHERE id='$id'") or die ($db->error);

	}
	function __destruct(){
		$db = $this->mysqli->con;
		$db->close();
	}
}


 ?>