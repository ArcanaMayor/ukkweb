<?php
require_once("../dbConnection.php");

if (isset($_POST['update'])) {
	$id_kategori = mysqli_real_escape_string($mysqli, $_POST['id_kategori']);
	$nama_kategori = mysqli_real_escape_string($mysqli, $_POST['nama_kategori']);
	
	if (empty($nama_kategori)) {
		if (empty($nama_kategori)) {
			echo "<font color='red'>Nama kategori kosong !</font><br/>";
		}
		
		
	} else {
		$result = mysqli_query($mysqli, "UPDATE kategori SET `nama_kategori` = '$nama_kategori' WHERE `id_kategori` = $id_kategori");
		
		header("Location: index.php");
		exit();
	}
}
