<?php
require_once("../dbConnection.php");

$id_stok = (int)$_GET['id_stok'];

$result = mysqli_query($mysqli,
    "SELECT stok.*, buku.judul
     FROM stok
     LEFT JOIN buku ON stok.id_buku = buku.id_buku
     WHERE id_stok = $id_stok"
);

$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Stok Buku</title>
    <link rel="stylesheet" href="../style1.css">
</head>
<body>

<!-- <nav class="navbar">
    <div class="nav-container">
        <div class="logo">📚 Aplikasi Katalog Buku</div>
        <div class="menu">
            <a href="../index.php">Home</a>
            <a href="../kategori">Kategori</a>
            <a href="../penerbit">Penerbit</a>
            <a href="../penulis">Penulis</a>
            <a class="active" href="index.php">Stok</a>
        </div>
    </div>
</nav> -->

<h3>Edit Stok Buku</h3>
<p><a href="index.php">Home</a></p>

<form name="editStok" method="post" action="editAction.php">
    <table width="100%" border="0">
        <tr>
            <td>ID Stok</td>
            <td>
                <input type="text" value="<?= $data['id_stok'] ?>" readonly>
                <input type="hidden" name="id_stok" value="<?= $data['id_stok'] ?>">
            </td>
        </tr>
        <tr>
            <td>Judul Buku</td>
            <td>
                <input type="text" value="<?= htmlspecialchars($data['judul']) ?>" readonly>
                <input type="hidden" name="id_buku" value="<?= $data['id_buku'] ?>">
            </td>
        </tr>
        <tr>
            <td>Jumlah Stok</td>
            <td>
                <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" min="0" required>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="update" value="Update Stok">
            </td>
        </tr>
    </table>
</form>

</body>
</html>
