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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="h4">Tabel Order</h4>
                        <a href="order-create.php" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i>
                            <span class="ms-2 d-none d-lg-inline">Order</span>
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr class="align-middle">
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">ID Order</th>
                                    <th scope="col">Nama Konsumen</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'template/_connection.php';

                                $sql = "SELECT * FROM tb_order AS o
                                        LEFT JOIN tb_konsumen AS k ON o.nik_konsumen = k.nik
                                        LEFT JOIN tb_produk AS p ON o.id_produk = p.id_produk 
                                        ORDER BY o.tanggal_order DESC";

                                $order = mysqli_query($db, $sql);

                                while ($result = mysqli_fetch_array($order)) {

                                    $total_harga = $result['jumlah_pesanan'] * $result['harga'];
                                ?>
                                    <tr class="align-middle">
                                        <td><?= $result['tanggal_order']; ?></td>
                                        <td><?= $result['id_order']; ?></td>
                                        <td>
                                            <a href="customer-detail.php?nik=<?= $result['nik_konsumen']; ?>" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"><?= $result['nama']; ?></a>
                                        </td>
                                        <td>
                                            <a href="product-detail.php?id_produk=<?= $result['id_produk']; ?>" class="link-dark link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"><?= $result['nama_produk']; ?></a>
                                        </td>
                                        <td><?= $result['jumlah_pesanan']; ?></td>
                                        <td><?= "IDR " . number_format($total_harga, 0, "", ","); ?></td>
                                        <td>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="order-edit.php?id_order=<?= $result['id_order']; ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></a>
                                                <a href="order-delete.php?id_order=<?= $result['id_order']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Data akan dihapus?')"><i class="fa-solid fa-trash"></i></a>
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