<?php
$page = 'dashboard';

include 'template/_header.php';

include 'template/_connection.php';

// Jumlah produk
$produk = mysqli_query($db, "SELECT COUNT(*) AS jumlah_produk FROM tb_produk");
$jumlah_produk = mysqli_fetch_array($produk);

// Total order
$order = mysqli_query($db, "SELECT * FROM tb_order AS o LEFT JOIN tb_konsumen AS k ON o.nik_konsumen = k.nik LEFT JOIN tb_produk AS p ON o.id_produk = p.id_produk");
$total_order = 0;
if ($order) {
    while ($jumlah_order = mysqli_fetch_array($order)) {
        $total_order += $jumlah_order['jumlah_pesanan'] * $jumlah_order['harga'];
    }
}

// Jumlah konsumen
$konsumen = mysqli_query($db, "SELECT COUNT(*) AS jumlah_konsumen FROM tb_konsumen");
$jumlah_konsumen = mysqli_fetch_array($konsumen);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-3">
        <h2 class="h2">DASHBOARD</h2>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-sm-4 mb-4">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-column gap-1">
                            <h4 class="card-title">Produk</h4>
                            <span class="text-muted"><?= $jumlah_produk['jumlah_produk']; ?></span>
                        </div>
                        <p class="fs-2 mt-3"><i class="fa-solid fa-cubes"></i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-4">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-column gap-1">
                            <h4 class="card-title">Order</h4>
                            <span class="text-muted"><?= "IDR " . number_format($total_order, 0, "", ","); ?></span>
                        </div>
                        <p class="fs-2 mt-3"><i class="fa-solid fa-table"></i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-4">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-column gap-1">
                            <h4 class="card-title">Konsumen</h4>
                            <span class="text-muted"><?= $jumlah_konsumen['jumlah_konsumen']; ?></span>
                        </div>
                        <p class="fs-2 mt-3"><i class="fa-solid fa-users"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mb-4">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="h4 mb-4">Pendapatan 2023 (IDR)</h4>
                    <canvas class="mb-4 w-100" id="myChart" width="900" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mb-4">
            <div class="card rounded-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="h4">Order</h4>
                        <a href="order-data.php" class="btn btn-primary btn-sm">Lihat Selengkapnya</a>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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

<!-- Chart.js -->
<script src="js/chart.js"></script>

<?php
// Sintaks SQL
$sql = "SELECT * FROM tb_order AS o
        LEFT JOIN tb_konsumen AS k ON o.nik_konsumen = k.nik
        LEFT JOIN tb_produk AS p ON o.id_produk = p.id_produk";

$order = mysqli_query($db, $sql);

// Inisialisasi array untuk label bulan dan data total harga
$labels = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

// Inisialisasi array untuk data total harga per bulan
$totalHargaData = array_fill(0, 12, 0);

// Iterasi melalui hasil query
while ($row = mysqli_fetch_array($order)) {
    // Ambil bulan dari tanggal_order (misalnya, jika tanggal_order adalah format tanggal)
    $bulan = date('n', strtotime($row['tanggal_order'])) - 1; // -1 karena indeks array dimulai dari 0

    // Hitung total harga
    $total_harga = $row['jumlah_pesanan'] * $row['harga'];

    // Tambahkan total harga ke array data total harga sesuai dengan bulan
    $totalHargaData[$bulan] += $total_harga;
}
?>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                data: <?= json_encode($totalHargaData); ?>,
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    boxPadding: 3
                }
            }
        }
    });
</script>

<?php include 'template/_footer.php'; ?>