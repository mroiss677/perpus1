<h1 class="mt-4">Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                <?php
                if (isset($_POST['submit'])) {
                    $id_buku = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
                    $id_user = $_SESSION['user']['id_user'];
                    $tanggal_peminjaman = mysqli_real_escape_string($koneksi, $_POST['tanggal_peminjaman']);
                    $tanggal_pengembalian = isset($_POST['tanggal_pengembalian']) ? mysqli_real_escape_string($koneksi, $_POST['tanggal_pengembalian']) : null;
                    $status_peminjaman = mysqli_real_escape_string($koneksi, $_POST['status_peminjaman']);
                
                    
                    if (empty($id_buku) || empty($tanggal_peminjaman) || empty($tanggal_pengembalian) || empty($status_peminjaman)) {
                        echo '<div class="alert alert-danger" role="alert">Semua data harus diisi.</div>';
                    } else {
                        
                        $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) 
                                                         VALUES ('$id_buku', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')");
                
                        if ($query) {
                            echo '<div class="alert alert-success" role="alert">Tambah data berhasil.</div>';
                            echo '<script>location.href="?page=peminjaman";</script>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Tambah data gagal.</div>';
                        }
                    }
                }
                
                ?>

                <div class="row mb-3">
                    <label for="id_buku" class="col-md-2 col-form-label">Buku</label>
                    <div class="col-md-8">
                        <select id="id_buku" name="id_buku" class="form-control">
                            <?php
                            $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                            while ($buku = mysqli_fetch_assoc($buk)) {
                                echo '<option value="' . htmlspecialchars($buku['id_buku']) . '">' . htmlspecialchars($buku['judul']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggal_peminjaman" class="col-md-2 col-form-label">Tanggal Peminjaman</label>
                    <div class="col-md-8">
                        <input type="date" id="tanggal_peminjaman" class="form-control" name="tanggal_peminjaman">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggal_pengembalian" class="col-md-2 col-form-label">Tanggal Pengembalian</label>
                    <div class="col-md-8">
                    <input type="date" id="tanggal_pengembalian" class="form-control" name="tanggal_pengembalian">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="status_peminjaman" class="col-md-2 col-form-label">Status Pengembalian</label>
                    <div class="col-md-8">
                        <select id="status_peminjaman" name="status_peminjaman" class="form-control">
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 d-flex justify-content-start">
                        <button  type="submit" class="btn btn-primary btn-sm me-2" name="submit" value="submit">Simpan</button>
                        <a href="?page=peminjaman" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
