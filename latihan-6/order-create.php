<?php
$page = 'orders';

include 'template/_header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <h2 class="h2">ORDER</h2>
    </div>

    <!-- Content -->
    <div class="card rounded-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-row gap-2 align-items-center mb-4">
                        <a href="order-data.php" class="btn btn-dark btn-sm fw-medium"><i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h4 class="h4 mt-2">Tambah Data Order</h4>
                    </div>

                    <?php
                    include 'template/_connection.php';

                    $randomIdOrder = 'ID' . str_pad(mt_rand(1, 99999), 3, '0', STR_PAD_LEFT);

                    if (isset($_POST['simpan'])) {
                        $id_order = $randomIdOrder;
                        $nik_konsumen = htmlspecialchars($_POST['nik_konsumen']);
                        $id_produk = htmlspecialchars($_POST['id_produk']);
                        $jumlah_pesanan = htmlspecialchars($_POST['jumlah_pesanan']);

                        $sql = "INSERT INTO tb_order VALUES ('$id_order', '$nik_konsumen', '$id_produk', '$jumlah_pesanan', CURRENT_DATE())";

                        $query = mysqli_query($db, $sql);

                        if ($query) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="order-data.php">disini</a>.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        } else {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="row mb-4">
                            <label for="id_order" class="col-sm-3 col-form-label">ID Order</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="id_order" name="id_order" readonly value="<?= $randomIdOrder; ?>">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="nik_konsumen" class="col-sm-3 col-form-label">Konsumen</label>
                            <div class="col-sm-9">
                                <select class="form-select select-search" id="nik_konsumen" name="nik_konsumen" autofocus>
                                    <?php
                                    $konsumen = mysqli_query($db, "SELECT * FROM tb_konsumen ORDER BY nama");
                                    while ($data = mysqli_fetch_array($konsumen)) {
                                    ?>
                                        <option value="<?= $data['nik']; ?>"><?= $data['nik'] . " - " . $data['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="id_produk" class="col-sm-3 col-form-label">Produk</label>
                            <div class="col-sm-9">
                                <select class="form-select select-search" id="id_produk" name="id_produk">
                                    <?php
                                    $produk = mysqli_query($db, "SELECT * FROM tb_produk");
                                    while ($data = mysqli_fetch_array($produk)) {
                                    ?>
                                        <option value="<?= $data['id_produk']; ?>"><?= $data['id_produk'] . " - " . $data['nama_produk']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="jumlah_pesanan" class="col-sm-3 col-form-label">Jumlah Pesanan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" min="0" max="100" required>
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