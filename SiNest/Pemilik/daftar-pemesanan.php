<?php
include '../SESSION-Login/session-cek.php'
?>

<?php

include '../SESSION-Login/koneksi.php';

// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM transaksi_view");
$no = 1;

// Saat tombol Delete ditekan maka data akan dihapus setelah dikonfirmasi
if (isset($_GET['hapus'])) {
    $id_transaksi = $_GET['hapus'];
    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
}

// Notif
if (isset($_GET['hapus'])) {

    // Menghapus data berdasarkan kolom yang dipilih
    $sql_delete = "DELETE FROM transaksi WHERE id_transaksi = '$_GET[hapus]'";

    if (mysqli_query($mysqli, $sql_delete)) {
        // Jika data berhasil dihapus dari tabel transaksi
        echo '<script>
          window.addEventListener("DOMContentLoaded", function() {
            appendAlert("Data Berhasil Dihapus", "success");
          });
        </script>';
        echo "<meta http-equiv=refresh content=2;URL='daftar-pemesanan.php'>";
    } else {
        // Jika terjadi kesalahan dalam menghapus data dari tabel transaksi
        echo '<script>
          window.addEventListener("DOMContentLoaded", function() {
            appendAlert("Data Tidak Berhasil Dihapus", "error");
          });
        </script>';
        echo "<meta http-equiv=refresh content=2;URL='daftar-pemesanan.php'>";
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

            <!-- Notifikasi -->
            <div id="alertContainer"></div>

            <div class="row">
                <div class="col-lg-12">
                    <h5 class="card-title">Daftar Pemesanan</h5>

                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table datatable table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Transaksi</th>
                                            <th>Nama Penyewa</th>
                                            <th>Nama Kos</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Harga Kos</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($result = mysqli_fetch_assoc($query_mysql)) { ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?= $result['id_transaksi']; ?></td>
                                                <td><?= $result['nama_penyewa']; ?></td>
                                                <td><?= $result['nama_kos']; ?></td>
                                                <td><?= $result['tanggal_masuk']; ?></td>
                                                <td><?= $result['harga_kos']; ?></td>
                                                <td>
                                                    <!-- Button Delete -->
                                                    <a href="?hapus=<?php echo $result['id_transaksi']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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

    <!-- Alert -->
    <script>
        function appendAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');

            const alertEl = document.createElement('div');
            alertEl.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show');
            alertEl.setAttribute('role', 'alert');

            const iconEl = document.createElement('i');
            iconEl.classList.add('bi', type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill', 'me-2');
            alertEl.appendChild(iconEl);

            const messageEl = document.createElement('span');
            messageEl.innerText = message;
            alertEl.appendChild(messageEl);

            const closeButton = document.createElement('button');
            closeButton.classList.add('btn-close');
            closeButton.setAttribute('type', 'button');
            closeButton.setAttribute('data-bs-dismiss', 'alert');
            closeButton.setAttribute('aria-label', 'Close');
            alertEl.appendChild(closeButton);

            alertContainer.appendChild(alertEl);
        }
    </script>
</body>

</html>