<?php
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Perpus Digital</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .icon-clipboard {
            font-size: 17px;
            color: rgba(255, 255, 255, 0.25);
            margin-right: 0.5rem;
        }
            body {
            background-image: url('./book.jpeg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Perpustakaan Digital </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="uploads/<?php echo isset($_SESSION['user']['foto']) && !empty($_SESSION['user']['foto']) ? htmlspecialchars($_SESSION['user']['foto'], ENT_QUOTES, 'UTF-8') : 'default.png'; ?>" 
             alt="Foto Profil" 
             class="rounded-circle me-2" 
             style="width: 30px; height: 30px; object-fit: cover;">
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="setting.php">Settings</a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
    </ul>
</li>

        </ul>
            </div>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                    <div style="
    background-image: url('bg1.jpg'); 
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    height: 36.7rem;">
    <div class="sb-sidenav-menu-heading">Beranda</div>
    <a class="nav-link" href="index.php">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
    </a>
    <div class="sb-sidenav-menu-heading">Navigasi</div>
    <?php if ($_SESSION['user']['level'] != 'peminjam') { ?>
        <a class="nav-link" href="?page=kategori">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Kategori
        </a>
        <a class="nav-link" href="?page=buku">
            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Buku
        </a>
    <?php } else { ?>
        <a class="nav-link" href="?page=databuku">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Buku
        </a>
        <a class="nav-link" href="?page=peminjaman">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Peminjaman
        </a>
    <?php } ?>
    <a class="nav-link" href="?page=ulasan">
        <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
        Ulasan
    </a>
    <?php if ($_SESSION['user']['level'] != 'peminjam') { ?>
        <a class="nav-link" href="?page=laporan">
            <div class="fas fa-clipboard icon-clipboard"><i class="fas fa-book"></i></div>
            Laporan
        </a>
        <?php if ($_SESSION['user']['level'] == 'admin') { ?>
            <a class="nav-link" href="?page=user">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Daftar Pengguna
            </a>
        <?php } ?>
    <?php } ?>
</div>

                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo htmlspecialchars($_SESSION['user']['nama']); ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php
                    $page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
                    $file = $page . '.php';
                    if (file_exists($file)) {
                        include $file;
                    } else {
                        include '404.php';
                    }
                    ?>
                </div>
            </main>
            <footer class="py-2 bg-dark mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-white">Copyright &copy; Perpus Digital 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
