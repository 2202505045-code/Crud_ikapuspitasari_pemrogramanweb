<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Add Alat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 40%; margin-top: 20px; }
        td { padding: 8px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 6px; box-sizing: border-box; }
        input[type="submit"] { background-color: #007bff; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-kembali { background-color: #6c757d; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .alert-success { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-top: 15px; width: 40%; }
    </style>
</head>
<body>

    <h2>Tambah Data Alat</h2>
    <a href="index.php" class="btn-kembali">Kembali ke Home</a>

    <form action="add.php" method="post" name="form1">
        <table border="0">
            <tr> 
                <td>Nama Alat</td>
                <td><input type="text" name="nama_alat" required></td>
            </tr>
            <tr> 
                <td>Tahun</td>
                <td><input type="number" name="tahun" required></td>
            </tr>
            <tr> 
                <td>Merek</td>
                <td><input type="text" name="merek" required></td>
            </tr>
            <tr> 
                <td>Lokasi</td>
                <td><input type="text" name="lokasi" required></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Simpan Data"></td>
            </tr>
        </table>
    </form>

    <?php
    // Jika tombol submit ditekan, proses data berikut
    if(isset($_POST['Submit'])) {
        $nama_alat = $_POST['nama_alat'];
        $tahun = $_POST['tahun'];
        $merek = $_POST['merek'];
        $lokasi = $_POST['lokasi'];

        // Panggil file koneksi database
        include_once("config.php");
                
        // Query untuk memasukkan data ke tabel 'alat'
        $result = mysqli_query($mysqli, "INSERT INTO alat(nama_alat, tahun, merek, lokasi) VALUES('$nama_alat', '$tahun', '$merek', '$lokasi')");
        
        // Menampilkan pesan sukses
        if($result) {
            echo "<div class='alert-success'>Data Alat berhasil ditambahkan. <a href='index.php'>Lihat Data</a></div>";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($mysqli);
        }
    }
    ?>
</body>
</html>