<?php
include 'koneksi.php';

// Memanggil kolom yang ada pada tabel driver
$query_mysql = mysqli_query($mysqli, "SELECT * FROM profilpenyewa");
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
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemilik Kosan</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link
      href="http://fonts.googleapis.com/css?family=Open+Sans"
      rel="stylesheet"
      type="text/css"
    />
  </head>
  <body>
    <div id="wrapper">
      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="adjust-nav">
          <div class="navbar-header">
            <button
              type="button"
              class="navbar-toggle"
              data-toggle="collapse"
              data-target=".sidebar-collapse"
            >
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"
              ><i class="fa fa-square-o"></i>&nbsp;LOGO SINEST</a
            >
          </div>
        
        </div>
      </div>
      <!-- /. NAV TOP  -->
      <?php
        include "sidebar.php"
      ?>
            <!-- <li>
              <a href="#"
                ><i class="fa fa-edit"></i>UI Elements<span
                  class="fa arrow"
                ></span
              ></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="#">Notifications</a>
                </li>
                <li>
                  <a href="#">Elements</a>
                </li>
                <li>
                  <a href="#">Free Link</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#"><i class="fa fa-table"></i>Table Examples</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-edit"></i>Forms </a>
            </li>

            <li>
              <a href="#"
                ><i class="fa fa-sitemap"></i>Multi-Level Dropdown<span
                  class="fa arrow"
                ></span
              ></a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="#">Second Level Link</a>
                </li>
                <li>
                  <a href="#">Second Level Link</a>
                </li>
                <li>
                  <a href="#"
                    >Second Level Link<span class="fa arrow"></span
                  ></a>
                  <ul class="nav nav-third-level">
                    <li>
                      <a href="#">Third Level Link</a>
                    </li>
                    <li>
                      <a href="#">Third Level Link</a>
                    </li>
                    <li>
                      <a href="#">Third Level Link</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-qrcode"></i>Tabs & Panels</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-bar-chart-o"></i>Mettis Charts</a>
            </li>

            <li>
              <a href="#"><i class="fa fa-edit"></i>Last Link </a>
            </li>
            <li>
              <a href="blank.html"><i class="fa fa-table"></i>Blank Page</a>
            </li>
          </ul>
        </div> -->
      <!-- </nav> -->
      <!-- /. NAV SIDE  -->
      <div id="page-wrapper">
        <div id="page-inner">
          <div class="row">
            <div class="col-md-12">
              <h2>Data Profil</h2>
            </div>
          </div>
          <!-- /. ROW  -->
          <hr />

          
         
            <!-- Main Menu Riwayat Kos Start-->
                <!-- add kos Start -->
            <div class="table-responsive">
                 <div class="container">
                  <table >
                    <tbody>
                      <tr>
                         <td><img src="gambar.png" alt="profilpenyewakos" width="250" height="250"></td>
                         <td width="5000px">
                            <form method="POST" action="tambah_exe.php" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label for="npm" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaLengkap" name="namaLengkap">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
                                        <option selected>Pilih jenis kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="npm" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="npm" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="noHp" name="noHp">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="npm" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning" name="submit">Edit</button>
                    
                        </form>
                         </td>
                      </tr>
                    </tbody>

                  </table>
                        
            </div>
            <!-- add kos End -->
             <!-- Main Menu Riwayat Kos End -->

          </div>
          <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
      </div>
      <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
