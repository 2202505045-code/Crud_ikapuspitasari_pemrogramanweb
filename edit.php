<?php
// Memanggil file koneksi
include_once("config.php");

// Pengecekan apakah form disubmit untuk update data
if(isset($_POST['update'])) {	
    $id = $_POST['id'];
    
    $nama_alat = $_POST['nama_alat'];
    $tahun = $_POST['tahun'];
    $merek = $_POST['merek'];
    $lokasi = $_POST['lokasi'];
        
    // Update data ke database
    $result = mysqli_query($mysqli, "UPDATE alat SET nama_alat='$nama_alat', tahun='$tahun', merek='$merek', lokasi='$lokasi' WHERE id=$id");
    
    // Redirect kembali ke halaman utama
    echo "<script>alert('Data alat berhasil diperbarui!'); window.location.href='index.php';</script>";
}

// Mengambil id dari URL
$id = $_GET['id'];

// Mengambil data berdasarkan id untuk ditampilkan di form
$result = mysqli_query($mysqli, "SELECT * FROM alat WHERE id=$id");

while($user_data = mysqli_fetch_array($result)) {
    $nama_alat = $user_data['nama_alat'];
    $tahun = $user_data['tahun'];
    $merek = $user_data['merek'];
    $lokasi = $user_data['lokasi'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sim Rs - Edit Data Alat</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            padding: 40px 20px;
            background-color: #fffdf5;
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

        .alkes-badge {
            position: absolute;
            top: 25px;
            right: 35px;
            color: #eab308; /* Kuning Amber menyesuaikan aksi edit */
            background-color: #fef9c3;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #fef08a;
        }

        h2 {
            color: #0f172a;
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
        }

        .sub-title {
            color: #eab308; /* Diubah ke warna Amber agar match dengan tema edit */
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
            border-color: #eab308;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.15);
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

        .btn-update {
            background-color: #eab308; /* Kuning Mustard / Amber */
            color: white;
            flex: 2;
            box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
        }

        .btn-update:hover {
            background-color: #ca8a04;
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
        <!-- Logo Medis Mini Amber -->
        <div class="alkes-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" /><path d="M12 9v4M10 11h4" /></svg>
        </div>

        <h2>Edit Data Alat</h2>
        <div class="sub-title">Perbarui Informasi Alat Kesehatan</div>

        <form name="update_alat" method="post" action="edit.php">
            <div class="form-group">
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" value="<?php echo $nama_alat;?>" required>
            </div>
            
            <div class="form-group">
                <label>Tahun Pengadaan</label>
                <input type="number" name="tahun" value="<?php echo $tahun;?>" required>
            </div>
            
            <div class="form-group">
                <label>Merek</label>
                <input type="text" name="merek" value="<?php echo $merek;?>" required>
            </div>
            
            <div class="form-group">
                <label>Lokasi / Ruangan</label>
                <input type="text" name="lokasi" value="<?php echo $lokasi;?>" required>
            </div>

            <div class="action-buttons">
                <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                <a href="index.php" class="btn btn-kembali">Kembali</a>
                <input type="submit" name="update" value="Perbarui Data" class="btn btn-update">
            </div>
        </form>
    </div>

</body>
</html>