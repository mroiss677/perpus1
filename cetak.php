<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            text-align: center;
        }
        table td.text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Peminjaman Buku</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
            </tr>
            
        <tbody>
            <?php
            
            include "koneksi.php";

            
            $i = 1;

            
            $query = mysqli_query($koneksi, "
                SELECT * 
                FROM peminjaman 
                LEFT JOIN user ON user.id_user = peminjaman.id_user 
                LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
            ");

            
            while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td class="text-center"><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($data['nama']); ?></td>
                <td><?php echo htmlspecialchars($data['judul']); ?></td>
                <td><?php echo htmlspecialchars($data['tanggal_peminjaman']); ?></td>
                <td><?php echo htmlspecialchars($data['tanggal_pengembalian']); ?></td>
                <td><?php echo htmlspecialchars($data['status_peminjaman']); ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<script>
    window.print();
    setTimeout(function() {
        window.close();
    }, 150);
</script>
