<?php
require_once("../dbConnection.php");

$id_stok = (int)$_POST['id_stok'];
$jumlah  = (int)$_POST['jumlah'];

$update = mysqli_query($mysqli,
    "UPDATE stok SET jumlah = $jumlah WHERE id_stok = $id_stok"
);

if ($update) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal mengupdate stok: " . mysqli_error($mysqli);
}
?>
