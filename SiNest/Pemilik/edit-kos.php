<?php
include '../SESSION-Login/session-cek.php'
?>

<?php
include '../SESSION-Login/koneksi.php';
// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM riwayat_kos where id_kos = '$_GET[update]'");
$result = mysqli_fetch_assoc($query_mysql);

$query_mysql = mysqli_query($mysqli, "SELECT * FROM foto_fasilitas where id_kos = '$_GET[update]'");
$result4 = mysqli_fetch_assoc($query_mysql);
?>

<?php
if (isset($_POST['update'])) {
    $id_kos = $_POST['idKosin'];
    $nama_kos = $_POST['namaKosin'];
    $status_kos = $_POST['statuskosin'];
    $tipe_kos = $_POST['tipekosin'];
    $fasilitas_kos = $_POST['fasilitasin'];
    $lokasi_kos = $_POST['lokasiin'];
    $kapasitas_kos = $_POST['kapasitasin'];
    $harga_kos = $_POST['hargain'];

    // Memeriksa apakah ada file foto yang diunggah
    if ($_FILES['foto']['name'] != '') {
        // Menghapus foto sebelumnya
        if ($result['foto'] != '') {
            unlink("uploadimg/" . $result['foto']);
        }

        // Upload foto baru
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $path = "uploadimg/" . $foto;
        move_uploaded_file($tmp, $path);
    } else {
        // Jika tidak ada file foto yang diunggah, gunakan foto yang sudah ada sebelumnya
        $foto = $result['foto'];
    }

    // Memeriksa apakah ada file foto fasilitas yang diunggah
    if (isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'][0] != '') {
        // Menghapus foto fasilitas sebelumnya
        if ($result4['foto_fslt'] != '') {
            $old_foto_fasilitas = explode(',', $result4['foto_fslt']);
            foreach ($old_foto_fasilitas as $old_foto) {
                unlink("uploadimg/" . $old_foto);
            }
        }

        // Upload foto fasilitas baru
        $foto_fasilitas = [];
        foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['gambar']['name'][$key];
            $file_tmp = $_FILES['gambar']['tmp_name'][$key];
            $file_path = "uploadimg/" . $file_name;
            move_uploaded_file($file_tmp, $file_path);
            $foto_fasilitas[] = $file_name;
        }
        $foto_fasilitas = implode(',', $foto_fasilitas);
    } else {
        // Jika tidak ada file foto fasilitas yang diunggah, gunakan foto fasilitas yang sudah ada sebelumnya
        $foto_fasilitas = $result4['foto_fslt'];
    }

    // Update data kos
    $update_query = "UPDATE riwayat_kos SET
    nama_kos = '$nama_kos',
    status_kos = '$status_kos',
    tipe_kos = '$tipe_kos',
    fasilitas_kos = '$fasilitas_kos',
    lokasi_kos = '$lokasi_kos',
    kapasitas_kos = '$kapasitas_kos',
    harga_kos = '$harga_kos',
    foto = '$foto'
    WHERE id_kos = '$id_kos'";

    mysqli_query($mysqli, $update_query);

    // Update data foto fasilitas
    $update_foto_fasilitas_query = "UPDATE foto_fasilitas SET foto_fslt = '$foto_fasilitas' WHERE id_kos = '$id_kos'";
    mysqli_query($mysqli, $update_foto_fasilitas_query);

    // Redirect ke halaman riwayat-kos.php setelah update berhasil
    header("Location: riwayat-kos.php");
    exit();
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
    <main id="main" class="main">
        <h5 class="mb-4">Menu Tambah</h5>

        <!-- Main Content Start -->
        <div class="container">
            <!-- form tambah data -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <!-- data Id Kos -->
                        <div class="mb-3 row">
                            <label for="npm" class="col-sm-2 col-form-label">Id Kos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="107201344" value="<?php echo $result['id_kos']; ?>" name="idKosin" required>
                            </div>
                        </div>

                        <!-- data nama Kos -->
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Kos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Kos 1" value="<?php echo $result['nama_kos']; ?>" name="namaKosin" required>
                            </div>
                        </div>

                        <!-- data Status Kos -->
                        <div class="mb-3 row">
                            <label for="jk" class="col-sm-2 col-form-label">Status Kos</label>
                            <div class="col-sm-10">
                                <select name="statuskosin" class="form-select" aria-label="Default select example" required>
                                    <option selected hidden><?php echo $result['status_kos']; ?></option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>

                        <!-- data Tipe Kos -->
                        <div class="mb-3 row">
                            <label for="jk" class="col-sm-2 col-form-label">Status Kos</label>
                            <div class="col-sm-10">
                                <select name="tipekosin" class="form-select" aria-label="Default select example" required>
                                    <option selected hidden><?php echo $result['tipe_kos']; ?></option>
                                    <option value="Putra">Putra</option>
                                    <option value="Putri">Putri</option>
                                    <option value="Campur">Campur</option>
                                </select>
                            </div>
                        </div>

                        <!-- data fasilitas kos -->
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Fasilitas</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Kasur, AC, kamar Mandi,..." name="fasilitasin" required><?php echo $result['fasilitas_kos']; ?></textarea>
                            </div>
                        </div>

                        <!-- data Lokasi -->
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Lokasi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="KP D2 No. 10 Bandar Lampung" name="lokasiin" required><?php echo $result['lokasi_kos']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <!-- data Kapasitas -->
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Kapasitas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="4 Orang" value="<?php echo $result['kapasitas_kos']; ?>" name="kapasitasin" required>
                            </div>
                        </div>

                        <!-- data harga -->
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="8000000" value="<?php echo $result['harga_kos']; ?>" name="hargain" required>
                            </div>
                        </div>

                        <!-- data foto fasilitas -->
                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto Fasilitas</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="gambar[]" multiple><br><br>
                            </div>
                        </div>

                        <!-- data foto -->
                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <h6>Current Photo</h6>
                                <img id="currentPhoto" src="uploadimg/<?php echo $result['foto'] ?>" style="width: 100px" />
                                <br>
                                <input class="form-control" type="file" name="foto" onchange="showPreview(event)"><br><br>
                                <img id="preview" src="#" alt="Preview Foto" style="width: 342px">
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <!-- Submit Butoon -->
                <button type="submit" class="btn btn-primary" name="update">Save</button>
                <a href="riwayat-kos.php" class="btn btn-danger">Kembali</a>
            </form>
        </div><br><br>
        <!-- Main Content End -->



        </div>
        </div>
    </main>
    <!-- Preview Foto -->
    <script>
        function showPreview(event) {
            var input = event.target;
            var preview = document.getElementById('preview');
            var currentPhoto = document.getElementById('currentPhoto');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);

                currentPhoto.style.display = 'none'; // Sembunyikan foto sebelumnya
                preview.style.display = 'block'; // Tampilkan preview
            } else {
                preview.src = ''; // Hapus preview jika tidak ada foto yang dipilih

                currentPhoto.style.display = 'block'; // Tampilkan foto sebelumnya
                preview.style.display = 'none'; // Sembunyikan preview
            }
        }
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

</body>

</html>