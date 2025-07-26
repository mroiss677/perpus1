<h1 class="mt-4 mb-4">Ulasan Buku</h1>
<div class="row">
<?php
if ($_SESSION['user']['level'] != 'admin' && $_SESSION['user']['level'] != 'petugas') {
?>
    <div class="text-right mb-2">
        <a href="?page=ulasan_tambah" class="btn btn-primary btn-sm">+ Tambah Ulasan</a>
    </div>
<?php
}
?>

<div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Ulasan</th>
                        <th>Rating</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT ulasan.id_ulasan, ulasan.id_user, user.nama, buku.judul, ulasan.ulasan, ulasan.rating 
                                                    FROM ulasan 
                                                    LEFT JOIN user ON user.id_user = ulasan.id_user 
                                                    LEFT JOIN buku ON buku.id_buku = ulasan.id_buku");
                    while ($data = mysqli_fetch_array($query)) {
                        $isOwner = ($_SESSION['user']['id_user'] == $data['id_user']); 
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['ulasan'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($data['rating'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">
                                <?php if ($isOwner) { ?>
                                    <a href="?page=ulasan_ubah&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-info btn-sm" title="Ubah">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                <?php } ?>
                                <?php if ($_SESSION['user']['level'] == 'admin' || $_SESSION['user']['level'] == 'petugas' || $isOwner) { ?>
                                    <a href="?page=ulasan&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                <?php } ?>
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

<?php

if (isset($_GET['id'])) {
    $id_ulasan = intval($_GET['id']); 

    if ($_SESSION['user']['level'] == 'admin' || $_SESSION['user']['id_user'] == $data['id_user']) {
        $deleteQuery = mysqli_query($koneksi, "DELETE FROM ulasan WHERE id_ulasan = '$id_ulasan'");

        if ($deleteQuery) {
            echo '<script>alert("Data berhasil dihapus."); window.location.href="?page=ulasan";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data."); window.location.href="?page=ulasan";</script>';
        }
    } else {
        echo '<script>alert("Anda tidak memiliki izin untuk menghapus data ini."); window.location.href="?page=ulasan";</script>';
    }
}
?>
