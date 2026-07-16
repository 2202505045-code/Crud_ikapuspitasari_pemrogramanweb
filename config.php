<?php
$databaseHost = 'localhost';
$databaseName = 'simrs'; // Ganti jika nama database di phpMyAdmin Anda berbeda
$databaseUsername = 'root';
$databasePassword = ''; // Kosongkan jika menggunakan XAMPP bawaan

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

// Cek koneksi
if (!$mysqli) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>