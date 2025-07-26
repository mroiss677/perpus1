<h1 class="mt-4">Peminjaman Buku</h1>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Peminjaman</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <a href="?page=peminjaman_tambah" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Peminjaman
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status Peminjaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                            LEFT JOIN user ON user.id_user = peminjaman.id_user 
                            LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku 
                            WHERE peminjaman.id_user=" . $_SESSION['user']['id_user']);
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo $data['tanggal_peminjaman']; ?></td>
                                <td><?php echo $data['tanggal_pengembalian']; ?></td>
                                <td>
                                    <span class="badge 
                                        <?php echo ($data['status_peminjaman'] == 'Dipinjam') ? 'bg-warning text-dark' : 'bg-success'; ?>">
                                        <?php echo $data['status_peminjaman']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
