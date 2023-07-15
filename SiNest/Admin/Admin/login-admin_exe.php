<?php
session_start();
include "../SESSION-Login/koneksi.php";

$username = $_POST['user'];
$password = $_POST['pass'];

$query = mysqli_query($mysqli, "SELECT * FROM login_admin where user_admin='$username' and pass_admin='$password'");

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $_SESSION['login'] = true;
    header('Location: home-admin.php');
    exit();
} else {
    header("location: ../index.php");
}
