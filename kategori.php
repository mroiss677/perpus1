<h1 class="mt-4 mb-4">Kategori Buku</h1>
<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="?page=kategori_tambah" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Data</a>
    </div>

    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($data['kategori'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">
                                <a href="?page=kategori_ubah&id_kategori=<?php echo $data['id_kategori']; ?>" class="btn btn-info btn-sm" title="Ubah">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="?page=kategori&id=<?php echo $data['id_kategori']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini? Semua data buku terkait juga akan dihapus.');">
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
    $id_kategori = intval($_GET['id']); 

    
    $deleteBooks = mysqli_query($koneksi, "DELETE FROM buku WHERE id_kategori = '$id_kategori'");

    if ($deleteBooks) {
        
        $deleteCategory = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

        if ($deleteCategory) {
            echo '<script>alert("Data kategori dan buku terkait berhasil dihapus."); window.location.href="?page=kategori";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data kategori."); window.location.href="?page=kategori";</script>';
        }
    } else {
        echo '<script>alert("Gagal menghapus buku terkait."); window.location.href="?page=kategori";</script>';
    }
}
?>
