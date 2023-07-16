<?php
include "../SESSION-Login/koneksi.php";
// mengambil data dari form
$nama = $_POST['resuser'];
$pass = $_POST['respass'];
// Mengecek kondisi jika user adalah admin
$sql = mysqli_query($mysqli, "SELECT * FROM login_admin WHERE user_admin='$nama' AND pass_admin='$pass'");
$result = mysqli_fetch_array($sql);

if ($result) {
    echo "<script>alert('Gagal registrasi.');</script>";
    echo "<script>window.location.replace('../index.php');</script>";
    exit();
}

// Menyimpan/menambah data ke database
$sql = "INSERT INTO login (id, user, pass) VALUES ('', '$nama', '$pass')";

if (mysqli_query($mysqli, $sql)) {
    echo "<script>alert('Registrasi berhasil.');</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($mysqli) . "');</script>";
}

echo "<script>window.location.replace('../index.php');</script>";
exit();
