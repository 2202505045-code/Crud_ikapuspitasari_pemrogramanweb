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
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 20px; 
            background-color: #f7fbfb; /* Latar belakang soft tosca sangat muda */
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        h2 {
            color: #1abc9c; /* Hijau Tosca Utama */
            margin-top: 0;
            border-bottom: 2px solid #f1c40f; /* Garis bawah Kuning Soft */
            padding-bottom: 10px;
        }

        .btn-tambah {
            background-color: #1abc9c; /* Hijau Tosca */
            color: white; 
            padding: 10px 20px;
            text-decoration: none; 
            border-radius: 20px; /* Membuat tombol lonjong/feminim */
            display: inline-block; 
            margin-bottom: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(26, 188, 156, 0.3);
        }
        
        .btn-tambah:hover {
            background-color: #16a085; /* Tosca lebih gelap saat di-hover */
            transform: translateY(-2px);
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th { 
            background-color: #1abc9c; /* Hijau Tosca untuk Header Tabel */
            color: white; 
            padding: 12px 15px; 
            text-align: left; 
            font-weight: 600;
        }
        
        td { 
            padding: 12px 15px; 
            border-bottom: 1px solid #e8f6f5; 
        }
        
        /* Baris selang-seling menggunakan warna Kuning Soft dan Tosas Muda */
        tr:nth-child(even) { 
            background-color: #fffde7; /* Sentuhan warna Kuning Soft */
        }
        tr:nth-child(odd) { 
            background-color: #ffffff; 
        }
        tr:hover {
            background-color: #e8f8f5; /* Efek hover Tosca lembut */
        }

        .btn-aksi { 
            text-decoration: none; 
            padding: 5px 12px; 
            color: white; 
            border-radius: 15px; 
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
        }
        
        .btn-edit { 
            background-color: #f1c40f; /* Kuning Aksen */
            color: #333; 
        }
        .btn-edit:hover {
            background-color: #f39c12;
        }
        
        .btn-delete { 
            background-color: #e74c3c; 
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }

        /* Gaya Khusus untuk Nama & NIM di bagian bawah */
        .footer-identity {
            margin-top: 40px;
            padding: 15px;
            background-color: #e8f6f5; /* Background Tosca Muda */
            border-left: 5px solid #f1c40f; /* Border samping Kuning */
            border-radius: 4px;
            text-align: center;
        }
        .footer-identity p {
            margin: 5px 0;
            font-weight: bold;
            color: #16a085;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <div class="container">
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

        <!-- Identitas Pembuat Aplikasi -->
        <div class="footer-identity">
            <p>Dibuat Oleh:</p>
            <p style="font-size: 18px; color: #2c3e50;">IKA PUSPITA SARI</p>
            <p style="font-size: 14px; color: #7f8c8d;">NIM: 2202505045</p>
        </div>
    </div>

</body>
</html>