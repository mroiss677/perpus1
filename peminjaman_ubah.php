<?php

$id = $_GET['id'];

if (isset($_POST['submit'])) {
   
    $id_buku = $_POST['id_buku'];
    $userid = $_SESSION['user']['id_user'];  
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $status_peminjaman = $_POST['status_peminjaman'];

    
    if (!empty($id_buku) && !empty($tanggal_peminjaman) && !empty($tanggal_pengembalian) && !empty($status_peminjaman)) {
        
        $query = mysqli_query($koneksi, "UPDATE peminjaman set id_buku='$id_buku', tanggal_peminjaman='$tanggal_peminjaman', tanggal_pengembalian='$tanggal_pengembalian', status_peminjaman='$status_peminjaman' WHERE id_peminjaman=$id");
                                               
        if ($query) {
            echo '<div class="alert alert-success" role="alert">Tambah data berhasil.</div>';
            echo '<script>location.href="?page=peminjaman";</script>';
        } else {
            echo '<script>alert("Ubah data gagal.");</script>';
        }
    } else {
        echo '<script>alert("Harap lengkapi semua data!");</script>';
    }
}
$query = mysqli_query($koneksi, "SELECT*FROM peminjaman where id_peminjaman=$id");
$data = mysqli_fetch_array($query);
?>

<h1 class="mt-4 text-center">Edit Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post">
                   
                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label">Buku</label>
                        <div class="col-md-8">
                            <select name="id_buku" class="form-control">
                                <?php
                                $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($buku = mysqli_fetch_array($buk)) {
                                    ?>
                                    <option <?php if($buku['id_buku'] == $data['id_buku']) echo 'selected'; ?> value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label">Tanggal Peminjaman</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" value="<?php echo $data['tanggal_peminjaman']; ?>" name="tanggal_peminjaman">
                        </div>
                    </div>
                    
                    
                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label">Tanggal Pengembalian</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" value="<?php echo $data['tanggal_pengembalian']; ?>"  name="tanggal_pengembalian">
                        </div>
                    </div>
                    
                    
                    <div class="form-group row mb-3">
                        <label class="col-md-4 col-form-label">Status Peminjaman</label>
                        <div class="col-md-8">
                            <select name="status_peminjaman" class="form-control">
                                <option value="dipinjam" <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                                <option value="dikembalikan"  <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Dikembalikan</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary btn-sm me-2" name="submit" value="submit">Simpan</button>
                            <a href="?page=peminjaman" class="btn btn-danger btn-sm">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
