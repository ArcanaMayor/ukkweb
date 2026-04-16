<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
require_once("../dbConnection.php");

if (isset($_POST['submit'])) {
	$nama_penerbit = mysqli_real_escape_string($mysqli, $_POST['nama_penerbit']);
	$alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);
	
		
	if (empty($nama_penerbit) || empty($alamat)) {
		if (empty($nama_penerbit)) {
			echo "<font color='red'>Name penerbit kosong !</font><br/>";
		}
		
		if (empty($alamat)) {
			echo "<font color='red'>Alamat kosong !</font><br/>";
		}
		
		
		
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		$result = mysqli_query($mysqli, "INSERT INTO penerbit (`nama_penerbit`, `alamat`) VALUES ('$nama_penerbit', '$alamat')");
		
		header("Location: index.php");
		exit();
	}
}
?>
</body>
</html>
