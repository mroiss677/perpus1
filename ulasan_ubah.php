<h1 class="mt-4">Ulasan Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    
                    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                        echo "<script>alert('Parameter ID tidak valid atau tidak ditemukan.'); window.location.href='?page=ulasan';</script>";
                        exit;
                    }

                    $id = intval($_GET['id']); 

                    
                    $query = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_ulasan = $id");
                    $data = mysqli_fetch_array($query);

                    if (!$data) {
                        echo "<script>alert('Data tidak ditemukan.'); window.location.href='?page=ulasan';</script>";
                        exit;
                    }

                    
                    if (isset($_POST['submit'])) {
                        $id_buku = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
                        $id_user = $_SESSION['user']['id_user'];
                        $ulasan = mysqli_real_escape_string($koneksi, $_POST['ulasan']);
                        $rating = intval($_POST['rating']);

                        $query = mysqli_query($koneksi, "UPDATE ulasan SET id_buku = '$id_buku', ulasan = '$ulasan', rating = '$rating' WHERE id_ulasan = $id");

                        if ($query) {
                            echo "<script>alert('Ulasan berhasil diperbarui.'); window.location.href='?page=ulasan';</script>";
                        } else {
                            echo "<script>alert('Gagal memperbarui ulasan.');</script>";
                        }
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-2">Buku</div>
                        <div class="col-md-8">
                            <select name="id_buku" class="form-select" required>
                                <?php
                                $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($buku = mysqli_fetch_assoc($buk)) {
                                    $selected = $data['id_buku'] == $buku['id_buku'] ? 'selected' : '';
                                    echo "<option value='{$buku['id_buku']}' $selected>{$buku['judul']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">Ulasan</div>
                        <div class="col-md-8">
                            <textarea name="ulasan" rows="5" class="form-control" required><?php echo htmlspecialchars($data['ulasan'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Rating</div>
                        <div class="col-md-8 d-flex align-items-center">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $checked = $data['rating'] == $i ? 'checked' : '';
                                echo "
                                <div class='form-check me-3'>
                                    <input class='form-check-input' type='radio' name='rating' value='$i' id='rating$i' $checked required>
                                    <label class='form-check-label' for='rating$i'>$i</label>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary btn-sm me-2" name="submit" value="submit">Simpan</button>
                            <a href="?page=ulasan" class="btn btn-danger btn-sm">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
