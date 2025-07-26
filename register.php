<?php
include "koneksi.php";

if (isset($_POST['registrasi'])) {
   
    $nama =  $_POST['nama'];
    $email =  $_POST['email'];
    $alamat =  $_POST['alamat'];
    $no_telepon =  $_POST['no_telepon'];
    $username =  $_POST['username'];
    $password = md5($_POST['password']);
    $level =  $_POST['level'];

    $insert = mysqli_query($koneksi, "INSERT INTO user(nama,email,alamat,no_telepon,username,password,level) VALUES('$nama', '$email', '$alamat', '$no_telepon', '$username', '$password', '$level')");

    if($insert){
        echo '<script>alert("Selamat, registrasi berhasil. Silakan login."); location.href="login.php";</script>';
    } else {
        echo '<script>alert("Registrasi gagal, silakan ulangi kembali.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Halaman Registrasi PerpusDigital" />
    <meta name="author" content="PerpusDigital" />
    <title>Registrasi PerpusDigital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('./3.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            color: #fff;
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }
        .card-header h3 {
            color:rgb(255, 255, 255);
            font-weight: bold;
            text-align: center;
            font-size: 1.5rem;
            text-transform: uppercase;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.2);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.7);
            transform: scale(1);
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .btn-success {
            background: linear-gradient(45deg, #28a745, #218838);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.5);
        }
        .btn-success:hover {
            background: linear-gradient(45deg, #218838, #28a745);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.7);
            transform: translateY(-2px);
        }
        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.5);
        }
        .btn-danger:hover {
            background: linear-gradient(45deg, #c82333, #dc3545);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.7);
            transform: translateY(-2px);
        }
        footer {
            color: #fff;
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-user-plus"></i> Registrasi Perpus Digital</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input class="form-control py-3" type="text" name="nama" placeholder="Masukan Nama Lengkap" required />
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-user"></i> Username</label>
                        <input class="form-control py-3" type="text" name="username" placeholder="Masukan Username" required />
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-envelope"></i> Email</label>
                        <input class="form-control py-3" type="email" name="email" placeholder="Masukan Email" required />
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control py-3" placeholder="Masukan Alamat" required></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-phone"></i> No. Telepon</label>
                        <input class="form-control py-3" type="text" name="no_telepon" placeholder="Masukan No. Telepon" required />
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-user-tag"></i> Level</label>
                        <select name="level" class="form-select py-3" required>
                            <option value="admin">Admin</option>
                            <option value="peminjam">Peminjam</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-lock"></i> Password</label>
                        <input class="form-control py-3" type="password" name="password" placeholder="Masukan Password" required />
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-success" type="submit" name="registrasi">Registrasi</button>
                        <a class="btn btn-danger" href="login.php">Login</a>
                    </div>
                </form>
            </div>
            <footer class="mt-4">
                &copy; PerpusDigital 2024 - All Rights Reserved
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
