<h1 class="mt-4">Selamat Datang</h1>
                        <ol class="breadcrumb mb-4">
                        <?php echo htmlspecialchars($_SESSION['user']['nama']); ?>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <?php
                                            echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM kategori"));
                                        ?>                                   
                                    Total Kategori</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=kategori">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">
                                    <?php
                                            echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM buku"));
                                        ?> 
                                        Total Buku</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=buku">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                    <?php
                                            echo mysqli_num_rows(mysqli_query($koneksi, "SELECT*FROM ulasan"));
                                        ?> 
                                        Total Ulasan</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=ulasan">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            
                        </div> 
    <div class="card">
    <div class="card-body">
    <table class="table">
    <tbody>
        <tr>
            <th>Nama</th>
            <td>:</td>
            <td>
                <?php 
                
                echo isset($_SESSION['user']['nama']) ? htmlspecialchars($_SESSION['user']['nama']) : 'Tidak tersedia'; 
                ?>
            </td>
        </tr>
        <tr>
            <th>Level User</th>
            <td>:</td>
            <td>
                <?php 
                
                echo isset($_SESSION['user']['level']) ? htmlspecialchars($_SESSION['user']['level']) : 'Tidak tersedia'; 
                ?>
            </td>
        </tr>
        <tr>
            <th>Tanggal Login</th>
            <td>:</td>
            <td><?php echo date('d-m-Y'); ?></td>
        </tr>
    </tbody>
</table>

    </div>
</div>


