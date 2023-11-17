<?php

include 'template/_connection.php';

$nik = $_GET['nik'];

$fotoKonsumen = mysqli_query($db, "SELECT foto FROM tb_konsumen WHERE nik = '$nik'");
$result = mysqli_fetch_array($fotoKonsumen);

$sql = "DELETE FROM tb_konsumen WHERE nik = '$nik'";
$query = mysqli_query($db, $sql);

if ($query) {
    $foto = $result['foto'];

    if ($foto !== 'default.png') {
        $pathFoto = 'img/' . $foto;
        if (file_exists($pathFoto)) {
            unlink($pathFoto);
        }
    }
    header('Location: customer-data.php');
} else {
    header('Location: customer-data.php');
}
