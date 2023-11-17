<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 6 - CRUD</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/UTM.png" type="image/png">
    <link rel="apple-touch-icon" href="../assets/img/UTM.png">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- dataTables css -->
    <link rel="stylesheet" href="../assets/datatables/css/dataTables.bootstrap4.min.css">

    <!-- Select2 css -->
    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">

    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="../assets/fontawesome-icons/css/all.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="text-bg-light">
    <!-- Headder -->
    <header class="navbar sticky-top text-bg-primary flex-md-nowrap p-0 shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white fw-medium d-none d-lg-inline" href="index.html">
            <div class="d-flex flex-row align-items-center gap-2">
                <span>My Website</span>
            </div>
        </a>

        <!-- Button trigger offcanvas -->
        <button class="nav-link px-3 text-white d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="d-flex flex-row gap-2 align-items-center">
            <div class="dropdown me-1">
                <a href="#" class="d-block link-body-emphasis dropdown-toggle dropdown-profile" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="navbar-brand">
                        <img src="../assets/img/profile.png" alt="Profile" width="32" height="32" class="rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <li>
                        <a class="dropdown-item" href="#profile">
                            <div class="d-flex flex-row gap-3 align-items-center">
                                <i class="fa-solid fa-user"></i> Profil
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="#sign-out">
                            <div class="d-flex flex-row gap-3 align-items-center">
                                <i class="fa-solid fa-right-from-bracket"></i> Keluar
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- End of header -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-white">
                <div class="offcanvas-md offcanvas-start bg-white" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">
                            <div class="d-flex flex-row gap-2 align-items-center">
                                My Website
                            </div>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <hr class="d-lg-none">
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column gap-2 px-3">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 <?= ($page == 'dashboard') ? 'active' : ''; ?>" href="index.php">
                                    <i class="fa-solid fa-dashboard"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 <?= ($page == 'products') ? 'active' : ''; ?>" href="products.php">
                                    <i class="fa-solid fa-cubes"></i>
                                    Produk
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 <?= ($page == 'orders') ? 'active' : ''; ?>" href="order-data.php">
                                    <i class="fa-solid fa-table"></i>
                                    Order
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 <?= ($page == 'customers') ? 'active' : ''; ?>" href="customer-data.php">
                                    <i class="fa-solid fa-users"></i>
                                    Konsumen
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-3 <?= ($page == 'staffs') ? 'active' : ''; ?>" href="staff-data.php">
                                    <i class="fa-solid fa-users"></i>
                                    Pegawai
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End of sidebar -->