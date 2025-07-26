<?php
include "koneksi.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}

$id_user = $_SESSION['user']['id_user']; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
    $foto = $_FILES['foto'];

    
    $foto_name = $_SESSION['user']['foto'];
    if (!empty($foto['name'])) {
        $upload_dir = "uploads/";
        $foto_name = uniqid() . "_" . basename($foto['name']);
        $upload_path = $upload_dir . $foto_name;

        
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($foto['type'], $allowed_types)) {
            if (move_uploaded_file($foto['tmp_name'], $upload_path)) {
                
                if ($_SESSION['user']['foto'] != 'default.png' && file_exists($upload_dir . $_SESSION['user']['foto'])) {
                    unlink($upload_dir . $_SESSION['user']['foto']);
                }
            } else {
                $foto_name = $_SESSION['user']['foto'];
            }
        }
    }

    
    $query = "UPDATE user SET nama = ?, username = ?, foto = ?";
    if ($password) {
        $query .= ", password = ?";
    }
    $query .= " WHERE id_user = ?";

    $stmt = $koneksi->prepare($query);
    if ($password) {
        $stmt->bind_param("ssssi", $nama, $username, $foto_name, $password, $id_user);
    } else {
        $stmt->bind_param("sssi", $nama, $username, $foto_name, $id_user);
    }

    if ($stmt->execute()) {
        
        $_SESSION['user']['nama'] = $nama;
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['foto'] = $foto_name;
        echo "<script>alert('Profil berhasil diperbarui!');</script>";
        echo "<script>window.location.href='index.php';</script>"; 
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui profil!');</script>";
    }
}


$query = "SELECT * FROM user WHERE id_user = ?";
$stmt = $koneksi->prepare($query);

if (!$stmt) {
    die("Query Error: " . $koneksi->error);
}

$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); 
} else {
    die("User not found!"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Setting Profil</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Profil</label><br>
                        <img src="uploads/<?php echo isset($user['foto']) && !empty($user['foto']) ? htmlspecialchars($user['foto'], ENT_QUOTES, 'UTF-8') : 'default.png'; ?>" 
     alt="Foto Profil" 
     class="img-thumbnail mb-2" 
     style="width: 150px; height: 150px; object-fit: cover;">

                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-danger">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
