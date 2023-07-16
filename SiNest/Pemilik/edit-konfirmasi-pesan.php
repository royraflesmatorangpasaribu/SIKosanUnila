<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';

// Memanggil kolom yang ada pada tabel 
$query_mysql = mysqli_query($mysqli, "SELECT * FROM transaksi where id_transaksi = '$_GET[update]'");
$result2 = mysqli_fetch_assoc($query_mysql);

$query_mysql = mysqli_query($mysqli, "SELECT * FROM profilpenyewa");
$result = mysqli_fetch_assoc($query_mysql);

if (isset($_POST['lanjutkan'])) {
    // Menambahkan data ke tabel transaksi
    $id_transaksi = $result2['id_transaksi'];
    $id_kos = $result2['id_kos'];
    $id_penyewa = $result['id_penyewa'];
    $konfirmasi = 'Terkonfirmasi';
    $tanggal_masuk = $result2['tanggal_masuk'];
    $tanggal_keluar = $result2['tanggal_keluar'];

    $query_update = "UPDATE transaksi SET
    id_transaksi = '$id_transaksi',
    id_kos = '$id_kos',
    id_penyewa = '$id_penyewa',
    konfirmasi = '$konfirmasi', 
    tanggal_masuk = '$tanggal_masuk', 
    tanggal_keluar = '$tanggal_keluar' WHERE id_transaksi = '$_GET[update]'";

    if (mysqli_query($mysqli, $query_update)) {
        // Jika data berhasil diupdate

        echo '<script>
          window.addEventListener("DOMContentLoaded", function() {
            appendAlert("Berhasil mengkonfirmasi pemesanan", "success");
          });
        </script>';
        echo "<meta http-equiv=refresh content=2;URL='konfirmasi-pesanan.php'>";
    } else {
        // Jika terjadi kesalahan dalam mengupdate data

        echo '<script>
          window.addEventListener("DOMContentLoaded", function() {
            appendAlert("Gagal mengkonfirmasi pemesanan", "danger");
          });
        </script>';
        echo "<meta http-equiv=refresh content=2;URL='konfirmasi-pesanan.php'>";
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
        <!-- Profile Start -->
        <section class="section">

            <!-- Notifikasi -->
            <div id="alertContainer"></div>

            <div class="col-xxl-4 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Data Profile</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <img class="rounded-circle" src=" ../Pemilik/uploadimg/<?php echo $result['foto']; ?>" alt="profilpenyewakos" width="250" height="250">
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
                                                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" value="<?php echo $result['nama_penyewa']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                        <div class="col-sm-10">
                                                            <select name="jenis_kelamin" class="form-select" aria-label="Default select example" disabled>
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
                                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="npm" class="col-sm-2 col-form-label">No HP</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="noHp" name="noHp" value="<?php echo $result['no_hp']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="npm" class="col-sm-2 col-form-label">Alamat</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $result['alamat']; ?>" disabled>
                                                        </div>
                                                    </div>
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
        </section>

        <a href="#" class="btn btn-warning" id="btnpesan" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Konfirmasi</a>

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h5 class="modal-title" id="konfirmasiModalLabel" style="color: #34408C;">Konfirmasi Pemesanan</h5>
                        <hr>
                        <a href="#" class="btn btn-light" style="background-color: #55F998; color: black;" data-bs-toggle="modal" data-bs-target="#lanjutkanModal">Konfirmasi</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Lanjutkan -->
        <div class="modal fade" id="lanjutkanModal" tabindex="-1" aria-labelledby="lanjutkanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="../iconsinest/questionicon.svg" alt="">
                        <h5 class="modal-title" id="lanjutkanModalLabel" style="color: black;">Anda yakin mengkonfirmasi Pemesanan ini?</b></h5>
                        <hr>
                        <form method="post" action="">
                            <button type="submit" name="lanjutkan" class="btn btn-light" style="background-color: #55F998; color: black;">Ya</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="background-color: #FF8E8E; color: black;">Tidak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Main Menu End -->

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>

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