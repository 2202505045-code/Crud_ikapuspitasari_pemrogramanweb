<?php
// Mengambil file koneksi
include_once("config.php");

// Mengambil semua data alat dari database
$result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sim Rs - Data Alat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .btn-tambah {
            background-color: #28a745; color: white; padding: 10px 15px;
            text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 15px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #ffa500; color: white; padding: 10px; text-align: left; border: 1px solid #ccc; }
        td { padding: 10px; border: 1px solid #ccc; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn-aksi { text-decoration: none; padding: 3px 8px; color: white; border-radius: 3px; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-delete { background-color: #dc3545; }
    </style>
</head>
<body>

    <h2>Daftar Data Alat</h2>
    
    <!-- Tombol menuju halaman tambah data -->
    <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a>

    <table>
        <tr>
            <th>Nama Alat</th>
            <th>Tahun</th>
            <th>Merek</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        
        <?php  
        // Menampilkan data menggunakan perulangan while
        while($user_data = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$user_data['nama_alat']."</td>";
            echo "<td>".$user_data['tahun']."</td>";
            echo "<td>".$user_data['merek']."</td>";
            echo "<td>".$user_data['lokasi']."</td>";    
            echo "<td>
                    <a href='edit.php?id=$user_data[id]' class='btn-aksi btn-edit'>Edit</a> 
                    <a href='delete.php?id=$user_data[id]' class='btn-aksi btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                  </td>";
            echo "</tr>";        
        }
        ?>
    </table>

</body>
</html>