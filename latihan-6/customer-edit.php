<?php
$page = 'customers';

include 'template/_header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <h2 class="h2">KONSUMEN</h2>
    </div>

    <!-- Content -->
    <div class="card rounded-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row gap-2 align-items-center mb-4">
                        <a href="customer-data.php" class="btn btn-dark btn-sm fw-medium"><i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h4 class="h4 mt-2">Ubah Data Konsumen</h4>
                    </div>

                    <?php
                    include 'template/_connection.php';

                    $nik = $_GET['nik'];

                    if (isset($nik)) {
                        $konsumen = mysqli_query($db, "SELECT * FROM tb_konsumen WHERE nik = '$nik'");
                        $result = mysqli_fetch_array($konsumen);
                    } else {
                        header('Location: customer-data.php');
                    }

                    if (isset($_POST['simpan'])) {
                        $nama = htmlspecialchars($_POST['nama']);
                        $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
                        $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
                        $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
                        $telepon = htmlspecialchars($_POST['telepon']);

                        $namaFoto = $_FILES['foto']['name'];
                        $tmp = $_FILES['foto']['tmp_name'];

                        if (strlen($namaFoto) > 0) {
                            $size = $_FILES['foto']['size'];
                            $ekstensiFoto = pathinfo($namaFoto, PATHINFO_EXTENSION);
                            $randomNamaFoto = uniqid() . '.' . $ekstensiFoto;

                            if (!in_array($ekstensiFoto, ['jpg', 'jpeg', 'png'])) {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Format tidak didukung!</strong> Silahkan unggah foto dengan tipe JPG/JPEG/PNG.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            } elseif ($size > 1000000) {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Ukuran foto terlalu besar!</strong> Silahkan unggah foto maksimal 1MB.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            } else {
                                if (move_uploaded_file($tmp, 'img/' . $randomNamaFoto)) {
                                    $foto = $randomNamaFoto;

                                    $fotoLama = $result['foto'];
                                    if ($fotoLama !== 'default.png') {
                                        $pathFoto = 'img/' . $fotoLama;
                                        if (file_exists($pathFoto)) {
                                            unlink($pathFoto);
                                        }
                                    }
                                };

                                $sql = "UPDATE tb_konsumen SET
                                        nama = '$nama', 
                                        tempat_lahir = '$tempat_lahir',
                                        tanggal_lahir = '$tanggal_lahir', 
                                        jenis_kelamin = '$jenis_kelamin', 
                                        telepon = '$telepon',
                                        foto = '$foto'
                                        WHERE nik = '$nik'";

                                $query = mysqli_query($db, $sql);

                                if ($query) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="customer-data.php">disini</a>.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                } else {
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                }
                            }
                        } else {
                            $sql = "UPDATE tb_konsumen SET
                                    nama = '$nama', 
                                    tempat_lahir = '$tempat_lahir',
                                    tanggal_lahir = '$tanggal_lahir', 
                                    jenis_kelamin = '$jenis_kelamin', 
                                    telepon = '$telepon'
                                    WHERE nik = '$nik'";

                            $query = mysqli_query($db, $sql);

                            if ($query) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="customer-data.php">disini</a>.
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

                    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row mb-4">
                            <label for="nik" class="col-sm-3 col-form-label">NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="nik" name="nik" disabled value="<?= $result['nik']; ?>">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="nama" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama" required value="<?= $result['nama']; ?>">
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Nama harus diisi!
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required value="<?= $result['tempat_lahir']; ?>">
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Tempat lahir harus diisi!
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required value="<?= $result['tanggal_lahir']; ?>">
                                <div class="valid-feedback">
                                </div>
                                <div class="invalid-feedback">
                                    Tanggal lahir harus diisi!
                                </div>
                            </div>
                        </div>

                        <fieldset class="row mb-4">
                            <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin <span class="text-danger">*</span></legend>
                            <div class="col-sm-9">
                                <div class="d-flex flex-row gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="jenis_kelamin1" value="L" name="jenis_kelamin" <?= ($result['jenis_kelamin'] == "L") ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="jenis_kelamin1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="jenis_kelamin2" value="P" name="jenis_kelamin" <?= ($result['jenis_kelamin'] == "P") ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="jenis_kelamin2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-4">
                            <label for="telepon" class="col-sm-3 col-form-label">Telepon <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="telepon" name="telepon" required value="<?= $result['telepon']; ?>">
                                <div class="valid-feedback">
                                    Bagus!
                                </div>
                                <div class="invalid-feedback">
                                    Nomor telepon harus diisi!
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="img/<?= $result['foto']; ?>" alt="<?= $result['nama']; ?>" class="object-fit-cover rounded-2 shadow-sm img-preview" width="100" height="100">
                                    </div>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">
                                        <small>Ukuran foto maksimal 1 MB dengan format JPG/JPEG/PNG.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary fw-medium" style="width: 90px;">Simpan</button>
                        <a href="customer-data.php" class="btn btn-danger fw-medium" style="width: 90px;">Batal</a>
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