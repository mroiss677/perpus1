<h1 class="mt-4 mb-4">Buku</h1>
<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="?page=buku_tambah" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Data</a>
    </div>
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Cover</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
                        while ($data = mysqli_fetch_array($query)) {
                            $coverPath = !empty($data['cover']) ? "uploads/" . $data['cover'] : "uploads/default.png"; 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($data['kategori'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['penulis'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['penerbit'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['tahun_terbit'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">
                                <img src="<?php echo htmlspecialchars($coverPath, ENT_QUOTES, 'UTF-8'); ?>" alt="Cover Buku" style="width: 70px; height: auto;">
                            </td>
                            <td><?php echo htmlspecialchars($data['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">
                                <a href="?page=buku_ubah&id=<?php echo $data['id_buku']; ?>" class="btn btn-info btn-sm" title="Ubah">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="?page=buku&id=<?php echo $data['id_buku']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php

if (isset($_GET['id'])) {
    $id_buku = intval($_GET['id']); 

    
    $deleteReviews = mysqli_query($koneksi, "DELETE FROM ulasan WHERE id_buku = '$id_buku'");
    
    if ($deleteReviews) {
        
        $deleteBook = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id_buku'");

        if ($deleteBook) {
            echo '<script>alert("Data berhasil dihapus."); window.location.href="?page=buku";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data dari tabel buku."); window.location.href="?page=buku";</script>';
        }
    } else {
        echo '<script>alert("Gagal menghapus data ulasan yang terkait."); window.location.href="?page=buku";</script>';
    }
}
?>
