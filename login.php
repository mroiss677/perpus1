<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PerpusDigital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('./3.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            font-family: 'Poppins', sans-serif;
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
        .card-header {
            text-align: center;
            padding: 20px;
        }
        .card-header h3 {
            color:rgb(255, 255, 255);
            font-weight: bold;
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
            transform: scale(1.02);
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .btn {
            border-radius: 10px;
            padding: 10px 20px;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .btn-primary {
            background: linear-gradient(45deg, #28a745, #218838);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.5);
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #218838, #28a745);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.7);
            transform: translateY(-2px);
        }
        footer {
            color: #fff;
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .btn-link {
            color:rgb(0, 216, 254);
        }
        .btn-link:hover {
            text-decoration: underline;
            color:rgb(0, 55, 255);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt"></i> Login PerpusDigital</h3>
            </div>
            <div class="card-body">
                <?php
                include "koneksi.php";
                if (isset($_POST['login'])) {
                    $username = $_POST['username'];
                    $password = md5($_POST['password']); 
                    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
                    $cek = mysqli_num_rows($data);

                    if ($cek > 0) {
                        $_SESSION['user'] = mysqli_fetch_array($data);
                        echo '<script>alert("Selamat datang, login berhasil"); location.href="index.php";</script>';
                    } else {
                        echo '<div class="alert alert-danger text-center">Username atau Password salah!</div>';
                    }
                }
                ?>
                <form method="post">
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-user"></i> Username</label>
                        <input class="form-control py-3" type="text" name="username" placeholder="Masukan Username" required />
                    </div>
                    <div class="form-group mb-4">
                        <label class="small mb-1"><i class="fas fa-lock"></i> Password</label>
                        <input class="form-control py-3" type="password" name="password" placeholder="Masukan Password" required />
                    </div>
                    <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a class="btn-link" href="register.php">Belum punya akun? Daftar</a>
                </div>
            </div>
            <footer class="mt-4">
                &copy; PerpusDigital 2024 - All Rights Reserved
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
