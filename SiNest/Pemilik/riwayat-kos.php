<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';
// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM riwayat_kos");
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
        $target_file = "uploadimg/" . $namaFoto;
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

// Saat tombol Delete ditekan maka data akan dihapus setelah dikonfirmasi
if (isset($_POST['hapus'])) {
    $id_kos = $_POST['hapus'];

    // Mengambil informasi foto dari database berdasarkan ID driver
    $sql_select = "SELECT foto FROM foto_fasilitas WHERE id_kos = $id_kos";
    $result_select = mysqli_query($mysqli, $sql_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $namaFoto = $row_select['foto'];

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM foto_fasilitas WHERE id_kos = $id_kos";
    if (mysqli_query($mysqli, $sql_delete)) {
        // Menghapus file foto dari folder uploadimg
        $target_file = "uploadimg/" . $namaFoto;
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
        $target_file = "uploadimg/" . $namaFoto;
        if (file_exists($target_file)) {
            unlink($target_file);
            echo "<p><b>Data deleted successfully</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='riwayat-kos.php'>";
        } else {
            echo "<p><b>Data deleted successfully, but the photo file was not found</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='riwayat-kos.php'>";
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
    $sql_select = "SELECT foto FROM foto_fasilitas WHERE id_kos = $id_kos";
    $result_select = mysqli_query($mysqli, $sql_select);
    $row_select = mysqli_fetch_assoc($result_select);
    $namaFoto = $row_select['foto'];

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM foto_fasilitas WHERE id_kos = $id_kos";
    if (mysqli_query($mysqli, $sql_delete)) {
        // Menghapus file foto dari folder uploadimg
        $target_file = "uploadimg/" . $namaFoto;
        if (file_exists($target_file)) {
            unlink($target_file);
            echo "<p><b>Data deleted successfully</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='riwayat-kos.php'>";
        } else {
            echo "<p><b>Data deleted successfully, but the photo file was not found</b></p>";
            echo "<meta http-equiv=refresh content=2;URL='riwayat-kos.php'>";
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
    include 'sidebar-pemilik2.php'
    ?>

    <!-- Main Menu Start -->
    <main id="main" class="main">
        <!-- Tabel Start -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mb-4">Daftar Riwayat Kos <a href="tambah-kos.php" type="button" class="btn btn-outline-dark btn-warning" style="background-color: #56F997;"><img src="../iconsinest/tambahdataicon.svg" alt="" style="width: 24px;"> Tambah</a><br><br></h5>

                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kos</th>
                                            <th>Status</th>
                                            <th>Tipe Kos</th>
                                            <th>Fasilitas</th>
                                            <th>Lokasi</th>
                                            <th>Kapasitas</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th colspan="2">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($result = mysqli_fetch_assoc($query_mysql)) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?= $result['nama_kos']; ?></td>
                                                <td><!-- Status Kos Start -->
                                                    <?php if ($result['status_kos'] == 'Tersedia') { ?>
                                                        <h7 class="card-title"><button type="button" class="btn btn-info btn-sm rounded-pill btn-sm"><?php echo $result['status_kos']; ?></button></h7>
                                                    <?php } else { ?>
                                                        <h7 class="card-title"><button type="button" class="btn btn-danger btn-sm rounded-pill btn-sm"><?php echo $result['status_kos']; ?></button></h7>
                                                    <?php } ?>
                                                    <!-- Status Kos End -->
                                                </td>
                                                <td><!-- Tipe Kos Start -->
                                                    <?php if ($result['tipe_kos'] == 'Putra') { ?>
                                                        <h7 class="card-title"><button type="button" class="btn btn-success btn-sm"><?php echo $result['tipe_kos']; ?></button></h7>
                                                    <?php } else if ($result['tipe_kos'] == 'Putri') { ?>
                                                        <h7 class="card-title"><button type="button" class="btn btn-danger btn-sm" style="background-color: #FF8E8E"><?php echo $result['tipe_kos']; ?></button></h7>
                                                    <?php } else { ?>
                                                        <h7 class="card-title"><button type="button" class="btn btn-primary btn-sm"><?php echo $result['tipe_kos']; ?></button></h7>
                                                    <?php } ?>
                                                    <!-- Tipe Kos End -->
                                                </td>
                                                <td><?= $result['fasilitas_kos']; ?></td>
                                                <td><?= $result['lokasi_kos']; ?></td>
                                                <td><?= $result['kapasitas_kos']; ?></td>
                                                <td><?= $result['harga_kos']; ?></td>
                                                <td><img src="uploadimg/<?= $result['foto']; ?>" alt="" style="width: 100px"></td>
                                                <td>
                                                    <!-- Button Edit -->
                                                    <a href="edit-kos.php?update=<?php echo $result['id_kos']; ?>">
                                                        <button type="button" class="btn btn-light" value="Edit"><img src="../iconsinest/editkos.svg" alt=""></button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Button Delete -->
                                                    <a href="?hapus=<?php echo $result['id_kos']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <button type="button" class="btn btn-light"><img src="../iconsinest/hapukos.svg" alt=""></button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Tabel End -->
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