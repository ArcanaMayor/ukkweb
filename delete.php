<?php
require_once("dbConnection.php");

$id_buku = $_GET['id_buku'];

$result = mysqli_query($mysqli, "DELETE FROM buku WHERE id_buku = $id_buku");

header("Location:index.php");
