<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';

// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM profilpenyewa");
$result = mysqli_fetch_assoc($query_mysql);
$no = 1;

// Saat tombol Delete ditekan maka data akan dihapus setelah dikonfirmasi
if (isset($_POST['hapus'])) {
    $id_kos = $_POST['hapus'];

    // Mengambil informasi foto dari database berdasarkan ID driver
    $sql_select = "SELECT foto FROM riwayat_kos WHERE id_kos = $id_kos";
    $result_select = mysqli_query($mysqli, $sql_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $namaFoto = $row_select['foto'];

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM riwayat_kos WHERE id_kos = $id_kos";
    if (mysqli_query($mysqli, $sql_delete)) {
        // Menghapus file foto dari folder uploadimg
        $target_file = "../Pemilik/uploadimg/" . $namaFoto;
        if (file_exists($target_file)) {
            unlink($target_file);
            echo "Data berhasil dihapus.";
        } else {
            echo "Data berhasil dihapus, tetapi file foto tidak ditemukan.";
        }
    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($mysqli);
    }
}
?>

<!-- Melakukan Proses Hapus data berdasarkan data yang dipilih -->
<?php
if (isset($_GET['hapus'])) {
    $id_kos = $_GET['hapus'];

    // Mengambil informasi foto dari database berdasarkan ID driver
    $sql_select = "SELECT foto FROM riwayat_kos WHERE id_kos = $id_kos";
    $result_select = mysqli_query($mysqli, $sql_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $namaFoto = $row_select['foto'];

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM riwayat_kos WHERE id_kos = $id_kos";
    if (mysqli_query($mysqli, $sql_delete)) {
        // Menghapus file foto dari folder uploadimg
        $target_file = "../Pemilik/uploadimg/" . $namaFoto;
        if (file_exists($target_file)) {
            unlink($target_file);
            echo "<p><b>Data deleted successfully</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='pem.php'>";
        } else {
            echo "<p><b>Data deleted successfully, but the photo file was not found</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='pem.php'>";
        }
    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

    <!-- CSS Template -->
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Bootsrtap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- icon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>SINest</title>

    <style>
        span {
            color: black;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php
    include 'sidebar-penyewa.php'
    ?>

    <main id="main" class="main">
        <!-- Profile Start -->
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Data Profile</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <img src="../Pemilik/uploadimg/<?php echo $result['foto']; ?>" alt="profilpenyewakos" width="250" height="250">
                        </div>
                        <div class="ps-3">
                            <table>
                                <tbody>
                                    <tr>
                                        <td width="5000px">
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <div class="mb-3 row">
                                                    <label for="npm" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" value="<?php echo $result['nama_penyewa']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                    <div class="col-sm-10">
                                                        <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
                                                            <option selected hidden><?php echo $result['jenis_kelamin']; ?></option>
                                                            <option>Pilih jenis kelamin</option>
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="npm" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="npm" class="col-sm-2 col-form-label">No HP</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="noHp" name="noHp" value="<?php echo $result['no_hp']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="npm" class="col-sm-2 col-form-label">Alamat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $result['alamat']; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="npm" class="col-sm-2 col-form-label">Foto</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" id="alamat" name="foto">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="update">Save</button>

                                            </form>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div><!-- End Customers Card -->
        <!-- Profile End -->
    </main>
    <!-- Main Menu End -->

    <!-- Bootsrtap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>

<?php
// Melakukan update saat tombol Edit Data ditekan
if (isset($_POST['update'])) {
    // Memperoleh data dari input form
    $nama_penyewa = $_POST['namaLengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $no_hp = $_POST['noHp'];
    $alamat = $_POST['alamat'];

    // Menghapus foto sebelumnya jika ada foto baru yang diunggah
    if ($_FILES['foto']['error'] != 4) {
        $foto_sebelumnya = $result['foto'];
        if (!empty($foto_sebelumnya)) {
            unlink("../Pemilik/uploadimg/$foto_sebelumnya");
        }
        // Mengunggah foto baru
        $foto_name = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_ext = strtolower(pathinfo($foto_name, PATHINFO_EXTENSION));

        // Memeriksa ekstensi file yang diunggah
        $allowed_extensions = array('gif', 'jpg', 'jpeg', 'png');
        if (in_array($foto_ext, $allowed_extensions)) {
            $foto = $foto_name;
            $upload_path = "../Pemilik/uploadimg/";

            // Jika file dengan nama yang sama sudah ada, tambahkan angka pada bagian akhir nama file
            $counter = 1;
            while (file_exists($upload_path . $foto)) {
                $foto = pathinfo($foto_name, PATHINFO_FILENAME) . '_' . $counter . '.' . $foto_ext;
                $counter++;
            }

            move_uploaded_file($foto_tmp, $upload_path . $foto);
        } else {
            echo "<script>alert('Jenis file yang diunggah tidak valid. Hanya file GIF, JPG, JPEG, dan PNG yang diizinkan.');
            document.location='home-penyewa.php'</script>";
            exit();
        }
    } else {
        // Jika tidak ada foto baru diunggah, tetap gunakan foto sebelumnya
        $foto = $result['foto'];
    }

    // Melakukan query update ke database
    mysqli_query($mysqli, "UPDATE profilpenyewa SET
    id_penyewa = 1,
    nama_penyewa = '$nama_penyewa',
    jenis_kelamin = '$jenis_kelamin',
    email = '$email',
    no_hp = '$no_hp',
    alamat = '$alamat',
    foto = '$foto' WHERE id_penyewa = 1") or die(mysqli_error($mysqli));

    echo "<script>alert('Data telah tersimpan');
    document.location='home-penyewa.php'</script>";
}
?>