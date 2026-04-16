<?php
require_once("../dbConnection.php");

if (isset($_GET['id_kategori'])) {

    $id_kategori = intval($_GET['id_kategori']);

    mysqli_query($mysqli, 
        "DELETE FROM kategori WHERE id_kategori = $id_kategori"
    );

    header("Location: index.php");
    exit();
}
?>