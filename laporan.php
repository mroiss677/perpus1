<h1 class="mt-4 mb-4">Laporan Peminjaman Buku</h1>
<div class="row">
    <div class="col-md-12 text-right mb-3">
        <a href="cetak.php" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Data</a>
    </div>

    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status Peminjaman</th>
                            <?php if (!isset($_GET['cetak'])) {  ?>
                            <th class="text-center">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT peminjaman.*, user.nama, buku.judul FROM peminjaman 
                                                         LEFT JOIN user ON user.id_user = peminjaman.id_user 
                                                         LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['tanggal_peminjaman'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['tanggal_pengembalian'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['status_peminjaman'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php if (!isset($_GET['cetak'])) { ?>
                            <td class="text-center">
                                <a href="?page=laporan&id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                            <?php } ?>
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
    $id_peminjaman = intval($_GET['id']); 
    
    $deleteQuery = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");

    
    if ($deleteQuery) {
        echo '<script>alert("Data berhasil dihapus."); window.location.href="?page=laporan";</script>';
    } else {
        echo '<script>alert("Gagal menghapus data."); window.location.href="?page=laporan";</script>';
    }
}
?>
