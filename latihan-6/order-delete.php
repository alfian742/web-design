<?php

include 'template/_connection.php';

$id_order = $_GET['id_order'];

$sql = "DELETE FROM tb_order WHERE id_order = '$id_order'";
$query = mysqli_query($db, $sql);

if ($query) {
    header('Location: order-data.php');
} else {
    header('Location: order-data.php');
}
