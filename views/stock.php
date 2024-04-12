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
                                <a class="nav-link text-white" href="./home.php">
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
                                <a class="nav-link active text-black" href="./stock.php">
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
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="my-4 text-center">Stock Obat</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Stock Obat
                            </div>
                            <div class="card-body">              
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Satuan</th>  
                                            <th>Jumlah Stock</th>   
                                            <th>Action</th>                                                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM stock";
                                            $result = mysqli_query($koneksi, $query);

                                            $no = 1;
                                            while ($data = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++?></td>                                         
                                            <td><?= $data['nama_obat'] ?></td>
                                            <td><?= $data['satuan'] ?></td>
                                            <td><?= $data['jumlah_stock'] ?></td>
                                            <td>
                                                <ul class="list-inline d-flex justify-content-evenly">
                                                    <li><a href="./editstock.php?id=<?= $data['id'] ?>" class="btn btn-success">Edit</a></li>
                                                    <li>
                                                        <form action="../proses/deletestock.php" method="post">
                                                            <input type="hidden" name="nama_obat" value="<?= $data['nama_obat'] ?>">
                                                            <button class="btn btn-danger text-light">Delete</button>
                                                        </form>
                                                    </li>                                       
                                                </ul>
                                            </td>                                                                                                                              
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Muhammad Naufal Al Hazmi 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
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
