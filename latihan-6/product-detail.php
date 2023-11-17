<?php
$page = 'products';

include 'template/_header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <h2 class="h2">PRODUK</h2>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col">
            <?php
            include 'template/_connection.php';

            $id_produk = $_GET['id_produk'];

            if (isset($id_produk)) {
                $produk = mysqli_query($db, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'");
                $result = mysqli_fetch_array($produk);
            } else {
                header('Location: products.php');
            }
            ?>
            <div class="card shadow-sm border-0 rounded-4 w-100">
                <div class="card-body">
                    <div class="d-flex flex-row gap-2 align-items-center mb-4">
                        <a href="products.php" class="btn btn-dark btn-sm fw-medium"><i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <h4 class="h4 mt-2">Detail Produk</h4>
                    </div>

                    <img src="<?= $result['foto']; ?>" alt="<?= $result['nama_produk']; ?>" class="rounded-4 object-fit-cover mb-4" width="100%" height="350">

                    <h2 class="card-title text-center mb-4"><?= $result['nama_produk']; ?></h2>

                    <div class="d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-borderless fw-medium">
                                <tr>
                                    <td>Merk</td>
                                    <td>:</td>
                                    <td><?= $result['merk']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe</td>
                                    <td>:</td>
                                    <td><?= $result['tipe']; ?></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td><?= "IDR " . number_format($result['harga'], 0, "", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td><?= $result['stok']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <p class="card-text"><?= $result['deskripsi']; ?></p>
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