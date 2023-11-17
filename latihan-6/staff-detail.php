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
                        <h4 class="h4 mt-2">Detail Pegawai</h4>
                    </div>

                    <?php
                    include 'template/_connection.php';

                    $nip = $_GET['nip'];

                    $pegawai = mysqli_query($db, "SELECT * FROM tb_pegawai WHERE nip = '$nip'");
                    $result = mysqli_fetch_array($pegawai);
                    ?>

                    <div class="row">
                        <div class="col-sm-3">
                            <img src="img/<?= $result['foto']; ?>" alt="<?= $result['nama']; ?>" height="200" width="200" class="rounded-2 shadow-sm object-fit-cover d-block mx-auto mb-4">
                        </div>
                        <div class="col-sm-9">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Nomor Induk Pegawai</td>
                                        <td>:</td>
                                        <td><?= $result['nip']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Induk Keluarga</td>
                                        <td>:</td>
                                        <td><?= $result['nik']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $result['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tempat/Tanggal Lahir</td>
                                        <td>:</td>
                                        <td><?= $result['tempat_lahir'] . ", " . $result['tanggal_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td><?= ($result['jenis_kelamin'] == 'L') ? 'Laki-Laki' : (($result['jenis_kelamin'] == 'P') ? 'Perempuan' : ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>:</td>
                                        <td><?= $result['telepon']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td><?= $result['status_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>:</td>
                                        <td><?= $result['agama']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
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