<h1 class="mt-4">ulasan Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                <?php
                    if(isset($_POST['submit'])) {
                        $id_buku = $_POST['id_buku'];
                        $id_user = $_SESSION['user']['id_user'];
                        $ulasan = $_POST['ulasan'];
                        $rating = $_POST['rating'];
                        $query = mysqli_query($koneksi, "INSERT INTO ulasan(id_buku,id_user,ulasan,rating) values('$id_buku','$id_user','$ulasan','$rating')");
                        

                        if($query) {
                            echo '<script>alert("Tambah data berhasil.");  location.href="?page=ulasan";</script>';
                        }else{
                            echo '<script>alert("Tambah data gagal.");</script>';
                        }
                    }
                
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-2">Buku</div>
                        <div class="col-md-8">
                            <select name="id_buku">
                                <?php
                                $buk = mysqli_query($koneksi, "SELECT*FROM buku");
                                    while($buku = mysqli_fetch_assoc($buk)) {
                                        ?>
                                        <option value="<?php echo $buku['id_buku'];?>"><?php echo $buku['judul']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">Ulasan</div>
                        <div class="col-md-8">
                            <textarea name="ulasan" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">Rating</div>
                            <div class="col-md-8 d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="rating" value="1" id="rating1" required>
                                <label class="form-check-label" for="rating1">1</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="rating" value="2" id="rating2">
                                <label class="form-check-label" for="rating2">2</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="rating" value="3" id="rating3">
                                <label class="form-check-label" for="rating3">3</label>
                            </div>
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="rating" value="4" id="rating4">
                                <label class="form-check-label" for="rating4">4</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rating" value="5" id="rating5">
                                 <label class="form-check-label" for="rating5">5</label>
                            </div>
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