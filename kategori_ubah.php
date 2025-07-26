<h1 class="mt-4">Edit Kategori Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                <?php
                    
                    if (isset($_GET['id_kategori'])) {
                        $id = $_GET['id_kategori'];

                      
                        $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id'");
                        $data = mysqli_fetch_assoc($query);

                       
                        if ($data) {
                            
                            if (isset($_POST['submit'])) {
                                $kategori = $_POST['kategori'];

                              
                                $updateQuery = mysqli_query($koneksi, "UPDATE kategori SET kategori = '$kategori' WHERE id_kategori = '$id'");

                                
                                if ($updateQuery) {
                                    echo '<script>alert("Edit data berhasil."); window.location.href="?page=kategori";</script>';
                                } else {
                                    echo '<script>alert("Edit data gagal.");</script>';
                                }
                            }
                        } else {
                            echo '<script>alert("Data tidak ditemukan."); window.location.href="?page=kategori";</script>';
                        }
                    } else {
                        echo '<script>alert("ID kategori tidak ditemukan."); window.location.href="?page=kategori";</script>';
                    }
                ?>

                <div class="row mb-3">
                    <div class="col-md-2">Nama Kategori</div>
                    <div class="col-md-8">                  
                        <input type="text" class="form-control" name="kategori" value="<?php echo isset($data['kategori']) ? $data['kategori'] : ''; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary btn-sm me-2" name="submit" value="submit">Simpan</button>
                        <a href="?page=kategori" class="btn btn-danger btn-sm">Kembali</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>