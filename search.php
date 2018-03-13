<?php 
// include "koneksi.php";
require_once('config/koneksi.php');
require_once('model/database.php');
  
    $connection = new Database ($host, $user, $pass, $database);

	$nama = $_GET['nama'];

	$query = mysqli_query($connection->con, "SELECT * FROM tb_wisata where nama like '%".$nama."%'");
	
	$json = '{"wisata": [';

	while ($row = mysqli_fetch_array($query)){
		$char ='"';

		$json .= 
		'{
			"id":"'.str_replace($char,'`',strip_tags($row['id'])).'", 
			"nama":"'.str_replace($char,'`',strip_tags($row['nama'])).'",
			"lat":"'.str_replace($char,'`',strip_tags($row['latt'])).'",
			"lng":"'.str_replace($char,'`',strip_tags($row['longi'])).'"
		},';
	}

	$json = substr($json,0,strlen($json)-1);

	$json .= ']}';

	echo $json;
	
	mysqli_close($con);
	
?>