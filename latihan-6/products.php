<?php
$page = 'products';

include 'template/_header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <h2 class="h2">PRODUK</h2>
    </div>

    <!-- Content -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        include 'template/_connection.php';

        $produk = mysqli_query($db, "SELECT * FROM tb_produk");

        while ($result = mysqli_fetch_array($produk)) {
        ?>
            <div class="col">
                <div class="card shadow-sm border-0 rounded-4 position-relative">
                    <img src="<?= $result['foto']; ?>" alt="<?= $result['nama_produk']; ?>" class="card-img-top rounded-top-4 object-fit-cover" width="100%" height="225">
                    <div class="card-body">
                        <h5 class="card-title"><?= $result['nama_produk']; ?></h5>
                        <small class="text-body-secondary"><?= $result['merk'] . " | IDR " . number_format($result['harga'], 0, "", ","); ?></small>
                        <p class="card-text text-overflow-clamp mt-4"><?= $result['deskripsi']; ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="product-detail.php?id_produk=<?= $result['id_produk']; ?>" class="btn btn-sm btn-outline-dark">Lihat selengkapnya</a>
                            <small class="text-body-secondary">Stok: <?= $result['stok']; ?></small>
                        </div>
                    </div>
                    <div class="position-absolute top-0 left-0 py-2 px-3 text-bg-dark custom-rounded fw-medium">
                        <?= $result['tipe']; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
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