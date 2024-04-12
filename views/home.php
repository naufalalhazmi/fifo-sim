<?php 
    include '../config/koneksi.php';
// Mulai sesi
session_start();

// Periksa status login pengguna
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika pengguna belum login, alihkan ke halaman login
    header("Location: ../index.php");
    exit();
}

// Set header-cache untuk mencegah caching halaman
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Konten halaman yang memerlukan autentikasi
// ...
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            html, body {
        height: 100%;
    }

    #layoutSidenav {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #layoutSidenav_content {
        flex: 1 0 auto;
    }
        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        .card-text {
            font-size: 18px;
            color: #333;
        }

        .card-primary .card-body {
            background-color: #007bff;
        }

        .card-success .card-body {
            background-color: #28a745;
        }

        .card-warning .card-body {
            background-color: #ffc107;
        }

        .card-danger .card-body {
            background-color: #dc3545;
        }
    </style>
    </head>
    <body class="sb-nav-fixed">
    <?php 
    // Mengambil data pengeluaran terbaru
    $queryPengeluaranTerbaru = "SELECT * FROM pengeluaran ORDER BY tanggal_keluar DESC LIMIT 5";
    $resultPengeluaranTerbaru = mysqli_query($koneksi, $queryPengeluaranTerbaru);

    // Mengambil data pengeluaran terbaru dengan informasi nama_obat dan tujuan
    $queryPengeluaranTerbaru = "SELECT p.*, o.nama_obat, p.tujuan
    FROM pengeluaran p
    INNER JOIN obat o ON p.id_obat = o.id_obat
    ORDER BY p.tanggal_keluar DESC
    LIMIT 5";

    $resultPengeluaranTerbaru = mysqli_query($koneksi, $queryPengeluaranTerbaru);

    // Query untuk mengambil obat dengan tanggal kadaluwarsa dalam 14 hari ke depan
    $queryKadaluwarsaTerdekat = "SELECT nama_obat, jumlah_stock, tanggal_kadaluarsa
    FROM obat
    WHERE tanggal_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 14 DAY)
    ORDER BY tanggal_kadaluarsa ASC";

    $resultKadaluwarsaTerdekat = mysqli_query($koneksi, $queryKadaluwarsaTerdekat);

    // Total Stock Obat
    // Query SQL untuk menghitung jumlah total stock
    $query = "SELECT SUM(jumlah_stock) AS total_stock FROM obat;";
    $result = mysqli_query($koneksi, $query);
    // Periksa apakah query berhasil dieksekusi
    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }
    // Ambil data hasil query
    $data = mysqli_fetch_assoc($result);
    // Jumlah total stock
    $totalStock = $data['total_stock'];
    // Tampilkan jumlah total stock
    echo "Jumlah total stock: " . $totalStock;

    // JUmlah Obat Keluar
    // Query SQL untuk menghitung jumlah obat keluar
    $query = "SELECT SUM(jumlah_keluar) AS total_keluar FROM pengeluaran;";
    $result = mysqli_query($koneksi, $query);
    // Periksa apakah query berhasil dieksekusi
    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }
    // Ambil data hasil query
    $data = mysqli_fetch_assoc($result);
    // Jumlah total stock
    $totalKeluar = $data['total_keluar'];
    // Tampilkan jumlah total keluar
    echo "Jumlah total keluar: " . $totalKeluar;
    ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-warning">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Gudang Farmasi</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-secondary bg-warning" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link  active text-black" href="./home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link text-white" href="./obat.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                                Obat Masuk
                            </a>
                            <a class="nav-link text-white" href="./pengeluaran.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-field"></i></div>
                                Pengeluaran Obat
                            </a>
                            <a class="nav-link text-white" href="./stock.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-warehouse"></i></div>
                                Stock Obat
                            </a>
                            <a class="nav-link text-white" href="./cetak.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-simple"></i></div>
                                Cetak Data
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <a class="btn btn-danger ms-auto me-2" href="../proses/logout.php">Logout</a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <div class="container">
                    <h1 class="text-center my-4">Home</h1>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-3 col-lg-3 mb-3">
                            <div class="card card-primary mx-auto">
                                <div class="card-body text-light">
                                    <h3 class="card-title">Jumlah Total Obat</h3>
                                    <p class="card-text text-light"><?php echo $totalStock; ?></p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-primary">
                                    <a class="small text-white stretched-link" href="./stock.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 mb-3">
                            <div class="card card-warning mx-auto">
                                <div class="card-body text-light">
                                    <h3 class="card-title">Jumlah Obat Keluar</h3>
                                    <p class="card-text text-light"><?php echo $totalKeluar; ?></p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between bg-warning">
                                    <a class="small text-white stretched-link" href="./pengeluaran.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Pengeluaran Obat Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <?php
                                    while ($dataPengeluaran = mysqli_fetch_assoc($resultPengeluaranTerbaru)) {
                                        echo '<li class="list-group-item">' . $dataPengeluaran['tanggal_keluar'] . ' - ' . $dataPengeluaran['nama_obat'] . ' - ' . $dataPengeluaran['tujuan'] . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Kadaluarsa Terdekat</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <?php
                                    while ($dataKadaluwarsaTerdekat = mysqli_fetch_assoc($resultKadaluwarsaTerdekat)) {
                                        $namaObatTerdekat = $dataKadaluwarsaTerdekat['nama_obat'];
                                        $jumlahStokTerdekat = $dataKadaluwarsaTerdekat['jumlah_stock'];
                                        $tanggalKadaluwarsaTerdekat = $dataKadaluwarsaTerdekat['tanggal_kadaluarsa'];
                                    ?>
                                        <li class="list-group-item">
                                            <?php echo $namaObatTerdekat; ?> - Jumlah Stok: <?php echo $jumlahStokTerdekat; ?> - Kadaluwarsa: <?php echo $tanggalKadaluwarsaTerdekat; ?>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Peringatan Stok Terendah</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <?php
                                        // Query untuk mengambil obat dengan stok <= 5 dari tabel stock
                                        $queryStokTerendah = "SELECT nama_obat, jumlah_stock FROM stock WHERE jumlah_stock <= 5";
                                        $resultStokTerendah = mysqli_query($koneksi, $queryStokTerendah);

                                        while ($dataStokTerendah = mysqli_fetch_assoc($resultStokTerendah)) {
                                            $namaObatTerendah = $dataStokTerendah['nama_obat'];
                                            $jumlahStokTerendah = $dataStokTerendah['jumlah_stock'];
                                        ?>
                                            <li class="list-group-item">
                                                <?php echo $namaObatTerendah; ?> - Jumlah Stok: <?php echo $jumlahStokTerendah; ?>
                                                <span class="badge bg-warning text-dark">Stok Tersisa <?php echo $jumlahStokTerendah; ?></span>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div
                    </div>
                </div>



            </div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; Muhammad Naufal Al Hazmi 2023</div>
                        </div>
                    </div>
                </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>