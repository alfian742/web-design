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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="h4">Tabel Pegawai</h4>
                        <a href="staff-create.php" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i>
                            <span class="ms-2 d-none d-lg-inline">Pegawai</span>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col">Foto</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tempat/Tanggal Lahir</th>
                                    <th scope="col">L/P</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'template/_connection.php';

                                $pegawai = mysqli_query($db, "SELECT * FROM tb_pegawai ORDER BY nama ASC");

                                while ($result = mysqli_fetch_array($pegawai)) {
                                ?>
                                    <tr class="align-middle">
                                        <td><img src="img/<?= $result['foto']; ?>" alt="<?= $result['nama']; ?>" class="rounded-2 shadow-sm object-fit-cover" width="50" height="50"></td>
                                        <td><?= $result['nip']; ?></td>
                                        <td><?= $result['nama']; ?></td>
                                        <td><?= $result['tempat_lahir'] . ", " . $result['tanggal_lahir']; ?></td>
                                        <td><?= $result['jenis_kelamin']; ?></td>
                                        <td>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="staff-detail.php?nip=<?= $result['nip']; ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-info-circle"></i></a>
                                                <a href="staff-edit.php?nip=<?= $result['nip']; ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
                                                <a href="staff-delete.php?nip=<?= $result['nip']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Data akan dihapus?')"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }; ?>
                            </tbody>
                        </table>
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