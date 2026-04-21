<?php
require_once("../dbConnection.php");

$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$keyword = isset($_GET['search']) ? $_GET['search'] : "";
$where = "";
if ($keyword != "") {
    $where = "WHERE nama_kategori LIKE '%$keyword%'";
}

$count = mysqli_query($mysqli, 
    "SELECT COUNT(*) AS total FROM kategori $where"
);

$total = mysqli_fetch_assoc($count)['total'];
$total_page = ceil($total / $limit);

$result = mysqli_query($mysqli, 
    "SELECT * FROM kategori $where ORDER BY id_kategori DESC LIMIT $start, $limit"
);

$jumlah_data = mysqli_num_rows($result);
$prev = ($page > 1) ? $page - 1 : 1;
$next = ($page < $total_page) ? $page + 1 : $total_page;
?>

<html>
<head>	
	<title>Kategori</title>
    <link rel="icon" href="icon.jpeg" type="image/png">
	<link rel="stylesheet" href="../style.css">
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-container">
        <div class="logo">📚 Aplikasi Katalog Buku</div>

        <div class="menu">
            <a href="../index.php">Home</a>
            <a class="active" href="index.php">Kategori</a>
            <a href="../penerbit">Penerbit</a>
            <a href="../penulis">Penulis</a>
            <a href="../stok">Stok</a>
        </div>
    </div>
</div>

<h3>Kategori Buku</h3>

<div class="top-bar">
    <a href="add.php" class="btn-add-icon"><i class="ph ph-plus"></i> Tambah</a>

    <form method="GET" class="form-search">
        <input type="text" name="search" placeholder="Search..." value="<?= $keyword ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<table class="table-book">
    <thead>
    <tr>
        <th>Nama Kategori</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    <?php while ($res = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $res['nama_kategori'] ?></td>
            <td>
                <a class="btn-icon btn-icon-edit" href="edit.php?id_kategori=<?= $res['id_kategori'] ?>" title="Edit"><i class="ph ph-pencil-simple"></i></a>
                <a class="btn-icon btn-icon-delete" href="delete.php?id_kategori=<?= $res['id_kategori'] ?>"
                   onclick="return confirm('Yakin ingin menghapus?')" title="Hapus"><i class="ph ph-trash"></i></a>
            </td>
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
