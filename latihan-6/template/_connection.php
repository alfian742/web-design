<?php

$db = mysqli_connect("localhost", "root", "", "crud_perusahaan");

if (!$db) {
    echo "Koneksi ke database gagal: " . mysqli_connect_error($db);
}
