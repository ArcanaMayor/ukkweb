<?php
require_once("../dbConnection.php");

if (isset($_POST['update'])) {
	$id_penerbit = mysqli_real_escape_string($mysqli, $_POST['id_penerbit']);
	$nama_penerbit = mysqli_real_escape_string($mysqli, $_POST['nama_penerbit']);
	$alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);	
	
	if (empty($nama_penerbit) || empty($alamat)) {
		if (empty($nama_penerbit)) {
			echo "<font color='red'>Nama penulis kosong !</font><br/>";
		}
		
		if (empty($alamat)) {
			echo "<font color='red'>Alamat kosong !</font><br/>";
		}
		
		
	} else {
		$result = mysqli_query($mysqli, "UPDATE penerbit SET `nama_penerbit` = '$nama_penerbit', `alamat` = '$alamat' WHERE `id_penerbit` = $id_penerbit");
		
		header("Location: index.php");
		exit();
	}
}
