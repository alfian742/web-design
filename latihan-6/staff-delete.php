<?php

include 'template/_connection.php';

$nip = $_GET['nip'];

$fotoPegagawai = mysqli_query($db, "SELECT foto FROM tb_pegawai WHERE nip = '$nip'");
$result = mysqli_fetch_array($fotoPegagawai);

$sql = "DELETE FROM tb_pegawai WHERE nip = '$nip'";
$query = mysqli_query($db, $sql);

if ($query) {
    $foto = $result['foto'];

    if ($foto !== 'default.png') {
        $pathFoto = 'img/' . $foto;
        if (file_exists($pathFoto)) {
            unlink($pathFoto);
        }
    }

    header('Location: staff-data.php');
} else {
    header('Location: staff-data.php');
}
