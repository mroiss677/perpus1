<h1 class="mt-4">Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        
                        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
                        $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
                        $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
                        $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
                        $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
                        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);

                        
                        $cover = null;
                        if (!empty($_FILES['cover']['name'])) {
                            $targetDir = "uploads/";
                            $cover = basename($_FILES['cover']['name']);
                            $targetFilePath = $targetDir . $cover;

                            
                            if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFilePath)) {
                                
                            } else {
                                echo '<script>alert("Gagal mengunggah file cover.");</script>';
                                $cover = null;
                            }
                        }

                        
                        $query = mysqli_query($koneksi, 
                            "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, deskripsi, id_kategori, cover) 
                             VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$deskripsi', '$id_kategori', '$cover')");

                        if ($query) {
                            echo '<script>alert("Data buku berhasil ditambahkan."); window.location.href="?page=buku";</script>';
                        } else {
                            echo '<script>alert("Gagal menambahkan data buku.");</script>';
                        }
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-2">Kategori</div>
                        <div class="col-md-8">
                            <select name="id_kategori" class="form-control" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <?php
                                $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                                while ($kategori = mysqli_fetch_assoc($kat)) {
                                    echo '<option value="' . $kategori['id_kategori'] . '">' . $kategori['kategori'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Judul</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="judul" required></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Penulis</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="penulis" required></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Penerbit</div>
                        <div class="col-md-8"><input type="text" class="form-control" name="penerbit" required></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Tahun terbit</div>
                        <div class="col-md-8"><input type="number" class="form-control" name="tahun_terbit" required></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Deskripsi</div>
                        <div class="col-md-8">
                            <textarea name="deskripsi" rows="5" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Cover Buku</div>
                        <div class="col-md-8">
                            <input type="file" name="cover" id="cover" class="form-control-file">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary btn-sm me-2" name="submit" value="submit">Simpan</button>
                            <a href="?page=buku" class="btn btn-danger btn-sm">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
