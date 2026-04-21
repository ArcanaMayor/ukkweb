<?php
require_once("dbConnection.php");

$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$keyword = isset($_GET['search']) ? $_GET['search'] : "";

$where = "";
if ($keyword != "") {
    $where = "WHERE 
        buku.judul LIKE '%$keyword%' OR 
        penerbit.nama_penerbit LIKE '%$keyword%' OR 
        penulis.nama_penulis LIKE '%$keyword%' OR 
        kategori.nama_kategori LIKE '%$keyword%' OR 
        buku.tahun_terbit LIKE '%$keyword%'";
}

$count = mysqli_query($mysqli, 
    "SELECT COUNT(*) AS total 
     FROM buku 
     LEFT JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
     LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis
     LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
     $where"
);
$total = mysqli_fetch_assoc($count)['total'];
$total_page = ceil($total / $limit);

$result = mysqli_query($mysqli, 
    "SELECT buku.*, penerbit.nama_penerbit, penulis.nama_penulis, kategori.nama_kategori,
            COALESCE(stok.jumlah, 0) AS jumlah_stok, stok.id_stok
     FROM buku
     LEFT JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
     LEFT JOIN penulis ON buku.id_penulis = penulis.id_penulis
     LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
     LEFT JOIN stok ON buku.id_buku = stok.id_buku
     $where
     ORDER BY buku.id_buku DESC
     LIMIT $start, $limit"
);

$jumlah_data = mysqli_num_rows($result);
$prev = ($page > 1) ? $page - 1 : 1;
$next = ($page < $total_page) ? $page + 1 : $total_page;
?>

<html>
<head>
    <title>Aplikasi Katalog Buku</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.jpeg" type="image/png">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">📚 Aplikasi Katalog Buku</div>
        <div class="menu">
            <a href="index.php" class="active">Home</a>
            <a href="kategori">Kategori</a>
            <a href="penerbit">Penerbit</a>
            <a href="penulis">Penulis</a>
            <a href="stok">Stok</a>
        </div>
    </div>
</nav>

<div class="hero">
    <div class="hero-container">
        <h1>Selamat Datang di Aplikasi Katalog Buku Berbasis Website</h1>
        <p>Kelola data Buku, Penulis, Kategori dan Penerbit dengan mudah.</p>
    </div>
</div>

<div class="top-bar">
    <a href="add.php" class="btn-add-icon"><i class="ph ph-plus"></i> Tambah</a>

    <form method="GET" class="form-search">
        <input type="text" name="search" placeholder="Search..." value="<?= $keyword ?>">
        <button type="submit"><i class="ph ph-magnifying-glass"></i></button>
    </form>
</div>

<table class="table-book">
    <thead>
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Kategori</th>
        <th>Ringkasan</th>
        <th class="action-cell">Action</th>
        <th class="stok-cell">Stok</th>
    </tr>
    </thead>
    <tbody>

    <?php while ($res = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $res['judul'] ?></td>
            <td><?= $res['nama_penulis'] ?></td>
            <td><?= $res['nama_penerbit'] ?></td>
            <td><?= $res['tahun_terbit'] ?></td>
            <td><?= $res['nama_kategori'] ?></td>
            <td><?php
                $ringkasan = $res['ringkasan'];
                echo htmlspecialchars(mb_strlen($ringkasan) > 150 ? mb_substr($ringkasan, 0, 150) . '...' : $ringkasan);
            ?></td>

            <td class="action-cell">
                <div class="action-links">
                    <a class="btn-icon btn-icon-edit" href="edit.php?id_buku=<?= $res['id_buku'] ?>" title="Edit"><i class="ph ph-pencil-simple"></i></a>
                    <a class="btn-icon btn-icon-delete"
                       href="delete.php?id_buku=<?= $res['id_buku'] ?>"
                       onclick="return confirm('Yakin ingin hapus?')" title="Hapus"><i class="ph ph-trash"></i></a>
                    <?php if ($res['id_stok']): ?>
                        <a class="btn-icon btn-icon-stok" href="stok/edit.php?id_stok=<?= $res['id_stok'] ?>" title="Edit Stok"><i class="ph ph-package"></i></a>
                    <?php else: ?>
                        <a class="btn-icon btn-icon-add-stok" href="stok/add.php?id_buku=<?= $res['id_buku'] ?>" title="Tambah Stok"><i class="ph ph-plus-circle"></i></a>
                    <?php endif; ?>
                </div>
            </td>

            <td class="stok-cell"><?= (int)$res['jumlah_stok'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<br>

<div class="pagination-wrapper">
	<?php if ($page > 1): ?>
		<a href="?page=<?= $prev ?>&search=<?= $keyword ?>" class="pagination-btn">
			Previous
		</a>
	<?php else: ?>
		<a class="pagination-btn disabled">Previous</a>
	<?php endif; ?>

    <span class="page-info">Halaman <?= $page ?> dari <?= $total_page ?></span>

	<?php if ($page < $total_page): ?>
    <a href="?page=<?= $next ?>&search=<?= $keyword ?>" class="pagination-btn">
        Next
    </a>
	<?php else: ?>
		<a class="pagination-btn disabled">Next</a>
	<?php endif; ?>

</div>

</body>
</html>
