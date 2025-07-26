<?php
include "koneksi.php";


if (isset($_POST['add_user'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    $level = $_POST['level'];

    
    $stmt = $koneksi->prepare("INSERT INTO user (nama, email, alamat, no_telepon, username, password, level) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nama, $email, $alamat, $no_telepon, $username, $password, $level);

    if ($stmt->execute()) {
        echo '<script>alert("Pengguna berhasil ditambahkan!"); window.location.href="index.php?page=user";</script>';
    } else {
        echo '<script>alert("Gagal menambahkan pengguna, coba lagi!");</script>';
    }
    $stmt->close();
}


if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];

    
    $stmt = $koneksi->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_to_delete);

    if ($stmt->execute()) {
        echo '<script>alert("Pengguna berhasil dihapus!"); window.location.href="index.php?page=user";</script>';
    } else {
        echo '<script>alert("Gagal menghapus pengguna, coba lagi!");</script>';
    }
    $stmt->close();
}


$users_query = $koneksi->query("SELECT * FROM user");
$users = $users_query->fetch_all(MYSQLI_ASSOC);
?>


    
<h1 class="mt-4">Daftar User</h1>  
<div class="card">
    <div class="row">
        <div class="col-md-12">
            <div class="container mt-4">
                <div class="row">      
        
        <div class="col-md-12">
            <div class="card-header">
                <h5 class="font-weight-light">Tambah Petugas</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Nama Pengguna" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="Masukkan Nomor Telepon" required />
                    </div>
                    <div class="form-group mb-3">
                        <label>Level</label>
                        <select name="level" class="form-select" required>
                            <option value="petugas">Petugas</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required />
                    </div>
                    <form method="post">
    
    <button type="submit" name="add_user" class="btn btn-success">Add User</button>
</form>

                </form>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header">
                <h5 class="font-weight-light">User List</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id_user']; ?></td>
                                <td><?php echo $user['nama']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo ucfirst($user['level']); ?></td>
                                <td>
    <a href="user.php?delete_id=<?php echo $user['id_user']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="btn btn-danger btn-sm">Delete</a>

</td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
            </div>
        </div>
    </div>
</div>