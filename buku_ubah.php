<h1 class="mt-4">Edit Data Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">
                    <?php
                    $id = intval($_GET['id']);
                    
                    
                    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = $id");
                    $data = mysqli_fetch_array($query);

                    if (isset($_POST['submit'])) {
                        
                        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
                        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
                        $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
                        $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
                        $tahun_terbit = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
                        $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

                       
                        $cover = $data['cover']; 
                        if (!empty($_FILES['cover']['name'])) {
                            $targetDir = "uploads/";
                            $newCover = basename($_FILES['cover']['name']);
                            $targetFilePath = $targetDir . $newCover;

                            
                            if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFilePath)) {
                                $cover = $newCover;
                            } else {
                                echo '<script>alert("Gagal mengunggah file cover.");</script>';
                            }
                        }

                        
                        $updateQuery = mysqli_query($koneksi, 
                            "UPDATE buku SET 
                                id_kategori = '$id_kategori', 
                                judul = '$judul', 
                                penulis = '$penulis', 
                                penerbit = '$penerbit', 
                                tahun_terbit = '$tahun_terbit', 
                                deskripsi = '$deskripsi', 
                                cover = '$cover' 
                            WHERE id_buku = $id");

                        if ($updateQuery) {
                            echo '<script>alert("Ubah data berhasil."); window.location.href="?page=buku";</script>';
                        } else {
                            echo '<script>alert("Gagal mengubah data.");</script>';
                        }
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-2">Kategori</div>
                        <div class="col-md-8">
                            <select name="id_kategori" class="form-control" required>
                                <?php
                                $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                                while ($kategori = mysqli_fetch_assoc($kat)) {
                                    $selected = ($kategori['id_kategori'] == $data['id_kategori']) ? 'selected' : '';
                                    echo "<option value='{$kategori['id_kategori']}' $selected>{$kategori['kategori']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Judul</div>
                        <div class="col-md-8">
                            <input type="text" value="<?php echo $data['judul']; ?>" class="form-control" name="judul" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Penulis</div>
                        <div class="col-md-8">
                            <input type="text" value="<?php echo $data['penulis']; ?>" class="form-control" name="penulis" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Penerbit</div>
                        <div class="col-md-8">
                            <input type="text" value="<?php echo $data['penerbit']; ?>" class="form-control" name="penerbit" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Tahun Terbit</div>
                        <div class="col-md-8">
                            <input type="number" value="<?php echo $data['tahun_terbit']; ?>" class="form-control" name="tahun_terbit" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Deskripsi</div>
                        <div class="col-md-8">
                            <textarea name="deskripsi" rows="5" class="form-control"><?php echo $data['deskripsi']; ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Cover Buku</div>
                        <div class="col-md-8">
                            <input type="file" name="cover" class="form-control-file">
                            <?php if (!empty($data['cover'])): ?>
                                <p>Cover saat ini: <img src="uploads/<?php echo $data['cover']; ?>" alt="Cover Buku" style="max-height: 150px;"></p>
                            <?php endif; ?>
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
