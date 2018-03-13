<?php
// include "koneksi.php";
require_once('config/koneksi.php');
require_once('model/database.php');

    $connection = new Database ($host, $user, $pass, $database);

$id = $_GET['id'];

$query = mysqli_query($connection->con, "SELECT * FROM tb_wisata where id= '".$id."' ORDER BY nama ASC");

$json = '{"wisata": [';


// create looping dech array in fetch
while ($row = mysqli_fetch_array($query)) {
    $hotel = "Tidak Ada Hotel Terdekat";
	$lat_hotel= 0;
    $longi_hotel=0;
    

	//dalam radius kilometer
    $q_hotel = mysqli_query($connection->con, "SELECT *, ((ACOS(SIN(" . $row['latt'] . " * PI() / 180) * SIN(latt * PI() / 180) + COS(" . $row['latt'] . " * PI() / 180) * COS(latt * PI() / 180) * COS((" . $row['longi'] . " - longi) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344) as distance
        FROM tb_hotel HAVING distance <= 10  ORDER BY distance ASC LIMIT 1"); //where kategori=3
    while ($bir = mysqli_fetch_array($q_hotel)) {
        $hotel = $bir['nama'];
		$lat_hotel = $bir['latt'];
		$longi_hotel = $bir['longi'];

		}
        
	$resto = "Tidak Ada Retoran Terdekat" ;
    $lat_resto= 0;
    $longi_resto=0;
	//dalam radius kilometer
    $q_resto = mysqli_query($connection->con, "SELECT *, ((ACOS(SIN(" . $row['latt'] . " * PI() / 180) * SIN(latt * PI() / 180) + COS(" . $row['latt'] . " * PI() / 180) * COS(latt * PI() / 180) * COS((" . $row['longi'] . " - longi) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * 1.609344) as distance
        FROM tb_resto HAVING distance <= 10  ORDER BY distance ASC LIMIT 1"); //where kategori=4
    while ($res = mysqli_fetch_array($q_resto)) {
        $resto= $res['nama'];
		$lat_resto = $res['latt'];
        $longi_resto = $res['longi'];
        }

        $char = '"';

        $json .=
                '{
        "id":"' . str_replace($char, '`', strip_tags($row['id'])) . '", 
        "nama":"' . str_replace($char, '`', strip_tags($row['nama'])) . '",
        "ket":"' . str_replace($char, '`', strip_tags($row['keterangan'])) . '",
        "alamat":"' . str_replace($char, '`', strip_tags($row['alamat'])) . '",
        "fasilitas":"' . str_replace($char, '`', strip_tags($row['fasilitas'])) . '",
        "tiket":"' . str_replace($char, '`', strip_tags($row['tiket'])) . '",
        "hotel":"' . str_replace($char, '`', strip_tags($hotel)) . '",
		"lat_hotel":"' . str_replace($char, '`', strip_tags($lat_hotel)) . '",
		"longi_hotel":"' . str_replace($char, '`', strip_tags($longi_hotel)) . '",		
		"resto":"' . str_replace($char, '`', strip_tags($resto)) . '",
        "lat_resto":"' . str_replace($char, '`', strip_tags($lat_resto)) . '",
        "longi_resto":"' . str_replace($char, '`', strip_tags($longi_resto)) . '",
        "gbr1":"' . str_replace($char, '`', strip_tags($row['gbr1'])) . '",
		"gbr2":"' . str_replace($char, '`', strip_tags($row['gbr2'])) . '",
		"gbr3":"' . str_replace($char, '`', strip_tags($row['gbr3'])) . '",
        "lat":"' . str_replace($char, '`', strip_tags($row['latt'])) . '",
        "lng":"' . str_replace($char, '`', strip_tags($row['longi'])) . '"
        },';
    
}

// omitted commas at the end of the array
$json = substr($json, 0, strlen($json) - 1);

$json .= ']}';

// print json
echo $json;

mysqli_close($connection->con);
?>