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
            background-color: #fffbef; /* Latar belakang kuning pastel soft */
            color: #334155;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(230, 180, 0, 0.06);
            border: 1px solid #fcf0cc;
        }

        h2 {
            color: #0d9488; /* Hijau Tosca Utama */
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 700;
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
            background-color: #14b8a6; /* Hijau Tosca */
            color: white; 
            padding: 12px 24px;
            text-decoration: none; 
            border-radius: 10px; 
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.2);
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
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .input-cari:focus {
            border-color: #14b8a6;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
        }

        /* Ikon Kaca Pembesar Simpel */
        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        /* Desain Tabel Menarik */
        .table-wrapper {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid #e2e8f0;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        
        th { 
            background-color: #e6fffa; /* Background Tosca soft */
            color: #0d9488; /* Teks Tosca Gelap */
            padding: 16px; 
            text-align: left; 
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid #14b8a6;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td { 
            padding: 16px; 
            border-bottom: 1px solid #f1f5f9; 
            font-size: 14px;
            color: #475569;
        }
        
        /* Baris selang-seling Kuning Lemon Pastel */
        tr:nth-child(even) { 
            background-color: #fefce8; 
        }
        
        tr:hover {
            background-color: #f0fdfa; /* Hover efek tosca air */
        }

        .btn-aksi { 
            text-decoration: none; 
            padding: 6px 14px; 
            color: white; 
            border-radius: 8px; 
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-right: 5px;
            transition: opacity 0.2s;
        }

        .btn-aksi:hover {
            opacity: 0.9;
        }
        
        .btn-edit { 
            background-color: #eab308; /* Kuning Amber modern */
        }
        
        .btn-delete { 
            background-color: #ef4444; /* Merah soft */
        }

        /* Pesan jika pencarian tidak ditemukan */
        .no-data {
            text-align: center;
            padding: 20px;
            color: #94a3b8;
            display: none;
            font-style: italic;
        }

        /* Footer Identitas Minimalis */
        .footer-identity {
            margin-top: 50px;
            padding-top: 25px;
            border-top: 1px dashed #e2e8f0;
            text-align: center;
        }
        
        .nama-mhs {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
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
        <h2>Daftar Data Alat</h2>
        
        <div class="action-bar">
            <!-- Tombol Tambah Data -->
            <a href="add.php" class="btn-tambah">+ Tambah Alat Baru</a>
            
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

        <!-- Footer Identitas Minimalis -->
        <div class="footer-identity">
            <p class="nama-mhs">IKA PUSPITA SARI</p>
            <p class="nim-mhs">NIM: 2202505045</p>
        </div>
    </div>

    <!-- Script JavaScript untuk Fungsi Pencarian Real-time yang Sudah Diperbaiki -->
    <script>
    function cariData() {
        let input = document.getElementById("inputCari").value.toLowerCase();
        let table = document.getElementById("tabelAlat");
        let tr = table.getElementsByTagName("tr");
        let pesanKosong = document.getElementById("pesanKosong");
        let adaData = false;

        // Loop melalui semua baris tabel (lewati baris header index 0)
        for (let i = 1; i < tr.length; i++) {
            let tdNama = tr[i].getElementsByTagName("td")[0];
            let tdLokasi = tr[i].getElementsByTagName("td")[3];
            
            if (tdNama || tdLokasi) {
                let teksNama = (tdNama.textContent || tdNama.innerText).toLowerCase();
                let teksLokasi = (tdLokasi.textContent || tdLokasi.innerText).toLowerCase();
                
                // Cek apakah input ada di dalam kolom Nama Alat ATAU Lokasi
                if (teksNama.indexOf(input) > -1 || teksLokasi.indexOf(input) > -1) {
                    tr[i].style.display = "";
                    adaData = true;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        // Tampilkan pesan jika data tidak ada yang cocok sama sekali
        if (!adaData && input !== "") {
            pesanKosong.style.display = "block";
        } else {
            pesanKosong.style.display = "none";
        }
    }
    </script>

</body>
</html>