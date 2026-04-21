<?php
require_once("../dbConnection.php");

$result_buku = mysqli_query($mysqli,
    "SELECT buku.id_buku, buku.judul
     FROM buku
     LEFT JOIN stok ON buku.id_buku = stok.id_buku
     WHERE stok.id_stok IS NULL
     ORDER BY buku.judul ASC"
);

$preselect = isset($_GET['id_buku']) ? (int)$_GET['id_buku'] : 0;
?>
<html>
<head>
    <title>Tambah Stok Buku</title>
    <link rel="stylesheet" href="../style1.css">
</head>

<body>
    <h2>Tambah Stok Buku</h2>
    <p>
        <a href="index.php">Home</a>
    </p>

    <form method="post" action="addAction.php" name="add">
        <table width="100%" border="0">
            <tr>
                <td>Buku</td>
                <td>
                    <select name="id_buku" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php while ($buku = mysqli_fetch_assoc($result_buku)) { ?>
                            <option value="<?= $buku['id_buku'] ?>"
                                <?= ($preselect == $buku['id_buku']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($buku['judul']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jumlah Stok</td>
                <td><input type="number" name="jumlah" min="0" value="0" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>
</html>
