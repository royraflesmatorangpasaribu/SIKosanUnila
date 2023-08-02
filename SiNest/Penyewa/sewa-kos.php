<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';
// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM riwayat_kos where id_kos = '$_GET[update]'");
$result2 = mysqli_fetch_assoc($query_mysql);

$query_mysql = mysqli_query($mysqli, "SELECT * FROM foto_fasilitas where id_kos = '$_GET[update]'");

$query = mysqli_query($mysqli, "SELECT * FROM profilpenyewa");
$result3 = mysqli_fetch_assoc($query);

if (isset($_POST['lanjutkan'])) {
    // Menambahkan data ke tabel transaksi
    $tanggal_masuk = date("Y-m-d");
    // Di isi 1 tahun dari tanggal masuk
    $tanggal_keluar = date("Y-m-d", strtotime("+1 year", strtotime($tanggal_masuk)));
    $id_kos = $result2['id_kos'];
    $id_penyewa = $result3['id_penyewa'];

    $query_insert = "INSERT INTO transaksi (id_kos, id_penyewa, konfirmasi, tanggal_masuk, tanggal_keluar) 
                     VALUES ('$id_kos', '$id_penyewa', 'Menunggu Konfirmasi', '$tanggal_masuk', '$tanggal_keluar')";

    if (mysqli_query($mysqli, $query_insert)) {
        // Jika data berhasil ditambahkan ke tabel transaksi
        echo '<script>
          window.addEventListener("DOMContentLoaded", function() {
            appendAlert("Pemesanan Berhasil Dibuat", "success");
          });
        </script>';
        echo "<meta http-equiv=refresh content=2;URL='melihat-kos.php'>";
    } else {
        // Jika terjadi kesalahan dalam menambahkan data ke tabel transaksi
        echo '<script>
          window.addEventListener("DOMContentLoaded", function() {
            appendAlert("Pemesanan Tidak Berhasil Dibuat", "danger");
          });
        </script>';
        echo "<meta http-equiv=refresh content=2;URL='melihat-kos.php'>";
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

        body {
            margin-top: 20px;
            background-color: #f5f7fa;
        }

        .mb-4x {
            margin-bottom: 24px;
        }

        .mt-4x {
            margin-top: 24px;
        }

        .bg-white {
            background-color: #fff !important;
            color: rgba(22, 24, 27, 0.87);
        }

        .panel {
            border: none;
            box-shadow: 0 1px 3px -1px rgba(22, 24, 27, 0.26);
            transition: background-color 250ms ease, opacity 250ms linear;
        }

        .panel-default {
            border-color: rgba(22, 24, 27, 0.12);
        }

        .corner-all,
        .corner-right,
        .corner-top,
        .corner-tr {
            border-top-right-radius: 2px;
        }

        .corner-all,
        .corner-left,
        .corner-tl,
        .corner-top {
            border-top-left-radius: 2px;
        }

        .embed-responsive-16by9 {
            padding-bottom: 56.25%;
        }

        .bg-grd-dark,
        .bg-grd-inverse {
            background: linear-gradient(45deg, #0a0213 0, rgba(10, 2, 19, 0) 70%),
                linear-gradient(135deg, #07252c 10%, rgba(7, 37, 44, 0) 80%),
                linear-gradient(225deg, #031b49 10%, rgba(3, 27, 73, 0) 80%),
                linear-gradient(315deg, #100462 100%, rgba(16, 4, 98, 0) 70%);
        }

        .embed-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.6;
            filter: alpha(opacity=60);
        }

        .embed-extend-item {
            position: relative;
            padding: 0 15px 5px;
        }

        .embed-extend-item>.kit-avatar.kit-avatar-96 {
            margin-top: -48px;
        }

        .embed-extend-item>.kit-avatar.pull-left {
            margin-right: 10px;
        }

        .embed-extend-item>.kit-avatar {
            position: relative;
            padding: 0;
        }

        .kit-avatar.kit-avatar-96 {
            border: 3px solid rgba(22, 24, 27, 0.12);
            border-radius: 96px;
        }

        .embed-extend-item a,
        .embed-extend-item a:hover {
            color: inherit;
            text-decoration: none;
        }

        .kit-avatar.kit-avatar-96>img {
            width: 96px;
            height: auto;
            border-radius: 48px;
        }

        .embed-extend-item h3,
        .embed-extend-item h4,
        .embed-extend-item h5,
        .embed-extend-item h6 {
            margin: 0;
            padding-top: 3px;
        }

        .embed-extend-item h3>small,
        .embed-extend-item h4>small,
        .embed-extend-item h5>small,
        .embed-extend-item h6>small {
            display: block;
            color: rgba(22, 24, 27, 0.54);
        }

        .body-text,
        .headline,
        .subhead,
        .title {
            color: rgba(22, 24, 27, 0.87);
        }

        .h4,
        .subhead,
        h4 {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .bordered,
        .bordered-right {
            border-right: 1px solid rgba(22, 24, 27, 0.12) !important;
        }

        a {
            text-decoration: none;
        }

        .status-kos {
            position: absolute;
            top: -20px;
            right: 0;
            margin-left: 10px;
        }

        #card-style {
            background-color: #D9D9D9;
        }

        .card-img-container {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .card-img {
            object-fit: contain;
            max-height: 100%;
            max-width: 100%;
        }

        .image-container {
            display: flex;
            flex-wrap: wrap;
        }

        .image-fasilitas {
            margin-right: 10px;
            margin-bottom: 10px;
            width: calc(33.33% - 10px);
            /* Mengatur lebar gambar menjadi 1/3 dari container */
        }

        .image-fasilitas img {
            width: 100%;
            height: auto;
            aspect-ratio: 3/2;
            /* Mengatur rasio lebar dan tinggi gambar menjadi 3:2 */
        }

        #btnpesan {
            display: inline-block;
            width: 20%;
            margin: 10px;
        }

        /* Responsif untuk perangkat dengan lebar layar maksimum 600px */
        @media (max-width: 600px) {
            .image-fasilitas img {
                display: block;
                width: 100%;
                height: auto;
            }

            #btnpesan {
                display: block;
                width: 100%;
                margin-bottom: 0.5em;
            }
        }

        .modal-header {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php
    include 'sidebar-penyewa2.php'
    ?>

    <main id="main" class="main">
        <!-- Profile Start -->
        <section class="section">

            <!-- Notifikasi -->
            <div id="alertContainer"></div>

            <!-- Card with an image on top -->
            <div class="card mb-3" style="max-width: 100%;" id="card-style">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="card-img-container">
                            <img src="../Pemilik/uploadimg/<?php echo $result2['foto']; ?>" class="img-fluid rounded-start card-img" alt="..." style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $result2['nama_kos']; ?></h5>

                            <!-- Tipe Kos Start -->
                            <?php if ($result2['tipe_kos'] == 'Putra') { ?>
                                <h5 class="card-title"><button type="button" class="btn btn-success"><?php echo $result2['tipe_kos']; ?></button></h5>
                            <?php } else if ($result2['tipe_kos'] == 'Putri') { ?>
                                <h5 class="card-title"><button type="button" class="btn btn-danger" style="background-color: #FF8E8E"><?php echo $result2['tipe_kos']; ?></button></h5>
                            <?php } else { ?>
                                <h5 class="card-title"><button type="button" class="btn btn-primary"><?php echo $result2['tipe_kos']; ?></button></h5>
                            <?php } ?>
                            <!-- Tipe Kos End -->

                            <p class="card-text"><?php echo $result2['lokasi_kos']; ?></p>
                            <h5 class="card-title">Rp <?php echo $result2['harga_kos']; ?>/Tahun</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section><br>

        <h5><strong>Fasilitas:</strong></h5>
        <div class="image-container">
            <?php while ($result4 = mysqli_fetch_assoc($query_mysql)) { ?>
                <div class="image-fasilitas">
                    <img src="../Pemilik/uploadimg/<?php echo $result4['foto_fslt']; ?>" alt="">
                </div><br>
            <?php } ?>
        </div>

        <h5><b>Detail Fasilitas:</b></h5>
        <p class="card-text"><?php echo $result2['fasilitas_kos']; ?></p><br>

        <a href="#" class="btn btn-warning" id="btnpesan" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Pesan</a>
        <a href="chat.php" class="btn btn-warning" id="btnpesan">Hubungan Pemilik Kos</a><br><br><br>
        <!-- Profile End -->
    </main>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="konfirmasiModalLabel" style="color: #34408C;">Konfirmasi Pesanan</h5>
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
                    <h5 class="modal-title" id="lanjutkanModalLabel" style="color: black;"><img src="../iconsinest/payicon.svg" alt=""> <b>Rp <?php echo $result2['harga_kos']; ?></b></h5>
                    <hr>
                    <form method="post" action="">
                        <button type="submit" name="lanjutkan" class="btn btn-light" style="background-color: #55F998; color: black;">Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu End -->

    <script>
        // Fungsi untuk menampilkan modal konfirmasi
        function showKonfirmasiModal() {
            $('#konfirmasiModal').modal('show');
        }

        // Fungsi untuk menampilkan modal lanjutkan
        function showLanjutkanModal() {
            $('#lanjutkanModal').modal('show');
        }

        // Event handler saat tombol Pesan diklik
        $('#btnpesan').click(function() {
            showKonfirmasiModal();
        });

        // Event handler saat tombol Konfirmasi di modal konfirmasi ditekan
        $('#konfirmasiModal').click(function() {
            showLanjutkanModal();
        });
    </script>

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