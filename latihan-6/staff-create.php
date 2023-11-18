<?php
$page = 'staffs';

include 'template/_header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <h2 class="h2">PEGAWAI</h2>
    </div>

    <!-- Content -->
    <div class="card rounded-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row gap-2 align-items-center mb-4">
                        <a href="staff-data.php" class="btn btn-dark btn-sm fw-medium"><i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h4 class="h4 mt-2">Tambah Data Pegawai</h4>
                    </div>

                    <?php
                    include 'template/_connection.php';

                    if (isset($_POST['simpan'])) {
                        $nip = htmlspecialchars($_POST['nip']);
                        $nik = htmlspecialchars($_POST['nik']);
                        $nama = htmlspecialchars($_POST['nama']);
                        $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
                        $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
                        $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
                        $telepon = htmlspecialchars($_POST['telepon']);
                        $status_pegawai = htmlspecialchars($_POST['status_pegawai']);
                        $agama = htmlspecialchars($_POST['agama']);

                        $namaFoto = $_FILES['foto']['name'];
                        $tmp = $_FILES['foto']['tmp_name'];

                        $cekNIP = mysqli_query($db, "SELECT nip FROM tb_pegawai WHERE nip = '$nip'");
                        if (mysqli_num_rows($cekNIP) > 0) {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>NIP sudah terdaftar!</strong> Silahkan coba kembali.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        } else {
                            $ekstensiFoto = pathinfo($namaFoto, PATHINFO_EXTENSION);
                            $randomNamaFoto = uniqid() . '.' . $ekstensiFoto;

                            if (move_uploaded_file($tmp, 'img/' . $randomNamaFoto)) {
                                $foto = $randomNamaFoto;
                            };

                            $sql = "INSERT INTO tb_pegawai VALUES ('$nip', '$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$telepon', '$status_pegawai', '$agama', '$foto')";

                            $query = mysqli_query($db, $sql);

                            if ($query) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="staff-data.php">disini</a>.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            } else {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            }
                        }
                    }
                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="nip" name="nip" maxlength="16" autofocus required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="nik" name="nik" maxlength="16" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>

                        <fieldset class="row mb-4">
                            <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-9">
                                <div class="d-flex flex-row gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="jenis_kelamin1" value="L" name="jenis_kelamin" checked>
                                        <label class="form-check-label" for="jenis_kelamin1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="jenis_kelamin2" value="P" name="jenis_kelamin">
                                        <label class="form-check-label" for="jenis_kelamin2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-4">
                            <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="telepon" name="telepon" minlength="10" maxlength="13" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="status_pegawai" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="status_pegawai" name="status_pegawai">
                                    <option value="Menikah" selected>Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                            <div class="col-sm-9">
                                <select class="form-select" id="agama" name="agama">
                                    <option value="Islam" selected>Islam</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Koghuchu">Koghuchu</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="img/default.png" alt="Default" class="object-fit-cover rounded-2 shadow-sm img-preview" width="100" height="100">
                                    </div>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="foto" name="foto" required onchange="previewImage()">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary fw-medium" style="width: 90px;">Simpan</button>
                        <button type="reset" class="btn btn-danger fw-medium" style="width: 90px;">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of content -->

    <!-- Footer -->
    <footer class="py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <span class="fw-medium mt-1">Created by Alfian Hidayat</span>
            <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-angle-up"></i></a>
        </div>
    </footer>
    <!-- End of Footer -->
</main>

<?php include 'template/_footer.php'; ?>