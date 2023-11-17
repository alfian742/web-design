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
                        <h4 class="h4 mt-2">Ubah Data Order</h4>
                    </div>

                    <?php
                    include 'template/_connection.php';

                    $id_order = $_GET['id_order'];

                    if (isset($id_order)) {
                        $order = mysqli_query($db, "SELECT * FROM tb_order WHERE id_order = '$id_order'");
                        $result = mysqli_fetch_array($order);
                    } else {
                        header('Location: order-data.php');
                    }

                    if (isset($_POST['simpan'])) {
                        $nik_konsumen = $result['nik_konsumen'];
                        $id_produk = htmlspecialchars($_POST['id_produk']);
                        $jumlah_pesanan = htmlspecialchars($_POST['jumlah_pesanan']);
                        $tanggal_order = $result['tanggal_order'];

                        $sql = "UPDATE tb_order SET 
                                nik_konsumen = '$nik_konsumen', 
                                id_produk = '$id_produk', 
                                jumlah_pesanan = '$jumlah_pesanan', 
                                tanggal_order = '$tanggal_order'
                                WHERE id_order = '$id_order'";

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
                                <input type="text" class="form-control" id="id_order" name="id_order" disabled value="<?= $result['id_order']; ?>">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="nik_konsumen" class="col-sm-3 col-form-label">Konsumen</label>
                            <div class="col-sm-9">
                                <select class="form-select select-search" id="nik_konsumen" name="nik_konsumen" disabled autofocus>
                                    <?php
                                    $konsumen = mysqli_query($db, "SELECT * FROM tb_konsumen ORDER BY nama");
                                    while ($data = mysqli_fetch_array($konsumen)) {
                                    ?>
                                        <option value="<?= $data['nik']; ?>" <?= ($result['nik_konsumen'] == $data['nik']) ? 'selected' : ''; ?>><?= $data['nama'] . " (" . $data['nik'] . ")"; ?></option>
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
                                        <option value="<?= $data['id_produk']; ?>" <?= ($result['id_produk'] == $data['id_produk']) ? 'selected' : ''; ?>><?= $data['nama_produk']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="jumlah_pesanan" class="col-sm-3 col-form-label">Jumlah Pesanan</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" min="0" max="100" required value="<?= $result['jumlah_pesanan']; ?>">
                            </div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary fw-medium" style="width: 90px;">Simpan</button>
                        <a href="order-data.php" class="btn btn-danger fw-medium" style="width: 90px;">Batal</a>
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