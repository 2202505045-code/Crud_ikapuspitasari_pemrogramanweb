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
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            padding: 40px 20px;
            background-color: #fffdf5; /* Latar belakang kuning gading super lembut */
            color: #334155;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(234, 179, 8, 0.04);
            border: 1px solid #fcf0cc;
            position: relative;
            overflow: hidden;
        }

        /* Simbol Hati Medis Berwarna Toska dengan latar Kuning Mustard Soft */
        .alkes-badge {
            position: absolute;
            top: 25px;
            right: 35px;
            color: #0d9488; /* Tosca */
            background-color: #fef9c3; /* Latar kuning soft */
            padding: 10px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(234, 179, 8, 0.15);
            border: 1px solid #fef08a;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        h2 {
            color: #0f172a; /* Deep Navy agar judul sangat tegas */
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }

        .sub-title {
            color: #0d9488; /* Tosca */
            font-size: 13px;
            margin-bottom: 30px;
            margin-top: 4px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* Pembungkus Kontrol Aksi atas (Tambah & Cari) */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-tambah {
            background-color: #0d9488; /* Tosca Utama */
            color: white; 
            padding: 12px 24px;
            text-decoration: none; 
            border-radius: 10px; 
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-tambah:hover {
            background-color: #0f766e;
            transform: translateY(-1px);
        }

        /* Desain Kolom Input Pencarian */
        .search-container {
            position: relative;
        }

        .input-cari {
            width: 250px;
            padding: 11px 16px 11px 40px;
            border: 2px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .input-cari:focus {
            border-color: #0d9488;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        /* Desain Tabel Paduan Toska & Kuning Mustard */
        .table-wrapper {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.02);
            border: 1px solid #e2e8f0;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        
        th { 
            background-color: #0d9488; /* Header Tosca Solid */
            color: #ffffff; 
            padding: 16px; 
            text-align: left; 
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td { 
            padding: 16px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 14px;
            color: #334155;
        }
        
        /* Baris selang-seling Menggunakan Kuning Gading/Lemon Lembut */
        tr:nth-child(even) { 
            background-color: #fefce8; 
        }
        
        /* Baris ganjil putih bersih */
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        
        /* Efek Hover dengan sentuhan Toska Air */
        tr:hover {
            background-color: #e6fffa; 
        }

        /* Tombol Aksi */
        .btn-aksi { 
            text-decoration: none; 
            padding: 6px 14px; 
            color: white; 
            border-radius: 8px; 
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-right: 5px;
            transition: all 0.2s ease;
        }

        .btn-aksi:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }
        
        .btn-edit { 
            background-color: #eab308; /* Kuning Mustard / Amber */
            color: #ffffff;
        }
        .btn-edit:hover {
            background-color: #ca8a04;
        }
        
        .btn-delete { 
            background-color: #ef4444; /* Merah Soft Kontras */
        }
        .btn-delete:hover {
            background-color: #dc2626;
        }

        /* Pesan jika pencarian tidak ditemukan */
        .no-data {
            text-align: center;
            padding: 20px;
            color: #94a3b8;
            display: none;
            font-style: italic;
        }

        /* Footer Identitas */
        .footer-identity {
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px dashed #e2e8f0;
            text-align: center;
        }
        
        .nama-mhs {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            letter-spacing: 0.5px;
        }
        
        .nim-mhs {
            font-size: 13px;
            color: #64748b;
            margin: 4px 0 0 0;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Logo Hati Medis -->
        <div class="alkes-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                <path d="M12 9v4M10 11h4" />
            </svg>
        </div>

        <div class="header-title">
            <h2>DATA INVENTASI ALAT KESEHATAN</h2>
        </div>
        <div class="sub-title">
            <span>Sistem Manajemen Inventaris Alat Kesehatan (Alkes)</span>
        </div>
        
        <div class="action-bar">
            <!-- Tombol Tambah Data -->
            <a href="add.php" class="btn-tambah">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Alat Baru
            </a>
            
            <!-- Kolom Pencarian -->
            <div class="search-container">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="inputCari" class="input-cari" onkeyup="cariData()" placeholder="Cari nama alat / lokasi...">
            </div>
        </div>

        <div class="table-wrapper">
            <table id="tabelAlat">
                <thead>
                    <tr>
                        <th>Nama Alat</th>
                        <th>Tahun</th>
                        <th>Merek</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
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
                </tbody>
            </table>
            <div id="pesanKosong" class="no-data">Data alat tidak ditemukan...</div>
        </div>

        <!-- Footer Identitas -->
        <div class="footer-identity">
            <p class="nama-mhs">IKA PUSPITA SARI</p>
            <p class="nim-mhs">NIM: 2202505045</p>
        </div>
    </div>

    <!-- Script JavaScript Pencarian -->
    <script>
    function cariData() {
        let input = document.getElementById("inputCari").value.toLowerCase();
        let table = document.getElementById("tabelAlat");
        let tr = table.getElementsByTagName("tr");
        let pesanKosong = document.getElementById("pesanKosong");
        let adaData = false;

        for (let i = 1; i < tr.length; i++) {
            let tdNama = tr[i].getElementsByTagName("td")[0];
            let tdLokasi = tr[i].getElementsByTagName("td")[3];
            
            if (tdNama || tdLokasi) {
                let teksNama = (tdNama.textContent || tdNama.innerText).toLowerCase();
                let teksLokasi = (tdLokasi.textContent || tdLokasi.innerText).toLowerCase();
                
                if (teksNama.indexOf(input) > -1 || teksLokasi.indexOf(input) > -1) {
                    tr[i].style.display = "";
                    adaData = true;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        if (!adaData && input !== "") {
            pesanKosong.style.display = "block";
        } else {
            pesanKosong.style.display = "none";
        }
    }
    </script>

</body>
</html>