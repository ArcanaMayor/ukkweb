<?php
require_once("../dbConnection.php");

if (isset($_POST['submit'])) {
    $nama_kategori = mysqli_real_escape_string($mysqli, $_POST['nama_kategori']);

    if (empty($nama_kategori)) {
        echo "<font color='red'>Nama Kategori Kosong.</font><br/>";
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        $result = mysqli_query($mysqli, 
            "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')"
        );

        header("Location: index.php");
        exit();
    }
}
?>