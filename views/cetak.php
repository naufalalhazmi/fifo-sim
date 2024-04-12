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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Data</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-html5-2.4.0/b-print-2.4.0/datatables.min.css" rel="stylesheet">
    
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
        /* Tambahkan border antara thead dan tbody */
        table.dataTable thead th {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body class="sb-nav-fixed">
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
                        <a class="nav-link text-white" href="./stock.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-warehouse"></i></div>
                            Stock Obat
                        </a>
                        <a class="nav-link active text-black" href="./cetak.php">
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
                    <h1 class="my-4 text-center">Cetak Data</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Obat Masuk
                        </div>
                        <div class="card-body">
                            <form method="get" action="cetak.php">
                                <div class="mb-3">
                                    <label for="tanggal_filter">Filter Tanggal:</label>
                                    <input type="date" name="tanggal_filter" id="tanggal_filter">
                                    <select name="filter_type" id="filter_type">
                                        <option value="day">Hari</option>
                                        <option value="month">Bulan</option>
                                        <option value="year">Tahun</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="cetak.php" class="btn btn-danger">Hapus Filter</a>
                                </div>
                            </form>
                            <table id="datatablesSimple" class="table table-bordered pt-2">
                                <thead>
                                    <tr>
                                        <th>ID Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah Stock</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Kadaluarsa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Cek apakah parameter tanggal_filter dan filter_type ada dalam URL
                                    if (isset($_GET['tanggal_filter']) && isset($_GET['filter_type'])) {
                                        $tanggal_filter = $_GET['tanggal_filter'];
                                        $filter_type = $_GET['filter_type'];

                                        // Konversi format tanggal ke format yang sesuai dalam database (Y-m-d)
                                        $tanggal_filter = date('Y-m-d', strtotime($tanggal_filter));

                                        // Modifikasi query berdasarkan filter_type yang dipilih
                                        if ($filter_type === 'day') {
                                            $query = "SELECT * FROM obat WHERE DATE(tanggal_masuk) = '$tanggal_filter'";
                                        } elseif ($filter_type === 'month') {
                                            // Dapatkan tahun dan bulan dari tanggal_filter
                                            $tahun_filter = date('Y', strtotime($tanggal_filter));
                                            $bulan_filter = date('m', strtotime($tanggal_filter));
                                            $query = "SELECT * FROM obat WHERE YEAR(tanggal_masuk) = '$tahun_filter' AND MONTH(tanggal_masuk) = '$bulan_filter'";
                                        } elseif ($filter_type === 'year') {
                                            // Dapatkan tahun dari tanggal_filter
                                            $tahun_filter = date('Y', strtotime($tanggal_filter));
                                            $query = "SELECT * FROM obat WHERE YEAR(tanggal_masuk) = '$tahun_filter'";
                                        }
                                    } else {
                                        // Jika tidak ada parameter tanggal_filter, tampilkan semua data
                                        $query = "SELECT * FROM obat";
                                    }

                                    $result = mysqli_query($koneksi, $query);

                                    while ($data = mysqli_fetch_assoc($result)) {
                                        // Tampilkan data sesuai kebutuhan
                                        ?>
                                        <tr>
                                            <td><?= $data['id_obat'] ?></td>
                                            <td><?= $data['nama_obat'] ?></td>
                                            <td><?= $data['jumlah_stock'] ?></td>
                                            <td><?= $data['tanggal_masuk'] ?></td>
                                            <td><?= $data['tanggal_kadaluarsa'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a id="top-of-table2"></a>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Pengeluaran Obat
                        </div>
                        <div class="card-body">
                            <form method="get" action="cetak.php#top-of-table2">
                                <div class="mb-3">
                                    <label for="tanggal_filter">Filter Tanggal:</label>
                                    <input type="date" name="tanggal_filter" id="tanggal_filter">
                                    <select name="filter_type" id="filter_type">
                                        <option value="day">Hari</option>
                                        <option value="month">Bulan</option>
                                        <option value="year">Tahun</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="cetak.php#top-of-table2" class="btn btn-danger">Hapus Filter</a>
                                </div>
                            </form>                           
                            <table id="datatablesSimple2" class="table table-bordered pt-2">
                                <thead>
                                    <tr>
                                        <th>ID Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Tujuan</th>
                                        <th>Harga</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Dokumen</th>                                                                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Cek apakah parameter tanggal_filter dan filter_type ada dalam URL
                                        if (isset($_GET['tanggal_filter']) && isset($_GET['filter_type'])) {
                                            $tanggal_filter = $_GET['tanggal_filter'];
                                            $filter_type = $_GET['filter_type'];

                                            // Konversi format tanggal ke format yang sesuai dalam database (Y-m-d)
                                            $tanggal_filter = date('Y-m-d', strtotime($tanggal_filter));

                                            // Modifikasi query berdasarkan filter_type yang dipilih
                                            if ($filter_type === 'day') {
                                                $query = "SELECT * FROM pengeluaran WHERE DATE(tanggal_keluar) = '$tanggal_filter'";
                                            } elseif ($filter_type === 'month') {
                                                // Dapatkan tahun dan bulan dari tanggal_filter
                                                $tahun_filter = date('Y', strtotime($tanggal_filter));
                                                $bulan_filter = date('m', strtotime($tanggal_filter));
                                                $query = "SELECT * FROM pengeluaran WHERE YEAR(tanggal_keluar) = '$tahun_filter' AND MONTH(tanggal_keluar) = '$bulan_filter'";
                                            } elseif ($filter_type === 'year') {
                                                // Dapatkan tahun dari tanggal_filter
                                                $tahun_filter = date('Y', strtotime($tanggal_filter));
                                                $query = "SELECT * FROM pengeluaran WHERE YEAR(tanggal_keluar) = '$tahun_filter'";
                                            }
                                        } else {
                                            // Jika tidak ada parameter tanggal_filter, tampilkan semua data
                                            $query = "SELECT * FROM pengeluaran";
                                        }

                                        $result = mysqli_query($koneksi, $query);

                                        while ($data = mysqli_fetch_assoc($result)) {
                                            // Tampilkan data sesuai kebutuhan
                                    ?>
                                    <tr>
                                        <td><?= $data['id_obat'] ?></td>
                                        <td><?= $data['nama_obat'] ?></td>
                                        <td><?= $data['tujuan'] ?></td>
                                        <td><?= $data['harga'] ?></td>
                                        <td><?= $data['tanggal_keluar'] ?></td>
                                        <td><?= $data['jumlah_keluar'] ?></td>
                                        <td><?= $data['dokumen'] ?></td>                                                                                  
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Stock Obat
                        </div>
                        <div class="card-body">              
                            <table id="datatablesSimple3" class="table table-bordered pt-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah Stock</th>                                                                                
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
                                        <td><?= $data['jumlah_stock'] ?></td>                                                                                                                            
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
    <script src="../js/datatables-simple-demo.js"></script>
    <script src="../js/datatables-simple-demo2.js"></script>
    <script src="../js/datatables-simple-demo3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-html5-2.4.0/b-print-2.4.0/datatables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

    <script>
       $(document).ready(function () {
            $('#datatablesSimple').DataTable({
                    paging: false, // Menonaktifkan fitur paging
                    searching: false, // Menonaktifkan fitur pencarian
                    info: false, // Menyembunyikan pesan info
                    ordering: false, // Menonaktifkan pengurutan kolom
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i> PDF', // Ubah teks tombol
                            className: 'btn btn-danger', // Tambahkan kelas CSS sesuai kebutuhan
                            title: 'Data Pengeluaran Obat', // Tambahkan judul yang ingin Anda tampilkan di atas tabel
                        },
                        {
                            extend: 'excelHtml5', // Tombol ekspor Excel
                            text: '<i class="fas fa-file-excel"></i> Excel', // Teks tombol Excel
                            className: 'btn btn-success', // Kelas CSS untuk tombol Excel
                            title: 'Data Pengeluaran Obat', // Judul file Excel
                        }
                    ],
                    // ... konfigurasi lainnya ...
                });


            $('#datatablesSimple2').DataTable({
                paging: false, // Menonaktifkan fitur paging
                searching: false, // Menonaktifkan fitur pencarian
                info: false, // Menyembunyikan pesan info
                ordering: false, // Menonaktifkan pengurutan kolom
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> PDF', // Ubah teks tombol
                        className: 'btn btn-danger', // Tambahkan kelas CSS sesuai kebutuhan
                        title: 'Data Pengeluaran Obat', // Tambahkan judul yang ingin Anda tampilkan di atas tabel
                    },
                    {
                        extend: 'excelHtml5', // Tombol ekspor Excel
                        text: '<i class="fas fa-file-excel"></i> Excel', // Teks tombol Excel
                        className: 'btn btn-success', // Kelas CSS untuk tombol Excel
                        title: 'Data Pengeluaran Obat', // Judul file Excel
                    }
                ],
                // ... konfigurasi lainnya ...
            });

            $('#datatablesSimple3').DataTable({
                paging: false, // Menonaktifkan fitur paging
                searching: false, // Menonaktifkan fitur pencarian
                info: false, // Menyembunyikan pesan info
                ordering: false, // Menonaktifkan pengurutan kolom
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> PDF', // Ubah teks tombol
                        className: 'btn btn-danger', // Tambahkan kelas CSS sesuai kebutuhan
                        title: 'Data Stock Obat', // Tambahkan judul yang ingin Anda tampilkan di atas tabel
                    },
                    {
                        extend: 'excelHtml5', // Tombol ekspor Excel
                        text: '<i class="fas fa-file-excel"></i> Excel', // Teks tombol Excel
                        className: 'btn btn-success', // Kelas CSS untuk tombol Excel
                        title: 'Data Stock Obat', // Judul file Excel
                    }
                ],
                // ... konfigurasi lainnya ...
            });
        });
    </script>

</body>
</html>
