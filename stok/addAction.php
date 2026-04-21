<?php
require_once("../dbConnection.php");

$id_buku = (int)$_POST['id_buku'];
$jumlah  = (int)$_POST['jumlah'];

if ($id_buku <= 0) {
    header("Location: add.php");
    exit;
}

// Cek apakah sudah ada stok untuk buku ini
$cek = mysqli_query($mysqli, "SELECT id_stok FROM stok WHERE id_buku = $id_buku");
if (mysqli_num_rows($cek) > 0) {
    // Sudah ada, redirect ke edit
    $row = mysqli_fetch_assoc($cek);
    header("Location: edit.php?id_stok=" . $row['id_stok']);
    exit;
}

$insert = mysqli_query($mysqli,
    "INSERT INTO stok (id_buku, jumlah) VALUES ($id_buku, $jumlah)"
);

if ($insert) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menyimpan stok: " . mysqli_error($mysqli);
}
?>
