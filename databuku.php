<h1 class="mt-4 mb-4 text-center text-white">Daftar Buku</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-50 col-md-10 col-sm-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <?php
                            $stmt = $koneksi->prepare("SELECT buku.*, kategori.kategori FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($data = $result->fetch_assoc()) {
                                $coverPath = !empty($data['cover']) ? "uploads/" . htmlspecialchars($data['cover'], ENT_QUOTES, 'UTF-8') : "uploads/default.png";
                            ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="img-container">
                                        <img src="<?php echo $coverPath; ?>" class="card-img-top" alt="Cover Buku">
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                        <p class="card-text">
                                            <?php echo htmlspecialchars(substr($data['deskripsi'], 0, 100), ENT_QUOTES, 'UTF-8'); ?>...
                                        </p>
                                        <p class="text-muted">
                                            <?php echo htmlspecialchars($data['penulis'], ENT_QUOTES, 'UTF-8'); ?> - 
                                            <?php echo htmlspecialchars($data['penerbit'], ENT_QUOTES, 'UTF-8'); ?> 
                                            (<?php echo htmlspecialchars($data['tahun_terbit'], ENT_QUOTES, 'UTF-8'); ?>)
                                        </p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="?page=peminjaman" class="btn btn-sm btn-primary me-1" title="Pinjam">
                                            Pinjam
                                        </a>
                                        <button class="btn btn-sm btn-primary me-1 lihat-detail-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal" 
                                                data-judul="<?php echo htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-deskripsi="<?php echo htmlspecialchars($data['deskripsi'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-penulis="<?php echo htmlspecialchars($data['penulis'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-penerbit="<?php echo htmlspecialchars($data['penerbit'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-tahun="<?php echo htmlspecialchars($data['tahun_terbit'], ENT_QUOTES, 'UTF-8'); ?>"
                                                data-cover="<?php echo $coverPath; ?>">
                                            Lihat
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="modalCover" src="" alt="Cover Buku" class="img-fluid" style="max-height: 200px;">
                </div>
                <h5 id="modalJudul"></h5>
                <p id="modalDeskripsi" style="text-align: justify; color: black;"></p>
                <p class="text-muted">
                    <strong>Penulis:</strong> <span id="modalPenulis"></span><br>
                    <strong>Penerbit:</strong> <span id="modalPenerbit"></span><br>
                    <strong>Tahun Terbit:</strong> <span id="modalTahun"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const detailButtons = document.querySelectorAll(".lihat-detail-btn");

        detailButtons.forEach(button => {
            button.addEventListener("click", function () {
                const judul = this.getAttribute("data-judul");
                const deskripsi = this.getAttribute("data-deskripsi");
                const penulis = this.getAttribute("data-penulis");
                const penerbit = this.getAttribute("data-penerbit");
                const tahun = this.getAttribute("data-tahun");
                const cover = this.getAttribute("data-cover");

                document.getElementById("modalJudul").textContent = judul;
                document.getElementById("modalDeskripsi").textContent = deskripsi;
                document.getElementById("modalPenulis").textContent = penulis;
                document.getElementById("modalPenerbit").textContent = penerbit;
                document.getElementById("modalTahun").textContent = tahun;
                document.getElementById("modalCover").src = cover;
            });
        });
    });
</script>
