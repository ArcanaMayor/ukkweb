<?php
require_once("../dbConnection.php");

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$keyword = isset($_GET['search']) ? $_GET['search'] : "";
$where = "";
if ($keyword != "") {
    $where = "WHERE buku.judul LIKE '%$keyword%'";
}

$count = mysqli_query($mysqli,
    "SELECT COUNT(*) AS total
     FROM stok
     LEFT JOIN buku ON stok.id_buku = buku.id_buku
     $where"
);
$total = mysqli_fetch_assoc($count)['total'];
$total_page = ceil($total / $limit);
if ($total_page == 0) $total_page = 1;

$result = mysqli_query($mysqli,
    "SELECT stok.*, buku.judul
     FROM stok
     LEFT JOIN buku ON stok.id_buku = buku.id_buku
     $where
     ORDER BY stok.id_stok DESC
     LIMIT $start, $limit"
);

$prev = ($page > 1) ? $page - 1 : 1;
$next = ($page < $total_page) ? $page + 1 : $total_page;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Stok Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<nav class="navbar">
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
</nav>

<h3>Daftar Stok Buku</h3>

<div class="top-bar">
    <form method="GET" class="form-search">
        <input type="text" name="search" placeholder="Cari judul buku..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<table class="table-book">
    <tr>
        <th>ID Stok</th>
        <th>Judul Buku</th>
        <th>Jumlah Stok</th>
        <th>Action</th>
    </tr>

    <?php while ($res = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $res['id_stok'] ?></td>
            <td><?= htmlspecialchars($res['judul']) ?></td>
            <td><?= $res['jumlah'] ?></td>
            <td>
                <a class="edit" href="edit.php?id_stok=<?= $res['id_stok'] ?>">Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>

<div class="pagination-wrapper">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $prev ?>&search=<?= urlencode($keyword) ?>" class="pagination-btn">Previous</a>
    <?php else: ?>
        <a class="pagination-btn disabled">Previous</a>
    <?php endif; ?>

    <span class="page-info">Halaman <?= $page ?> dari <?= $total_page ?></span>

    <?php if ($page < $total_page): ?>
        <a href="?page=<?= $next ?>&search=<?= urlencode($keyword) ?>" class="pagination-btn">Next</a>
    <?php else: ?>
        <a class="pagination-btn disabled">Next</a>
    <?php endif; ?>
</div>

</body>
</html>
