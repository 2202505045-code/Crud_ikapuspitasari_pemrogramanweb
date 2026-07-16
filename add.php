<?php
// Melakukan pengecekan apakah form telah disubmit, lalu memasukkan data ke database.
if(isset($_POST['Submit'])) {
    $nama_alat = $_POST['nama_alat'];
    $tahun = $_POST['tahun'];
    $merek = $_POST['merek'];
    $lokasi = $_POST['lokasi'];
    
    // Memanggil file koneksi
    include_once("config.php");
        
    // Memasukkan data ke database
    $result = mysqli_query($mysqli, "INSERT INTO alat(nama_alat,tahun,merek,lokasi) VALUES('$nama_alat','$tahun','$merek','$lokasi')");
    
    // Menampilkan pesan sukses dan redirect ke halaman utama
    echo "<script>alert('Data alat berhasil ditambahkan!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sim Rs - Tambah Data Alat</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            padding: 40px 20px;
            background-color: #fffdf5; /* Latar belakang kuning gading lembut */
            color: #334155;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(234, 179, 8, 0.04);
            border: 1px solid #fcf0cc;
            position: relative;
        }

        /* Ikon Hati Medis di kanan atas */
        .alkes-badge {
            position: absolute;
            top: 25px;
            right: 35px;
            color: #0d9488;
            background-color: #fef9c3;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #fef08a;
        }

        h2 {
            color: #0f172a; /* Deep Navy */
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
        }

        .sub-title {
            color: #0d9488; /* Tosca */
            font-size: 13px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #475569;
            font-size: 14px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
            box-sizing: border-box;
            background-color: #f8fafc;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #0d9488;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-submit {
            background-color: #0d9488; /* Tosca Utama */
            color: white;
            flex: 2;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);
        }

        .btn-submit:hover {
            background-color: #0f766e;
            transform: translateY(-1px);
        }

        .btn-kembali {
            background-color: #e2e8f0;
            color: #475569;
            flex: 1;
        }

        .btn-kembali:hover {
            background-color: #cbd5e1;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo Medis Mini -->
        <div class="alkes-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" /><path d="M12 9v4M10 11h4" /></svg>
        </div>

        <h2>Tambah Data Alat</h2>
        <div class="sub-title">Form Inventaris Alat Kesehatan Baru</div>

        <form action="add.php" method="post" name="form1">
            <div class="form-group">
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" placeholder="Contoh: Stetoskop Duplex" required>
            </div>
            
            <div class="form-group">
                <label>Tahun Pengadaan</label>
                <input type="number" name="tahun" placeholder="Contoh: 2026" required>
            </div>
            
            <div class="form-group">
                <label>Merek</label>
                <input type="text" name="merek" placeholder="Contoh: Philips / GE" required>
            </div>
            
            <div class="form-group">
                <label>Lokasi / Ruangan</label>
                <input type="text" name="lokasi" placeholder="Contoh: Ruang ICU" required>
            </div>

            <div class="action-buttons">
                <a href="index.php" class="btn btn-kembali">Kembali</a>
                <input type="submit" name="Submit" value="Simpan Data" class="btn btn-submit">
            </div>
        </form>
    </div>

</body>
</html>