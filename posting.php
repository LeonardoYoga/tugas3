<?php

if ($_SERVER)[ 'REQUEST_METHOD']=='POST' {
	$response = array();
	//mendapatkan data
	$npm = $_POST['npm'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$sesi = $_POST['sesi'];

	require once ('dbConnect.php');
	//cek npm sudah terdaftar apa belum
	$sql = "SELECT * FROM mahasiswa WHERE npm = 'npm' ";
	$check = mysqli_fetch_array(mysqli_query($con,$sql));
	if (isset($check)){
		$response["value"] = 0;
		$response["message"] = "oops! NIM sudah terdaftar!";
		echo json_encode($response);
	
	}else{
		$sql = "INSERT INTO mahasiswa  (npm,nama,kelas,sesi) VALUES('$npm,$nama,$kelas,$sesi')";
		if(mysqli_query($con,$sql)){
			$response["value"] = 1;
		    $response["message"] = "sukses mendaftar !";
		}else{
			$response["value"] = 0;
		    $response["message"] = "oops! coba lagi!";
		    echo json_encode($response);
		}
	}
	//tutup database
	mysql_close($con);
}else{
	$response["value"] = 0;
	$response["message"] = "oops! coba lagi!";
	echo json_encode($response);
}