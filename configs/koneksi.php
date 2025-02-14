<?php 
// $conn= mysqli_connect("localhost", "u1694897_a_bws_4", "jtipolije", "u1694897_a_bws_4_db");
$conn= mysqli_connect("localhost", "root", "", "farm");


function query ($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;

}







///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// function hapus kandang A
function hapusA ($id){
	global $conn;

	$idNow = mysqli_query($conn, "SELECT * FROM kandang_a WHERE id = $id");

	while($Data = mysqli_fetch_array($idNow)){
    	$ayamAfkir =  $Data['afkir'];
		$ayamMati =  $Data['mati'];
	}

	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_a'");

	while($Data = mysqli_fetch_array($ayam)){
		$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamMati + $ayamAfkir;

	
	//query update 
	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_a'";
	mysqli_query($conn,$queryAyam);

	//query hapus
	mysqli_query($conn,"DELETE FROM kandang_a WHERE id =$id");
	return mysqli_affected_rows($conn);
}

function ubahA($kandang_a){
	global $conn;
$id = $kandang_a["id"];
$tanggal = $kandang_a["tanggal"];
$pakan_total = $kandang_a["pakan_total"];
$sisa_1 = $kandang_a["sisa_1"];
$sisa_2 = $kandang_a["sisa_2"];
$sisa_3 = $kandang_a["sisa_3"];
$sisa_4 = $kandang_a["sisa_4"];
$sisa_5 = $kandang_a["sisa_5"];
$sisa_6 = $kandang_a["sisa_6"];
$jumlah_telur = $kandang_a["jumlah_telur"];
$berat_telur = $kandang_a["berat_telur"];
$mati = $kandang_a["mati"];
$afkir = $kandang_a["afkir"];
$suhu_pagi = $kandang_a["suhu_pagi"];
$suhu_siang = $kandang_a["suhu_siang"];
$suhu_sore = $kandang_a["suhu_sore"];
$keterangan = $kandang_a["keterangan"];


$idNow = mysqli_query($conn, "SELECT * FROM kandang_a WHERE id = $id");

while($Data = mysqli_fetch_array($idNow)){
    $ayamAfkir =  $Data['afkir'];
	$ayamMati =  $Data['mati'];
}

if($ayamAfkir != $afkir && $ayamMati != $mati){
	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_a'");

	while($Data = mysqli_fetch_array($ayam)){
    	$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamAfkir + $ayamMati - $mati - $afkir;

	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_a'";


	mysqli_query($conn,$queryAyam);
}



// query insert data
$query = "UPDATE kandang_a SET 
			tanggal = '$tanggal',
			pakan_total = '$pakan_total',
			sisa_1 = '$sisa_1',
			sisa_2 = '$sisa_2',
			sisa_3 = '$sisa_3',
			sisa_4 = '$sisa_4',
			sisa_5 = '$sisa_5',
			sisa_6 = '$sisa_6',
			jumlah_telur = '$jumlah_telur',
			berat_telur = '$berat_telur',
			mati = '$mati',
			afkir = '$afkir',
			suhu_pagi = '$suhu_pagi',
			suhu_siang = '$suhu_siang',
			suhu_sore = '$suhu_sore',
			keterangan ='$keterangan'	
			WHERE id = $id
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// ambil data dari tiap elemen dalam form Kandang B
function tambahdatakandangB($kandang_b){
global $conn;
$GetTableGT = mysqli_query($conn, "SELECT MAX(id) AS IDAuto FROM kandang_b");
$GetKodeGT = mysqli_fetch_array($GetTableGT);
$GetMaxValue = $GetKodeGT['IDAuto'];

$GetMaxValue++;

$id = $GetMaxValue;
$tanggal = $kandang_b["tanggal"];
$pakan_total = $kandang_b["pakan_total"];
$sisa_1 = $kandang_b["sisa_1"];
$sisa_2 = $kandang_b["sisa_2"];
$sisa_3 = $kandang_b["sisa_3"];
$sisa_4 = $kandang_b["sisa_4"];
$sisa_5 = $kandang_b["sisa_5"];
$sisa_6 = $kandang_b["sisa_6"];
$jumlah_telur = $kandang_b["jumlah_telur"];
$berat_telur = $kandang_b["berat_telur"];
$mati = $kandang_b["mati"];
$afkir = $kandang_b["afkir"];
$suhu_pagi = $kandang_b["suhu_pagi"];
$suhu_siang = $kandang_b["suhu_siang"];
$suhu_sore = $kandang_b["suhu_sore"];
$nama = $kandang_b["nama"];
$keterangan = $kandang_b["keterangan"];

$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_b'");

while($Data = mysqli_fetch_array($ayam)){
    $jumlahAyam =  $Data['JumlahAyam'];
}
       
$totalAyam = $jumlahAyam - $mati - $afkir;

$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_b'";


mysqli_query($conn,$queryAyam);

// query insert data
$query = "INSERT INTO kandang_b
			VALUES 
			('$id','$tanggal','$pakan_total','$sisa_1','$sisa_2','$sisa_3','$sisa_4','$sisa_5','$sisa_6','$jumlah_telur','$berat_telur','$mati','$afkir','$suhu_pagi','$suhu_siang','$suhu_sore','$nama','$keterangan')
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}

function ubahB($kandang_b){
	global $conn;
$id = $kandang_b["id"];
$tanggal = $kandang_b["tanggal"];
$pakan_total = $kandang_b["pakan_total"];
$sisa_1 = $kandang_b["sisa_1"];
$sisa_2 = $kandang_b["sisa_2"];
$sisa_3 = $kandang_b["sisa_3"];
$sisa_4 = $kandang_b["sisa_4"];
$sisa_5 = $kandang_b["sisa_5"];
$sisa_6 = $kandang_b["sisa_6"];
$jumlah_telur = $kandang_b["jumlah_telur"];
$berat_telur = $kandang_b["berat_telur"];
$mati = $kandang_b["mati"];
$afkir = $kandang_b["afkir"];
$suhu_pagi = $kandang_b["suhu_pagi"];
$suhu_siang = $kandang_b["suhu_siang"];
$suhu_sore = $kandang_b["suhu_sore"];
$keterangan = $kandang_b["keterangan"];

$idNow = mysqli_query($conn, "SELECT * FROM kandang_b WHERE id = $id");

while($Data = mysqli_fetch_array($idNow)){
    $ayamAfkir =  $Data['afkir'];
	$ayamMati =  $Data['mati'];
}

if($ayamAfkir != $afkir && $ayamMati != $mati){
	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_b'");

	while($Data = mysqli_fetch_array($ayam)){
    	$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamAfkir + $ayamMati - $mati - $afkir;

	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_b'";


	mysqli_query($conn,$queryAyam);
}

// query insert data
$query = "UPDATE kandang_b SET 
			tanggal = '$tanggal',
			pakan_total = '$pakan_total',
			sisa_1 = '$sisa_1',
			sisa_2 = '$sisa_2',
			sisa_3 = '$sisa_3',
			sisa_4 = '$sisa_4',
			sisa_5 = '$sisa_5',
			sisa_6 = '$sisa_6',
			jumlah_telur = '$jumlah_telur',
			berat_telur = '$berat_telur',
			mati = '$mati',
			afkir = '$afkir',
			suhu_pagi = '$suhu_pagi',
			suhu_siang = '$suhu_siang',
			suhu_sore = '$suhu_sore',
			keterangan ='$keterangan'	
			WHERE id = $id
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}

// function hapus kandang B
function hapusB ($id){
	global $conn;

	$idNow = mysqli_query($conn, "SELECT * FROM kandang_b WHERE id = $id");

	while($Data = mysqli_fetch_array($idNow)){
    	$ayamAfkir =  $Data['afkir'];
		$ayamMati =  $Data['mati'];
	}

	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_b'");

	while($Data = mysqli_fetch_array($ayam)){
		$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamMati + $ayamAfkir;

	
	//query update 
	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_b'";
	mysqli_query($conn,$queryAyam);

	//query delete
	mysqli_query($conn,"DELETE FROM kandang_b WHERE id =$id");
	return mysqli_affected_rows($conn);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// ambil data dari tiap elemen dalam form Kandang C
function tambahdatakandangC($kandang_c){
global $conn;

$GetTableGT = mysqli_query($conn, "SELECT MAX(id) AS IDAuto FROM kandang_c");
$GetKodeGT = mysqli_fetch_array($GetTableGT);
$GetMaxValue = $GetKodeGT['IDAuto'];

$GetMaxValue++;

$id = $GetMaxValue;
$tanggal = $kandang_c["tanggal"];
$pakan_total = $kandang_c["pakan_total"];
$sisa_1 = $kandang_c["sisa_1"];
$sisa_2 = $kandang_c["sisa_2"];
$sisa_3 = $kandang_c["sisa_3"];
$sisa_4 = $kandang_c["sisa_4"];
$sisa_5 = $kandang_c["sisa_5"];
$sisa_6 = $kandang_c["sisa_6"];
$jumlah_telur = $kandang_c["jumlah_telur"];
$berat_telur = $kandang_c["berat_telur"];
$mati = $kandang_c["mati"];
$afkir = $kandang_c["afkir"];
$suhu_pagi = $kandang_c["suhu_pagi"];
$suhu_siang = $kandang_c["suhu_siang"];
$suhu_sore = $kandang_c["suhu_sore"];
$nama = $kandang_c["nama"];
$keterangan = $kandang_c["keterangan"];

$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_c'");

while($Data = mysqli_fetch_array($ayam)){
    $jumlahAyam =  $Data['JumlahAyam'];
}
       
$totalAyam = $jumlahAyam - $mati - $afkir;

$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_c'";


mysqli_query($conn,$queryAyam);

// query insert data
$query = "INSERT INTO kandang_c
			VALUES 
			('$id','$tanggal','$pakan_total','$sisa_1','$sisa_2','$sisa_3','$sisa_4','$sisa_5','$sisa_6','$jumlah_telur','$berat_telur','$mati','$afkir','$suhu_pagi','$suhu_siang','$suhu_sore','$nama','$keterangan')
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}


// Ubah kandang C
function ubahC($kandang_c){
	global $conn;
$id = $kandang_c["id"];
$tanggal = $kandang_c["tanggal"];
$pakan_total = $kandang_c["pakan_total"];
$sisa_1 = $kandang_c["sisa_1"];
$sisa_2 = $kandang_c["sisa_2"];
$sisa_3 = $kandang_c["sisa_3"];
$sisa_4 = $kandang_c["sisa_4"];
$sisa_5 = $kandang_c["sisa_5"];
$sisa_6 = $kandang_c["sisa_6"];
$jumlah_telur = $kandang_c["jumlah_telur"];
$berat_telur = $kandang_c["berat_telur"];
$mati = $kandang_c["mati"];
$afkir = $kandang_c["afkir"];
$suhu_pagi = $kandang_c["suhu_pagi"];
$suhu_siang = $kandang_c["suhu_siang"];
$suhu_sore = $kandang_c["suhu_sore"];
$keterangan = $kandang_c["keterangan"];

$idNow = mysqli_query($conn, "SELECT * FROM kandang_c WHERE id = $id");

while($Data = mysqli_fetch_array($idNow)){
    $ayamAfkir =  $Data['afkir'];
	$ayamMati =  $Data['mati'];
}

if($ayamAfkir != $afkir && $ayamMati != $mati){
	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_c'");

	while($Data = mysqli_fetch_array($ayam)){
    	$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamAfkir + $ayamMati - $mati - $afkir;

	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_c'";


	mysqli_query($conn,$queryAyam);
}

// query insert data
$query = "UPDATE kandang_c SET 
			tanggal = '$tanggal',
			pakan_total = '$pakan_total',
			sisa_1 = '$sisa_1',
			sisa_2 = '$sisa_2',
			sisa_3 = '$sisa_3',
			sisa_4 = '$sisa_4',
			sisa_5 = '$sisa_5',
			sisa_6 = '$sisa_6',
			jumlah_telur = '$jumlah_telur',
			berat_telur = '$berat_telur',
			mati = '$mati',
			afkir = '$afkir',
			suhu_pagi = '$suhu_pagi',
			suhu_siang = '$suhu_siang',
			suhu_sore = '$suhu_sore',
			keterangan ='$keterangan'	
			WHERE id = $id
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}

// function hapus kandang B
function hapusC ($id){
	global $conn;

	$idNow = mysqli_query($conn, "SELECT * FROM kandang_c WHERE id = $id");

	while($Data = mysqli_fetch_array($idNow)){
    	$ayamAfkir =  $Data['afkir'];
		$ayamMati =  $Data['mati'];
	}

	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_c'");

	while($Data = mysqli_fetch_array($ayam)){
		$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamMati + $ayamAfkir;

	
	//query update 
	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_c'";
	mysqli_query($conn,$queryAyam);

	//query delete
	mysqli_query($conn,"DELETE FROM kandang_c WHERE id =$id");
	return mysqli_affected_rows($conn);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// ambil data dari tiap elemen dalam form Kandang C
function tambahdatakandangD($kandang_d){
global $conn;

$GetTableGT = mysqli_query($conn, "SELECT MAX(id) AS IDAuto FROM kandang_d");
$GetKodeGT = mysqli_fetch_array($GetTableGT);
$GetMaxValue = $GetKodeGT['IDAuto'];

$GetMaxValue++;

$id = $GetMaxValue;
$tanggal = $kandang_d["tanggal"];
$pakan_total = $kandang_d["pakan_total"];
$sisa_1 = $kandang_d["sisa_1"];
$sisa_2 = $kandang_d["sisa_2"];
$sisa_3 = $kandang_d["sisa_3"];
$sisa_4 = $kandang_d["sisa_4"];
$sisa_5 = $kandang_d["sisa_5"];
$sisa_6 = $kandang_d["sisa_6"];
$jumlah_telur = $kandang_d["jumlah_telur"];
$berat_telur = $kandang_d["berat_telur"];
$mati = $kandang_d["mati"];
$afkir = $kandang_d["afkir"];
$suhu_pagi = $kandang_d["suhu_pagi"];
$suhu_siang = $kandang_d["suhu_siang"];
$suhu_sore = $kandang_d["suhu_sore"];
$nama = $kandang_d["nama"];
$keterangan = $kandang_d["keterangan"];

$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_d'");

while($Data = mysqli_fetch_array($ayam)){
    $jumlahAyam =  $Data['JumlahAyam'];
}
       
$totalAyam = $jumlahAyam - $mati - $afkir;

$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_d'";


mysqli_query($conn,$queryAyam);

// query insert data
$query = "INSERT INTO kandang_d
			VALUES 
			('$id','$tanggal','$pakan_total','$sisa_1','$sisa_2','$sisa_3','$sisa_4','$sisa_5','$sisa_6','$jumlah_telur','$berat_telur','$mati','$afkir','$suhu_pagi','$suhu_siang','$suhu_sore','$nama','$keterangan')
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}


// Ubah kandang C
function ubahD($kandang_d){
	global $conn;
$id = $kandang_d["id"];
$tanggal = $kandang_d["tanggal"];
$pakan_total = $kandang_d["pakan_total"];
$sisa_1 = $kandang_d["sisa_1"];
$sisa_2 = $kandang_d["sisa_2"];
$sisa_3 = $kandang_d["sisa_3"];
$sisa_4 = $kandang_d["sisa_4"];
$sisa_5 = $kandang_d["sisa_5"];
$sisa_6 = $kandang_d["sisa_6"];
$jumlah_telur = $kandang_d["jumlah_telur"];
$berat_telur = $kandang_d["berat_telur"];
$mati = $kandang_d["mati"];
$afkir = $kandang_d["afkir"];
$suhu_pagi = $kandang_d["suhu_pagi"];
$suhu_siang = $kandang_d["suhu_siang"];
$suhu_sore = $kandang_d["suhu_sore"];
$keterangan = $kandang_d["keterangan"];

$idNow = mysqli_query($conn, "SELECT * FROM kandang_d WHERE id = $id");

while($Data = mysqli_fetch_array($idNow)){
    $ayamAfkir =  $Data['afkir'];
	$ayamMati =  $Data['mati'];
}

if($ayamAfkir != $afkir && $ayamMati != $mati){
	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_d'");

	while($Data = mysqli_fetch_array($ayam)){
    	$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamAfkir + $ayamMati - $mati - $afkir;

	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_d'";


	mysqli_query($conn,$queryAyam);
}

// query insert data
$query = "UPDATE kandang_d SET 
			tanggal = '$tanggal',
			pakan_total = '$pakan_total',
			sisa_1 = '$sisa_1',
			sisa_2 = '$sisa_2',
			sisa_3 = '$sisa_3',
			sisa_4 = '$sisa_4',
			sisa_5 = '$sisa_5',
			sisa_6 = '$sisa_6',
			jumlah_telur = '$jumlah_telur',
			berat_telur = '$berat_telur',
			mati = '$mati',
			afkir = '$afkir',
			suhu_pagi = '$suhu_pagi',
			suhu_siang = '$suhu_siang',
			suhu_sore = '$suhu_sore',
			keterangan ='$keterangan'	
			WHERE id = $id
			";

mysqli_query($conn,$query);

return mysqli_affected_rows($conn);
}


// function hapus kandang B
function hapusD ($id){
	global $conn;

	$idNow = mysqli_query($conn, "SELECT * FROM kandang_d WHERE id = $id");

	while($Data = mysqli_fetch_array($idNow)){
    	$ayamAfkir =  $Data['afkir'];
		$ayamMati =  $Data['mati'];
	}

	$ayam = mysqli_query($conn, "SELECT * FROM ayam WHERE namaKandang = 'kandang_d'");

	while($Data = mysqli_fetch_array($ayam)){
		$jumlahAyam =  $Data['JumlahAyam'];
	}
       
	$totalAyam = $jumlahAyam + $ayamMati + $ayamAfkir;

	
	//query update 
	$queryAyam = "UPDATE ayam SET JumlahAyam= $totalAyam WHERE namaKandang = 'kandang_d'";
	mysqli_query($conn,$queryAyam);

	//query delete
	mysqli_query($conn,"DELETE FROM kandang_d WHERE id =$id");
	return mysqli_affected_rows($conn);
}



 ?>
