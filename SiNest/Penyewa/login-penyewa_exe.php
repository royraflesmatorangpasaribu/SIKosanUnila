<?php
session_start();
include "../SESSION-Login/koneksi.php";

$username = $_POST['user'];
$password = $_POST['pass'];

$query = mysqli_query($mysqli, "SELECT * FROM login_penyewa where user_penyewa='$username' and pass_penyewa='$password'");

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $_SESSION['login'] = true;
    header('Location: home-penyewa.php');
    exit();
} else {
    header("location: ../index.php");
}
