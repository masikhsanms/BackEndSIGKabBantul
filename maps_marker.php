<?php 
	// include "koneksi.php";
	require_once('config/koneksi.php');
    require_once('model/database.php');
  
    $connection = new Database ($host, $user, $pass, $database);

	$id =$_GET['kat'];

	if ($id == 0) {
			$query = mysqli_query($connection->con, "SELECT * FROM tb_wisata ORDER BY nama ASC");
	}else{
			$query = mysqli_query($connection->con, "SELECT * FROM tb_wisata WHERE kategori='".$id."' ORDER BY nama ASC");

	}

	
	$json = '{"wisata": [';

	
	// create looping dech array in fetch
	while ($row = mysqli_fetch_array($query)){

	// quotation marks (") are not allowed by the json string, we will replace it with the` character
	// strip_tag serves to remove html tags on strings
		$char ='"';

		$json .= 
		'{
			"id":"'.str_replace($char,'`',strip_tags($row['id'])).'", 
			"nama":"'.str_replace($char,'`',strip_tags($row['nama'])).'",
			"lat":"'.str_replace($char,'`',strip_tags($row['latt'])).'",
			"lng":"'.str_replace($char,'`',strip_tags($row['longi'])).'"
		},';
	}

	// omitted commas at the end of the array
	$json = substr($json,0,strlen($json)-1);

	$json .= ']}';

	// print json
	echo $json;
	
	mysqli_close($connection->con);
	
?>